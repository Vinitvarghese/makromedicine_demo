<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Pricing extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'Plans_model' );

		
	}

	public function index() {

		$plans               = $this->Plans_model->filter( [ 'status' => 1 ] )->with_translation()->order_by( 'sort' )->all();
		$this->data['plans'] = $plans;
		$this->template->render( 'pricing' );
	}

	public function buy_capsule() {

		// For test payments we want to enable the sandbox mode. If you want to put live
		// payments through then this setting needs changing to `false`.
		$enableSandbox = true;


		// PayPal settings. Change these to your account details and the relevant URLs
		// for your site.
		$paypalConfig = [
			'email'      => 'nigar.akkhundova-buyer@gmail.com',
			'return_url' => 'https://makromedicine.com/payment-successful',
			'cancel_url' => 'https://makromedicine.com/payment-cancelled',
			'notify_url' => 'https://makromedicine.com/buy-capsule'
		];

		$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

		$id_item   = $this->input->post( 'item_number' );
		$item_info = $this->Plans_model->filter( [ 'id' => $id_item ] )->with_translation()->one();


		// Product being purchased.
		$itemName   = $item_info->title;
		$itemAmount = number_format( (float) $item_info->price, 2, '.', '' );


		// Check if paypal request or response
		if ( ! isset( $_POST["txn_id"] ) && ! isset( $_POST["txn_type"] ) ) {

			// Grab the post data so that we can set up the query string for PayPal.
			// Ideally we'd use a whitelist here to check nothing is being injected into
			// our post data.
			$data = [];
			foreach ( $_POST as $key => $value ) {
				$data[ $key ] = stripslashes( $value );
			}

			// Set the PayPal account.
			$data['business'] = $paypalConfig['email'];

			$data['return']        = stripslashes( $paypalConfig['return_url'] );
			$data['cancel_return'] = stripslashes( $paypalConfig['cancel_url'] );
			$data['notify_url']    = stripslashes( $paypalConfig['notify_url'] );

			// Set the details about the product being purchased, including the amount
			// and currency so that these aren't overridden by the form data.
			$data['item_name']     = $itemName;
			$data['amount']        = $itemAmount;
			$data['currency_code'] = 'USD';

			// Add any custom fields for the query string.
			$data['custom'] = $this->data['user']['id'];

			// Build the query string from the data.
			$queryString = http_build_query( $data );

			// Redirect to paypal IPN
			header( 'location:' . $paypalUrl . '?' . $queryString );
			exit();

		}


	}


	public function checkTxnid( $txnid ) {
		global $db;

		$this->db->where( 'txnid', $txnid );
		$this->db->from( 'wc_payments' );

		return ! $this->db->count_all_results();
	}


	public function addPayment( $data ) {

		if ( is_array( $data ) ) {
			$data = array(
				'txnid'          => $data['txn_id'],
				'payment_amount' => $data['payment_amount'],
				'payment_status' => $data['payment_status'],
				'itemid'         => $data['item_number'],
				'userid'         => $data['custom'],
				'createdtime'    => date( 'Y-m-d H:i:s' )
			);

			$item_amount = $this->db->where( 'id', $data['itemid'] )->from( 'wc_plans' )->get()->result_array();
			$amount      = $item_amount[0]['amount'];


			$this->db->set( 'capsule', 'capsule+' . $amount, false )->where( 'id', $this->data['user']['id'] )->update( 'wc_users' );

			return $this->db->insert( 'wc_payments', $data );
		}

		return false;
	}

	public function payment_successful() {

		if ( isset( $_GET['tx'] ) ) {
			$tx      = $_GET['tx'];
			$request = curl_init();

			curl_setopt_array( $request, array
			(
				CURLOPT_URL            => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
				CURLOPT_POST           => true,
				CURLOPT_POSTFIELDS     => http_build_query( array
				(
					'cmd' => '_notify-synch',
					'tx'  => $tx,
					'at'  => 'T9Ut1LHvKLXcEexuTxKUE3xcHb-iw5knOj06mCJh0KdBFUHUC6_Z-j8e1a0',
				) ),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => false,
				// CURLOPT_SSL_VERIFYPEER => TRUE,
				// CURLOPT_CAINFO => 'cacert.pem',
			) );

			$response = curl_exec( $request );
			$status   = curl_getinfo( $request, CURLINFO_HTTP_CODE );

			curl_close( $request );


			if ( $status == 200 AND strpos( $response, 'SUCCESS' ) === 0 ) {
				// Remove SUCCESS part (7 characters long)
				$response = substr( $response, 7 );

				$response = urldecode( $response );

				preg_match_all( '/^([^=\s]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER );
				$response = array_combine( $m[1], $m[2] );

				if ( isset( $response['charset'] ) AND strtoupper( $response['charset'] ) !== 'UTF-8' ) {
					foreach ( $response as $key => &$value ) {
						$value = mb_convert_encoding( $value, 'UTF-8', $response['charset'] );
					}
					$response['charset_original'] = $response['charset'];
					$response['charset']          = 'UTF-8';
				}

				// Sort on keys for readability (handy when debugging)
				ksort( $response );


				$data = [
					'item_number'      => $_GET['item_number'],
					'payment_status'   => $_GET['st'],
					'payment_amount'   => $_GET['amt'],
					'payment_currency' => $_GET['cc'],
					'txn_id'           => $tx,
					'custom'           => $this->data['user']['id'],
				];


				if ( $this->checkTxnid( $data['txn_id'] ) ) {
					$this->addPayment( $data );
				}


				if ( is_numeric( $response['item_number'] ) ) {
					$item_amount = $this->db->where( 'id', $response['item_number'] )->from( 'wc_plans' )->get()->result_array();
					if ( $item_amount ) {
						$response['item_amount'] = $item_amount[0]['amount'];
					}
				}

				$this->data['response'] = $response;

			} else {
				$this->template->render( 'payment/pay-error' );
			}


		}

		$this->template->render( 'payment/pay-success' );


	}

	public function payment_cancelled() {
		$this->template->render( 'payment/pay-error' );
	}

}