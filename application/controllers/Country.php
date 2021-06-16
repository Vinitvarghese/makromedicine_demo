<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Country extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( 'extra' );
		$this->load->model( 'Country_model' );
		$this->load->model( 'Product_model' );

		
	}

	public function index( $id = null, $page = 1 ) {
		if ( $id != null ) {
			$this->data['country_id']       = $id;
			$this->data['title']            = get_country_name( $id ) . " Products";
			$this->data['meta_title']       = get_country_name( $id ) . " Products";
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			$this->data['limit']            = [ 'per_page' => 100, 'page' => $page ];
			$this->data['products']         = $this->Product_model->filter( [ 'country' => $id ] )->with_translation()->all();
			$this->data['total_rows']       = $this->Product_model->fields( [ 'count(*) as count' ] )->filter( [ 'country' => $id ] )->with_translation()->one()->count;
			//Pagination
			$config['full_tag_open']      = '<ul class="pagination">';
			$config['full_tag_close']     = '</ul>';
			$config['first_link']         = '&laquo;';
			$config['first_tag_open']     = '<li class="page-item">';
			$config['first_tag_close']    = '</li>';
			$config['last_link']          = '&raquo;';
			$config['last_tag_open']      = '<li class="page-item">';
			$config['last_tag_close']     = '</li>';
			$config['next_link']          = '&rarr;';
			$config['next_tag_open']      = '<li class="page-item">';
			$config['next_tag_close']     = '</li>';
			$config['prev_link']          = '&larr;';
			$config['prev_tag_open']      = '<li class="page-item">';
			$config['prev_tag_close']     = '</li>';
			$config['cur_tag_open']       = '<li class="page-item"><a href="">';
			$config['cur_tag_close']      = '</a></li>';
			$config['num_tag_open']       = '<li class="page-item">';
			$config['num_tag_close']      = '</li>';
			$config['anchor_class']       = 'follow_link';
			$config['reuse_query_string'] = true;
			$config['use_page_numbers']   = true;
			$config['base_url']           = site_url_multi( 'country/' . $id );
			$config['total_rows']         = $this->data['total_rows'];
			$config['per_page']           = $this->data['limit']['per_page'];
			$this->pagination->initialize( $config );
			$this->data['pagination'] = $this->pagination->create_links();
			$this->template->render( 'country/country_data' );
		} else {
			$this->template->render( '404' );
		}
	}
}
