<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Blog extends Site_Controller {
	public $data_format;

	public function __construct() {
		parent::__construct();
		$this->load->helper( 'news' );
		$this->load->model( 'Blog_model' );

		
	}

	// ALL BLOG LIST
	public function index() {
		// Blog Limit Parametr
		$segment_array       = $this->uri->segment_array();
		$page                = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
		$this->data['limit'] = [ 'per_page' => 9, 'page' => $page ];

		// Get Perpage Blog
		$this->data['blog_list'] = $this->Blog_model->
		order_by( 'sort', 'DESC' )->
		filter( [ 'status' => 1 ] )->
		fields( [ 'id', 'slug', 'title', 'description', 'image', 'created_at' ] )->
		with_translation()
		                                            ->limit( $this->data['limit']['per_page'], ( $this->data['limit']['page'] - 1 ) * $this->data['limit']['per_page'] )
		                                            ->all();

		foreach ( $this->data['blog_list'] as $key => $value ) {
			$date              = new DateTime( $value->created_at );
			$value->created_at = $date->format( 'F j, Y' );
		}

		if ( $this->data['blog_list'] ) {

			//Pagination
			$this->data['total_rows']     = $this->Blog_model->filter( [ 'status' => 1 ] )->get_count_rows();
			$config['full_tag_open']      = '<ul class="pagination">';
			$config['full_tag_close']     = '</ul>';
			$config['first_link']         = '&laquo;';
			$config['first_tag_open']     = '<li class="page-item">';
			$config['first_tag_close']    = '</li>';
			$config['last_link']          = ceil( $this->data['total_rows'] / $this->data['limit']['per_page'] ) . ' &raquo; ';
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
			$config['base_url']           = site_url_multi( 'blog/index' );
			$config['total_rows']         = $this->data['total_rows'];
			$config['per_page']           = $this->data['limit']['per_page'];
			$this->pagination->initialize( $config );
			$this->data['pagination'] = $this->pagination->create_links();

		}
		// CHECK DATA AND RENDER TEMPLATE
		if ( $this->data['blog_list'] ) {
			// SET META TAGS PARAMETRS
			$this->data['title']            = 'Makromedicine.com | ' . translate( 'title' );
			$this->data['meta_title']       = 'Makromedicine.com | ' . translate( 'title' );
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			// RENDER TEMPLATE
			$this->data['title'] = translate( 'title' );
			$this->template->render( 'blog/blog' );
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

	// SINGLE BLOG PREVIEW
	public function view( $id = false ) {
		if ( $id != false ) {
			// GET SINGLE BLOG
			$this->data['blog'] = $this->Blog_model->filter( [ 'slug'   => $id,
			                                                   'status' => 1
			] )->order_by( 'sort', 'DESC' )->fields( [ '*' ] )->with_translation()->one();

			// CHECK DATA AND RENDER TEMPLATE
			if ( $this->data['blog'] ) {
				// SET META PARAMETRS
				$this->data['title']            = 'Blog | ' . $this->data['blog']->title;
				$this->data['meta_title']       = $this->data['blog']->title;
				$this->data['meta_keyword']     = $this->data['blog']->meta_keyword;
				$this->data['meta_description'] = trim( mb_substr( str_replace( '&nbsp;', ' ', strip_tags( $this->data['blog']->description ) ), 0, 140, 'UTF-8' ) ) . '...';
				$this->data['current_img']      = base_url( 'uploads/' ) . $this->data['blog']->image;
				// SET BLOG ADD DATE FORMAT
				$date                      = new DateTime( $this->data['blog']->created_at );
				$this->data['data_format'] = $date->format( 'F j, Y, g:i' );

				$update = $this->db->set( 'views', 'views+1', false )->where( 'id', $this->data['blog']->id )->update( 'wc_blog' );

				// RENDER TEMPLATE
				$this->template->render( 'blog/blog_single' );
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

	// CHECK YOUTUBE ID
	public function youtube_id( $youtube_url ) {
		parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );

		return $my_array_of_vars['v'];
	}

}
