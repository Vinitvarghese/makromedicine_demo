<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Faq extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'Faq_model' );

		
	}

	public function index() {
		$this->data['faqs'] = $this->Faq_model->order_by( 'sort', 'ASC' )->fields( [
			'id',
			'question',
			'answer'
		] )->with_translation()->all();
		if ( $this->data['faqs'] != false ) {
			// SET META PARAMETRS
			$this->data['title']            = translate( 'title' ) . ' | Makromedicine.com';
			$this->data['meta_title']       = translate( 'title' ) . ' | Makromedicine.com';
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			// RENDER TEMPLATE
			$this->template->render( 'faq' );
		} else {
			// SET 404 NEWS PAREMTRS
			$this->data['title']            = "Makromedicine.com | 404 NOT FOUND";
			$this->data['meta_title']       = "Makromedicine.com | 404 NOT FOUND";
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			// RENDER 404 TEMPLATE
			$this->template->render( 'error/404' );
		}
	}
}
