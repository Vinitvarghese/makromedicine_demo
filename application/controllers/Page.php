<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Page extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'Page_model' );

		

	}



	public function index( $slug = false ) {
		if ( $slug != false ) {
			$this->data['page'] = $this->Page_model->order_by( 'sort', 'ASC' )->fields( [ '*' ] )->with_translation()->one();
			if ( $this->data['page'] ) {
				// SET META PARAMETRS
				$this->data['title']            = $this->data['page']->meta_title;
				$this->data['meta_title']       = $this->data['page']->meta_title;
				$this->data['meta_keyword']     = $this->data['page']->meta_keyword;
				$this->data['meta_description'] = $this->data['page']->meta_description;
				$this->data['current_img']      = ( ! empty( $this->data['page']->image ) ) ? $this->data['page']->image : base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
				$this->template->render( 'page' );
			} else {
				// SET 404 META PARAMETRS
				$this->data['title']            = "Makromedicine.com | 404 NOT FOUND";
				$this->data['meta_title']       = "Makromedicine.com | 404 NOT FOUND";
				$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
				$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
				$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
				$this->template->render( 'error/404' );
			}
		} else {
			// SET 404 META PARAMETRS
			$this->data['title']            = "Makromedicine.com | 404 NOT FOUND";
			$this->data['meta_title']       = "Makromedicine.com | 404 NOT FOUND";
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			$this->template->render( 'error/404' );
		}
	}
}
