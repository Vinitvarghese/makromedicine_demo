<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Facebook extends Site_Controller {
	public function __construct() {
		parent::__construct();
		require_once( 'application/config/facebook.php' );
		require_once( 'Facebook/autoload.php' );
	}

	public function index() {
		$this->data['title'] = translate( 'title' );
		date_default_timezone_set( 'Europe/Istanbul' );

		// SET FACEBOOK CONFIGRATION
		$fb = new Facebook\Facebook( [ 'app_id'                => APP_ID,
		                               'app_secret'            => SECRET_KEY,
		                               'default_graph_version' => GRAPH_VERSIONS
		] );

		$url  = 'https://graph.facebook.com/me/?fields=id,name,picture,friends&access_token=' . $_SESSION['facebook_access_token'];
		$curl = curl_init( $url );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		$result = curl_exec( $curl );
		curl_close( $curl );
		$arr = json_decode( $result, true );

		echo "<pre>";
		print_r( $arr );
	}

	public function login() {
		date_default_timezone_set( 'Europe/Istanbul' );
		$fb          = new Facebook\Facebook( [
			'app_id'                => APP_ID,
			'app_secret'            => SECRET_KEY,
			'default_graph_version' => GRAPH_VERSIONS
		] );
		$helper      = $fb->getRedirectLoginHelper();
		$permissions = [ 'public_profile', 'email' ];
		$loginUrl    = $helper->getLoginUrl( URL . 'en/facebook/fb_calback/', $permissions );
		header( 'Location:' . $loginUrl );
	}

	public function fb_calback() {
		date_default_timezone_set( 'Europe/Istanbul' );
		$fb     = new Facebook\Facebook( [
			'app_id'                => APP_ID,
			'app_secret'            => SECRET_KEY,
			'default_graph_version' => GRAPH_VERSIONS
		] );
		$helper = $fb->getRedirectLoginHelper();
		if ( isset( $_GET['state'] ) ) {
			$helper->getPersistentDataHandler()->set( 'state', $_GET['state'] );
		}

		try {
			$accessToken = $helper->getAccessToken();
		} catch ( Facebook\Exceptions\FacebookResponseException $e ) {
			echo $e->getMessage();
			exit;
		} catch ( Facebook\Exceptions\FacebookSDKException $e ) {
			echo $e->getMessage();
			exit;
		}
		if ( isset( $accessToken ) ) {
			$_SESSION['facebook_access_token'] = (string) $accessToken;
			header( 'Location:' . URL . 'en/facebook/index/' );
		} elseif ( $helper->getError() ) {
			header( 'Location:' . URL . 'en/facebook/index/' );
			exit;
		}
	}

}
