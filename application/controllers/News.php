<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class News extends Site_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model( 'News_model' );
		$this->load->helper( 'news' );

		
	}

	// NEWS LIST PANGINATE
	public function index() {

		// NEWS LIMIT PARAMETR
		$segment_array       = $this->uri->segment_array();

		$news_types=[
		    'all_companies', 'following_companies', 'my_companies'
        ];

		$news_type=(isset($_GET['news_type']) && !empty($_GET['news_type']) && in_array($_GET['news_type'], $news_types)) ? $_GET['news_type'] : 'site_news';
		$this->data['news_type'] = $news_type;


		$page                = ( ctype_digit( end( $segment_array ) ) ) ? end( $segment_array ) : 1;
		$this->data['limit'] = [ 'per_page' => 6, 'page' => $page ];

        $limit=$this->data['limit']['per_page'];
        $offset= $this->data['limit']['per_page'] * ( $this->data['limit']['page'] - 1);

        $this->data['news_list']=[];
        $this->data['total_rows']=0;

        $this->load->library("Auth");


		if ($this->auth->is_loggedin()){

		    $user_id=$this->auth->get_user()->id;

            if($news_type=='all_companies'){

                $this->db->select( '*' );
                $this->db->from( 'wc_company_news' )->limit($limit, $offset)->order_by('id', 'DESC');
                $query = $this->db->get();
                $this->data['news_list'] = $query->result_object();

                $this->data['total_rows'] = $this->db->select( '*' )->from( 'wc_company_news' )->count_all_results();

                foreach ( $this->data['news_list'] as $key => $value ) {
                    $this->db->select( 'slug, company_name, company_logo' );
                    $this->db->from( 'wc_companies' )->where( [ 'id' => $value->company_id ] );
                    $query = $this->db->get();
                    $company_data=$query->row();

                    $company_logo=$company_data->company_logo;

                    if (!empty($company_logo)){
                        $company_logo=site_url().'uploads/catalog/users/'.str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $company_logo);
                    }else{
                        $company_logo=base_url('templates/default/assets/images/bloomberg.png');
                    }

                    $value->link=site_url_multi('/').'companies/'.$company_data->slug.'/news/'.$value->id;
                    $value->image=base_url('uploads/news/').$value->image;
                    $value->company_name=$company_data->company_name;
                    $value->company_logo=$company_logo;
                    $value->company_link=site_url_multi('/').'companies/'.$company_data->slug;
                }


            }else if($news_type=='following_companies'){
                $this->db->select( 'followed_company' );
                $this->db->from('wc_user_follow')->where(['follower_id' => $user_id ]);
                $query = $this->db->get();
                $data = $query->result_object();
                $ids=[];




                if (!empty($data)){
                    foreach ($data as $k => $v){
                        $ids[]=$v->followed_company;
                    }

                    $this->db->select( '*' );
                    $this->db->from( 'wc_company_news' )->where_in( 'company_id', $ids  )->limit($limit, $offset)->order_by('id', 'DESC');
                    $query = $this->db->get();
                    $this->data['news_list'] = $query->result_object();

                    $this->data['total_rows'] = $this->db->select( '*' )->from( 'wc_company_news' )->where_in( 'company_id', $ids)->count_all_results();

                    foreach ( $this->data['news_list'] as $key => $value ) {
                        $this->db->select( 'slug, company_name, company_logo' );
                        $this->db->from( 'wc_companies' )->where( [ 'id' => $value->company_id ] );
                        $query = $this->db->get();
                        $company_data=$query->row();

                        $company_logo=$company_data->company_logo;

                        if (!empty($company_logo)){
                            $company_logo=site_url().'uploads/catalog/users/'.str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $company_logo);
                        }else{
                            $company_logo=base_url('templates/default/assets/images/bloomberg.png');
                        }

                        $value->link=site_url_multi('/').'companies/'.$company_data->slug.'/news/'.$value->id;
                        $value->image=base_url('uploads/news/').$value->image;
                        $value->company_name=$company_data->company_name;
                        $value->company_logo=$company_logo;
                        $value->company_link=site_url_multi('/').'companies/'.$company_data->slug;
                    }
                }

            }else if ($news_type=='my_companies'){
                $this->db->select( '*' );
                $this->db->from( 'wc_company_news' )->where( [ 'user_id' => $user_id ] )->limit($limit, $offset)->order_by('id', 'DESC');
                $query = $this->db->get();
                $this->data['news_list'] = $query->result_object();

                $this->data['total_rows'] = $this->db->select( '*' )->from( 'wc_company_news' )->where( [ 'user_id' => $user_id] )->count_all_results();

                foreach ( $this->data['news_list'] as $key => $value ) {
                    $this->db->select( 'slug, company_name, company_logo' );
                    $this->db->from( 'wc_companies' )->where( [ 'id' => $value->company_id ] );
                    $query = $this->db->get();
                    $company_data=$query->row();

                    $company_logo=$company_data->company_logo;

                    if (!empty($company_logo)){
                        $company_logo=site_url().'uploads/catalog/users/'.str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $company_logo);
                    }else{
                        $company_logo=base_url('templates/default/assets/images/bloomberg.png');
                    }

                    $value->link=site_url_multi('/').'companies/'.$company_data->slug.'/news/'.$value->id;
                    $value->image=base_url('uploads/news/').$value->image;
                    $value->company_name=$company_data->company_name;
                    $value->company_logo=$company_logo;
                    $value->company_link=site_url_multi('/').'companies/'.$company_data->slug;
                }

            }else{

                // GET NEWS LIST
                $this->data['news_list'] = $this->News_model->order_by( 'sort', 'DESC' )->filter( [ 'status' => 1 ] )->fields( [
                    'id',
                    'slug',
                    'title',
                    'description',
                    'image',
                    'created_at',
                    'created_at AS date'
                ] )->with_translation()->limit( $limit, $offset )->all();

                foreach ( $this->data['news_list'] as $key => $value ) {
                    $date              = new DateTime( $value->created_at );
                    $value->created_at = $date->format( 'F j, Y' );
                    $value->link=site_url_multi('news/').$value->slug;
                    $value->image=base_url('uploads').'/'.$value->image;
                    $value->company_name='';
                    $value->company_logo='';
                    $value->company_link='';

                }


                //Pagination
                $this->data['total_rows']     = $this->News_model->get_count_rows();

            }

		}else{
            if ($news_type=='all_companies'){

                $this->db->select( '*' );
                $this->db->from( 'wc_company_news' )->limit($limit, $offset)->order_by('id', 'DESC');
                $query = $this->db->get();
                $this->data['news_list'] = $query->result_object();




                $this->data['total_rows'] = $this->db->select( '*' )->from( 'wc_company_news' )->count_all_results();

                foreach ( $this->data['news_list'] as $key => $value ) {
                    $this->db->select( 'slug, company_name, company_logo' );
                    $this->db->from( 'wc_companies' )->where( [ 'id' => $value->company_id ] );
                    $query = $this->db->get();
                    $company_data=$query->row();

                    $company_logo=$company_data->company_logo;

                    if (!empty($company_logo)){
                        $company_logo=site_url().'uploads/catalog/users/'.str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $company_logo);
                    }else{
                        $company_logo=base_url('templates/default/assets/images/bloomberg.png');
                    }

                    $value->link=site_url_multi('/').'companies/'.$company_data->slug.'/news/'.$value->id;
                    $value->image=base_url('uploads/news/').$value->image;
                    $value->company_name=$company_data->company_name;
                    $value->company_logo=$company_logo;
                    $value->company_link=site_url_multi('/').'companies/'.$company_data->slug;
                }

            }else{
                // GET NEWS LIST
                $this->data['news_list'] = $this->News_model->order_by( 'sort', 'DESC' )->filter( [ 'status' => 1 ] )->fields( [
                    'id',
                    'slug',
                    'title',
                    'description',
                    'image',
                    'created_at',
                    'created_at AS date'
                ] )->with_translation()->limit( $limit, $offset )->all();

                foreach ( $this->data['news_list'] as $key => $value ) {
                    $date              = new DateTime( $value->created_at );
                    $value->created_at = $date->format( 'F j, Y' );
                    $value->link=site_url_multi('news/').$value->slug;
                    $value->image=base_url('uploads').'/'.$value->image;
                    $value->company_name='';
                    $value->company_logo='';

                }


                //Pagination
                $this->data['total_rows']     = $this->News_model->get_count_rows();
            }
        }



        $this->data['num_pages'] = ceil($this->data['total_rows']/$this->data['limit']['per_page']);






		$config['full_tag_open']      = '<ul class="pagination">';
		$config['full_tag_close']     = '</ul>';
		$config['first_link']         = '&laquo;';
		$config['first_tag_open']     = '<li class="page-item first_page" >';
		$config['first_tag_close']    = '</li>';
		$config['last_link']          = '&raquo;';
		$config['last_tag_open']      = '<li class="page-item last_page">';
		$config['last_tag_close']     = '</li>';
		$config['next_link']          = '';
		$config['next_tag_open']      = '<li class="page-item">';
		$config['next_tag_close']     = '</li>';
		$config['prev_link']          = '';
		$config['prev_tag_open']      = '<li class="page-item">';
		$config['prev_tag_close']     = '</li>';
		$config['cur_tag_open']       = '<li class="page-item"><a href="" class="current_page">';
		$config['cur_tag_close']      = '</a></li>';
		$config['num_tag_open']       = '<li class="page-item">';
		$config['num_tag_close']      = '</li>';
		$config['anchor_class']       = 'follow_link';
		$config['reuse_query_string'] = true;
		$config['use_page_numbers']   = true;

		$config['base_url']           = site_url_multi( 'news/index' );

		$config['total_rows']         = $this->data['total_rows'];
		$config['per_page']           = $this->data['limit']['per_page'];

		$this->pagination->initialize( $config );
		$this->data['pagination'] = $this->pagination->create_links();

        $this->data['title']            = 'Makromedicine.com | ' . translate( 'title' );
        $this->data['meta_title']       = 'Makromedicine.com | ' . translate( 'title' );
        $this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
        $this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
        $this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
        $this->data['title']            = translate( 'title' );
        $this->template->render( 'news/news' );

		/*if ( $this->data['news_list'] ) {
			$this->data['title']            = 'Makromedicine.com | ' . translate( 'title' );
			$this->data['meta_title']       = 'Makromedicine.com | ' . translate( 'title' );
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			$this->data['title']            = translate( 'title' );
			$this->template->render( 'news/news' );
		} else {
			$this->data['title']            = "Makromedicine.com | 404 NOT FOUND";
			$this->data['meta_title']       = "Makromedicine.com | 404 NOT FOUND";
			$this->data['meta_keyword']     = 'urgent care near me, maternity hospital, primary care physician, allergist, the sports medicine clinc, mayo clinc, orthopedic doctor, medical news , medical events, medical, Chemical, atc code';
			$this->data['meta_description'] = 'A global pharmaceutical organization MAKROMEDICINE is engaged in the consulting services of all kind of pharmaceutical companies  across the world.';
			$this->data['current_img']      = base_url( 'uploads/catalog/Mooc-in-Touch-plateforme-Open-EDX_(1).jpg' );
			$this->template->render( 'error/404' );
		}*/
	}

	// NEWS SINLE VIEW
	public function view( $id = false ) {
		if ( $id != false ) {
			// GET SINGLE NEWS TO ID
			$this->data['news'] = $this->News_model->filter( [ 'slug' => $id ] )->order_by( 'sort', 'DESC' )->fields( [ '*' ] )->with_translation()->one();
			if ( $this->data['news'] ) {
				// SET META PARAMETRS
				$this->data['title']            = 'News | ' . $this->data['news']->title;
				$this->data['meta_title']       = $this->data['news']->title;
				$this->data['meta_keyword']     = $this->data['news']->meta_keyword;
				$this->data['meta_description'] = trim( mb_substr( str_replace( '&nbsp;', ' ', strip_tags( $this->data['news']->description ) ), 0, 140, 'UTF-8' ) ) . '...';
				$this->data['current_img']      = base_url( 'uploads/' ) . $this->data['news']->image;
				// SET NEWS ADD DATE FORMAT
				$date                      = new DateTime( $this->data['news']->created_at );
				$this->data['data_format'] = $date->format( 'F j, Y' );

				$update = $this->db->set( 'views', 'views+1', false )->where( 'id', $this->data['news']->id )->update( 'wc_news' );
				// RENDER TEMPLATE
				$this->template->render( 'news/news_single' );
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

	// YOUTUBE ID CHECKER
	public function youtube_id( $youtube_url ) {
		parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );

		return $my_array_of_vars['v'];
	}

	public static function slugify( $text ) {
		// replace non letter or digits by -
		$text = preg_replace( '~[^\pL\d]+~u', '-', $text );

		// transliterate
		$text = iconv( 'utf-8', 'us-ascii//TRANSLIT', $text );

		// remove unwanted characters
		$text = preg_replace( '~[^-\w]+~', '', $text );

		// trim
		$text = trim( $text, '-' );

		// remove duplicate -
		$text = preg_replace( '~-+~', '-', $text );

		// lowercase
		$text = strtolower( $text );

		if ( empty( $text ) ) {
			return 'n-a';
		}

		return $text;
	}

}
