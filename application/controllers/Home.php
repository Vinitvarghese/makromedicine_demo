<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Home extends Site_Controller {
	public function __construct() {
		parent::__construct();
		if ( $this->data['is_loggedin'] ) {
			$this->data['user'] = $this->session->userdata;

			
		}
		$this->load->model( 'Home_model' );
		$this->load->model( 'Page_model' );
		$this->load->model( 'Banner_type_model' );
		$this->load->model( 'Banner_model' );
		$this->load->helper( 'extra' );
	}

	public function index() {


		$this->data['ishome'] = 1;

		$this->data['title'] = translate( 'title' );

		if ( $this->input->get( 'send_email' ) != null ) {
			$this->data['send_email'] = true;
		} else {
			$this->data['send_email'] = false;
		}

		if ( $this->input->get( 'confirm_account' ) != null ) {
			$this->data['confirm_account'] = true;
		} else {
			$this->data['confirm_account'] = false;
		}

		$this->data['getProductCount'] = $this->{$this->model}->getProductCount();
		$this->data['banner_type']     = $this->Banner_type_model->fields( [
			'id',
			'width',
			'height'
		] )->filter( [ 'width' => 1920, 'height' => 780 ] )->one();
		$this->data['countries_count'] = [];

		if ( $this->data['getProductCount'] != false ) {
			foreach ( $this->data['getProductCount'] as $value ) {
				$this->data['countries_count'][ $value['country'] ] = $value;
			}
		}
		if ( $this->data['banner_type'] != false ) {
			$this->data['banners'] = $this->Banner_model->order_by( 'sort', 'DESC' )->filter( [ 'banner_type_id' => $this->data['banner_type']->id ] )->with_translation()->one();
		} else {
			$this->data['banners'] = false;
		}


		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
		}
		if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$real_ip_adress = $_SERVER['REMOTE_ADDR'];
		}

		$this->data['cip'] = $real_ip_adress;

		$ip_info['country'] = $this->ip_info( $this->data['cip'], "Country Code" );
		if ( is_null( $ip_info['country'] ) ) {
			$ip_info['country'] = 'AZ';
		}
		$country_id   = get_country_id( $ip_info['country'] );
		$continent_id = get_continent_id( get_continent_code( $ip_info['country'] ) );

		$this->data['country_code'] = $ip_info['country'];
		$this->data['searching']    = [];
		if ( $this->data['groups'] ) {
			foreach ( $this->data['groups'] as $key => $value ) {
				if ( $value->id < 6 ) {
					$validate = $this->Home_model->get_all_search( $value->id, $country_id );
					if ( $validate != false ) {
						$this->data['searching'][ $value->id ] = $validate;
					}
				}
			}
		}

        $this->template->render( 'home' );
	}

	function curlPost( $url, $data = null, $headers = null ) {
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		if ( ! empty( $data ) ) {
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
		}
		if ( ! empty( $headers ) ) {
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		}
		$response = curl_exec( $ch );
		if ( curl_error( $ch ) ) {
			trigger_error( 'Curl Error:' . curl_error( $ch ) );
		}
		curl_close( $ch );

		return $response;
	}

	public function this_country() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
		}
		if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$real_ip_adress = $_SERVER['REMOTE_ADDR'];
		}

		$this->data['cip'] = $real_ip_adress;

		$ip_info['country'] = $this->ip_info( $this->data['cip'], "Country Code" );
		if ( is_null( $ip_info['country'] ) ) {
			$ip_info['country'] = 'AZ';
		}
		$country_id         = get_country_id( $ip_info['country'] );
		$continent_id       = get_continent_id( get_continent_code( $ip_info['country'] ) );
		$continent_code     = get_continent_code( $ip_info['country'] );
		$this->data['json'] = [
			'country_id'     => $country_id,
			'country_code'   => $ip_info['country'],
			'continent_id'   => $continent_id,
			'continent_code' => $continent_code
		];
		echo json_encode( $this->data['json'] );
	}

	public function ip_info( $ip = null, $purpose = "location", $deep_detect = true ) {
		$output = null;
		if ( filter_var( $ip, FILTER_VALIDATE_IP ) === false ) {
			$ip = $_SERVER["REMOTE_ADDR"];
			if ( $deep_detect ) {
				if ( filter_var( @$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP ) ) {
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				if ( filter_var( @$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP ) ) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				}
			}
		}
		$purpose    = str_replace( array( "name", "\n", "\t", " ", "-", "_" ), null, strtolower( trim( $purpose ) ) );
		$support    = array( "country", "countrycode", "state", "region", "city", "location", "address" );
		$continents = array(
			"AF" => "Africa",
			"AN" => "Antarctica",
			"AS" => "Asia",
			"EU" => "Europe",
			"OC" => "Australia (Oceania)",
			"NA" => "North America",
			"SA" => "South America"
		);
		if ( filter_var( $ip, FILTER_VALIDATE_IP ) && in_array( $purpose, $support ) ) {
			$ipdat = @json_decode( file_get_contents( "http://www.geoplugin.net/json.gp?ip=" . $ip ) );
			if ( @strlen( trim( $ipdat->geoplugin_countryCode ) ) == 2 ) {
				switch ( $purpose ) {
					case "location":
						$output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[ strtoupper( $ipdat->geoplugin_continentCode ) ],
							"continent_code" => @$ipdat->geoplugin_continentCode
						);
						break;
					case "address":
						$address = array( $ipdat->geoplugin_countryName );
						if ( @strlen( $ipdat->geoplugin_regionName ) >= 1 ) {
							$address[] = $ipdat->geoplugin_regionName;
						}
						if ( @strlen( $ipdat->geoplugin_city ) >= 1 ) {
							$address[] = $ipdat->geoplugin_city;
						}
						$output = implode( ", ", array_reverse( $address ) );
						break;
					case "city":
						$output = @$ipdat->geoplugin_city;
						break;
					case "state":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "region":
						$output = @$ipdat->geoplugin_regionName;
						break;
					case "country":
						$output = @$ipdat->geoplugin_countryName;
						break;
					case "countrycode":
						$output = @$ipdat->geoplugin_countryCode;
						break;
				}
			}
		}

		return $output;
	}

	public function search_table() {
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			$this->load->model( 'Search_model' );
			$filter = [];


			if ( $this->input->post( 'pr_type' ) != null ) {
				$filter[ 'product.pr_type IN (' . implode( ',', $this->input->post( 'pr_type' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'country_id' ) != null ) {
				$filter[ 'product.country IN (' . implode( ',', $this->input->post( 'country_id' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'company' ) != null ) {
				$filter[ 'product.user_id IN (' . implode( ',', $this->input->post( 'company' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'medical' ) != null ) {
				$regex_varebile                                                    = implode( '|', $this->input->post( 'medical' ) );
				$filter[ 'medical_cl REGEXP ",+|(' . $regex_varebile . ')(,|$)"' ] = null;
			}
			if ( $this->input->post( 'brand_name' ) != null ) {
				$filter[ 'product_translation.title LIKE "%' . $this->input->post( 'brand_name' ) . '%"' ] = null;
			}

			if ( $this->input->post( 'dossage' ) != null ) {
				$this->data['dossage']             = implode( ',', $this->input->post( 'dossage' ) );
				$this->data['not_uniguie_product'] = $this->Search_model->get_product_id( $this->data['dossage'] );
				$this->data['total_product_id']    = [];
				if ( $this->data['not_uniguie_product'] ) {
					foreach ( $this->data['not_uniguie_product'] as $key => $value ) {
						$this->data['total_product_id'][] = $value['product_id'];
					}
					if ( count( $this->data['total_product_id'] ) > 0 ) {
						$this->data['product_id']                             = implode( ',', array_unique( $this->data['total_product_id'] ) );
						$filter[ 'id IN(' . $this->data["product_id"] . ')' ] = null;
					}
				}
			}

			$order_by               = [ 'column' => 'product.created_at', 'sort' => 'ASC' ];
			$this->data['products'] = $this->Search_model->filter( $filter )->with_translation()->order_by( $order_by['column'], $order_by['sort'] )->limit( 100, 1 )->all();
			$this->data['list']     = [];
			if ( $this->data['products'] != false ) {
				foreach ( $this->data['products'] as $key => $product ) {
					$content = '';
					$company = get_company_name( $product->user_id );

					$packing      = '';
					$packing_type = json_decode( $product->packing_type );
					if ( count( $packing_type ) > 0 ) {
						$f       = json_decode( json_encode( $packing_type[0] ) );
						$packing .= get_packing_type_name( $f->id ) . " ";
						if ( $f->mdoza2 != 0 ) {
							$packing .= $f->mdoza2 . " ";
						}
						$packing .= get_unit_name( $f->vdoza2 );
						if ( $f->mdoza != 0 ) {
							$packing .= $f->mdoza . " ";
						}
						$packing .= get_drug_type_code( $f->vdoza ) . " ";
					}

					$atcs     = '';
					$atc_code = json_decode( $product->atc_code );
					if ( count( $atc_code ) > 0 ) {
						foreach ( $atc_code as $atc ) {
							$atcs .= get_atc_code_no( $atc->id ) . " ";
							$atcs .= $atc->mdoza . " ";
							$atcs .= get_unit_name( $atc->vdoza ) . " ";
						}
						$content .= $atcs . " ";
					}


					$herbs  = '';
					$herbal = json_decode( $product->herbal );
					if ( count( $herbal ) > 0 ) {
						foreach ( $herbal as $herb ) {
							$herbs .= get_herbal_name( $herb->id ) . " ";
							$herbs .= $herb->mdoza . " ";
							$herbs .= get_unit_name( $herb->vdoza ) . " ";
						}
						$content .= $herbs . " ";
					}

					$anim    = '';
					$animals = json_decode( $product->animal );
					if ( count( $animals ) > 0 ) {
						foreach ( $animals as $animal ) {
							$anim .= get_animal_name( $animal->id ) . " ";
							$anim .= $animal->mdoza . " ";
							$anim .= get_unit_name( $animal->vdoza ) . " ";
						}
						$content .= $anim . " ";
					}

					$cas        = '';
					$casNumbers = json_decode( $product->cas );
					if ( count( $casNumbers ) > 0 ) {
						foreach ( $casNumbers as $casss ) {
							$cas .= get_cas_name( $casss->id ) . " ";
							$cas .= $casss->mdoza . " ";
							$cas .= get_unit_name( $casss->vdoza ) . " ";
						}
						$content .= $cas . " ";
					}

					$medical = '';
					if ( ! empty( $product->medical_cl ) ) {
						foreach ( get_selected_medical( $product->medical_cl ) as $key => $value ) {
							$medical .= $value->name . ".";
						}
						$medical = rtrim( $medical, ',' );
					}
					if ( isset( $company->company_name ) ) {
						$this->data['list'][] = [
							'id'           => $product->id,
							'title'        => $product->title,
							'pr_type'      => get_product_type_name( $product->pr_type ),
							'country'      => get_country_name( $product->country ),
							'country_img'  => base_url( 'templates/default/assets/img/country/' ) . get_country_code( $product->country ) . ".png",
							'email'        => $company->email,
							'website'      => $company->website,
							'slug'         => base_url( "company/" ) . $company->slug,
							'company_name' => $company->company_name,
							'medical'      => $medical,
							'packing'      => $packing,
							'content'      => $content
						];
					}
				}
				echo json_encode( $this->data['list'], false );
			} else {
				echo "false";
			}
		}
	}


	public function search_table2() {
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			$this->load->model( 'Tender_model' );
			$filter = [];


			if ( $this->input->post( 'pr_type' ) != null ) {
				$filter[ 'tender.pr_type IN (' . implode( ',', $this->input->post( 'pr_type' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'country_id' ) != null ) {
				$filter[ 'tender.country IN (' . implode( ',', $this->input->post( 'country_id' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'continent_id' ) != null ) {
				$filter[ 'tender.continent IN (' . implode( ',', $this->input->post( 'continent_id' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'company' ) != null ) {
				$filter[ 'tender.user_id IN (' . implode( ',', $this->input->post( 'company' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'trade_term' ) != null ) {
				$filter[ 'tender.trade_term IN (' . implode( ',', $this->input->post( 'trade_term' ) ) . ')' ] = null;
			}
			if ( $this->input->post( 'tender_name' ) != null ) {
				$filter[ 'tender_translation.title LIKE "%' . $this->input->post( 'tender_name' ) . '%"' ] = null;
			}

			if ( $this->input->post( 'dossage' ) != null ) {
				$this->data['dossage']             = implode( ',', $this->input->post( 'dossage' ) );
				$this->data['not_uniguie_product'] = $this->Tender_model->get_product_id( $this->data['dossage'] );
				$this->data['total_product_id']    = [];
				if ( $this->data['not_uniguie_product'] ) {
					foreach ( $this->data['not_uniguie_product'] as $key => $value ) {
						$this->data['total_product_id'][] = $value['product_id'];
					}
					if ( count( $this->data['total_product_id'] ) > 0 ) {
						$this->data['product_id']                             = implode( ',', array_unique( $this->data['total_product_id'] ) );
						$filter[ 'id IN(' . $this->data["product_id"] . ')' ] = null;
					}
				}
			}

			$order_by               = [ 'column' => 'tender.created_at', 'sort' => 'ASC' ];
			$this->data['products'] = $this->Tender_model->filter( $filter )->with_translation()->order_by( $order_by['column'], $order_by['sort'] )->limit( 100, 1 )->all();
			$this->data['list']     = [];
			if ( $this->data['products'] != false ) {
				foreach ( $this->data['products'] as $key => $product ) {
					$content = '';
					$company = get_company_name( $product->user_id );

					$packing      = '';
					$packing_type = json_decode( $product->packing_type );
					if ( count( $packing_type ) > 0 ) {
						$f       = json_decode( json_encode( $packing_type[0] ) );
						$packing .= get_packing_type_name( $f->id ) . " ";
						if ( $f->mdoza2 != 0 ) {
							$packing .= $f->mdoza2 . " ";
						}
						$packing .= get_unit_name( $f->vdoza2 );
						if ( $f->mdoza != 0 ) {
							$packing .= $f->mdoza . " ";
						}
						$packing .= get_drug_type_code( $f->vdoza ) . " ";
					}

					$atcs     = '';
					$atc_code = json_decode( $product->atc_code );
					if ( count( $atc_code ) > 0 ) {
						foreach ( $atc_code as $atc ) {
							$atcs .= get_atc_code_no( $atc->id ) . " ";
							$atcs .= $atc->mdoza . " ";
							$atcs .= get_unit_name( $atc->vdoza ) . " ";
						}
						$content .= $atcs . " ";
					}


					$herbs  = '';
					$herbal = json_decode( $product->herbal );
					if ( count( $herbal ) > 0 ) {
						foreach ( $herbal as $herb ) {
							$herbs .= get_herbal_name( $herb->id ) . " ";
							$herbs .= $herb->mdoza . " ";
							$herbs .= get_unit_name( $herb->vdoza ) . " ";
						}
						$content .= $herbs . " ";
					}

					$anim    = '';
					$animals = json_decode( $product->animal );
					if ( count( $animals ) > 0 ) {
						foreach ( $animals as $animal ) {
							$anim .= get_animal_name( $animal->id ) . " ";
							$anim .= $animal->mdoza . " ";
							$anim .= get_unit_name( $animal->vdoza ) . " ";
						}
						$content .= $anim . " ";
					}

					$cas        = '';
					$casNumbers = json_decode( $product->cas );
					if ( count( $casNumbers ) > 0 ) {
						foreach ( $casNumbers as $casss ) {
							$cas .= get_cas_name( $casss->id ) . " ";
							$cas .= $casss->mdoza . " ";
							$cas .= get_unit_name( $casss->vdoza ) . " ";
						}
						$content .= $cas . " ";
					}

					if ( ! isset( $medical ) ) {
						$medical = '';
					}
					/*
					if(!empty($product->medical_cl)){
						foreach(get_selected_medical($product->medical_cl) as $key=>$value)
						{
							$medical .= $value->name.".";
						}
						$medical = rtrim($medical, ',');
					}*/
					if ( isset( $company->company_name ) ) {
						$this->data['list'][] = [
							'id'           => $product->id,
							'title'        => $product->title,
							'pr_type'      => get_product_type_name( $product->pr_type ),
							'country'      => get_country_name( $product->country ),
							'country_img'  => base_url( 'templates/default/assets/img/country/' ) . get_country_code( $product->country ) . ".png",
							'email'        => $company->email,
							'website'      => $company->website,
							'slug'         => base_url( "company/" ) . $company->slug,
							'company_name' => $company->company_name,
							'medical'      => $medical, // TODO: Check medical definition.
							'packing'      => $packing,
							'content'      => $content
						];
					}
				}
				echo json_encode( $this->data['list'], false );
			} else {
				echo "false";
			}
		}
	}

	public function get_country() {
		if ( $this->input->method() == 'post' && $this->input->is_ajax_request() ) {
			$this->data['value'] = $this->input->post( 'value' );
			if ( ! empty( $this->data['value'] ) ) {
				$in = '';
				foreach ( $this->data['value'] as $value ) {
					$in .= '"' . $value . '"' . ",";
				}
				$in                     = rtrim( $in, ',' );
				$this->data['countrys'] = $this->Country_model->fields( [
					'id',
					'name',
					'code'
				] )->filter( [ "continent_id IN ($in)" => null ] )->with_translation()->all();
				// $this->debug($this->db->last_query());
				echo json_encode( $this->data['countrys'] );
			} else {
				echo 'danger';
			}
		}
	}

	public function companyNameSearch() {
		if ( $this->input->method() == 'post' ) {
			$this->data['value'] = $this->input->post( 'search' );
			if ( ! empty( $this->data['value'] ) ) {


				
			} else {
				echo json_encode(['message' => 'error']);
			}
		}	
	}

	public function importer() {
		die();
		$this->load->model( 'Blog_model' );
		$this->data['import_blog'] = $this->Home_model->select_import( [
			'id_item',
			'title',
			'alias',
			'text',
			'file'
		] );

		if ( $this->data['import_blog'] ) {
			foreach ( $this->data['import_blog'] as $key => $value ) {
				$array_blog = [
					'status' => 1,
					'sort'   => $key,
					'image'  => $value['file']
				];
				$insert     = $this->Blog_model->insert( $array_blog, 'wc_blog' );
				if ( $insert ) {
					$array_blog_translation = [
						'blog_id'     => $this->db->insert_id(),
						'language_id' => 1,
						'title'       => $value['title'],
						'description' => $value['text']
					];
					$insert                 = $this->Blog_model->insert( $array_blog_translation, 'wc_blog_translation' );
				}

			}
		}

	}

	private function _import() {
		die();
		set_time_limit( 0 );
		$query  = $this->db->get( 'pm_product' );
		$result = $query->result();

		foreach ( $result as $result ) {

			$packing_type = [];
			if ( isset( $result->packing_type ) && ! empty( $result->packing_type ) ) {
				$packing_type[] = [
					'id'     => (int) $result->packing_type,
					'mdoza'  => (int) $result->packing_mdoza2,
					'vdoza'  => (int) $result->packing_vdoza2,
					'mdoza2' => (int) $result->packing_mdoza,
					'vdoza2' => (int) $result->packing_vdoza,
				];
			}


			$herbals        = explode( ',', $result->bitki );
			$herbals_mdoza  = explode( ',', $result->bitki_mdoza );
			$herbals_vdoza  = explode( ',', $result->bitki_vdoza );
			$herbals_mdoza2 = explode( ',', $result->bitki_mdoza2 );
			$herbals_vdoza2 = explode( ',', $result->bitki_vdoza2 );

			//Herbals
			$herbal = [];
			if ( ! empty( $herbals ) ) {
				for ( $i = 0; $i < count( $herbals ); $i ++ ) {

					if ( isset( $herbals[ $i ] ) && ! empty( $herbals[ $i ] ) ) {
						$herbal_single = [
							'id'    => ( isset( $herbals[ $i ] ) ) ? $herbals[ $i ] : 0,
							'mdoza' => ( isset( $herbals_mdoza[ $i ] ) ) ? $herbals_mdoza[ $i ] : 0,
							'vdoza' => ( isset( $herbals_vdoza[ $i ] ) ) ? $herbals_vdoza[ $i ] : 0,
							'part'  => ( isset( $herbals_mdoza2[ $i ] ) ) ? $herbals_mdoza2[ $i ] : 0,
							'form'  => ( isset( $herbals_vdoza2[ $i ] ) ) ? $herbals_vdoza2[ $i ] : 0,
						];


						$herbal[] = $herbal_single;
					}
				}
			}


			// Chemical code
			$atc_code    = [];
			$atcs        = explode( ',', $result->atc_code );
			$atcs_mdoza  = explode( ',', $result->terkib_mdoza );
			$atcs_vdoza  = explode( ',', $result->terkib_vdoza );
			$atcs_mdoza2 = explode( ',', $result->terkib_mdoza2 );
			$atcs_vdoza2 = explode( ',', $result->terkib_vdoza );


			if ( ! empty( $atcs ) ) {
				for ( $i = 0; $i < count( $atcs ); $i ++ ) {

					if ( isset( $atcs[ $i ] ) && ! empty( $atcs[ $i ] ) ) {
						$atc_code_single = [
							'id'     => ( isset( $atcs[ $i ] ) ) ? $atcs[ $i ] : 0,
							'mdoza'  => ( isset( $atcs_mdoza[ $i ] ) ) ? $atcs_mdoza[ $i ] : 0,
							'vdoza'  => ( isset( $atcs_vdoza[ $i ] ) ) ? $atcs_vdoza[ $i ] : 0,
							'mdoza2' => ( isset( $atcs_mdoza1[ $i ] ) ) ? $atcs_mdoza2[ $i ] : 0,
							'vdoza2' => ( isset( $atcs_vdoza2[ $i ] ) ) ? $atcs_vdoza2[ $i ] : 0
						];


						$atc_code[] = $atc_code_single;
					}
				}
			}

			$animals        = explode( ',', $result->heyvan );
			$animals_mdoza  = explode( ',', $result->heyvan_mdoza );
			$animals_vdoza  = explode( ',', $result->heyvan_vdoza );
			$animals_mdoza2 = explode( ',', $result->heyvan_mdoza2 );
			$animals_vdoza2 = explode( ',', $result->heyvan_vdoza2 );
			//animals
			$animal = [];
			if ( ! empty( $animals ) ) {
				for ( $i = 0; $i < count( $animals ); $i ++ ) {

					if ( isset( $animals[ $i ] ) && ! empty( $animals[ $i ] ) ) {
						$animal_single = [
							'id'    => ( isset( $animals[ $i ] ) ) ? $animals[ $i ] : 0,
							'mdoza' => ( isset( $animals_mdoza[ $i ] ) ) ? $animals_mdoza[ $i ] : 0,
							'vdoza' => ( isset( $animals_vdoza[ $i ] ) ) ? $animals_vdoza[ $i ] : 0,
							'part'  => ( isset( $animals_mdoza2[ $i ] ) ) ? $animals_mdoza2[ $i ] : 0,
							'form'  => ( isset( $animals_vdoza2[ $i ] ) ) ? $animals_vdoza2[ $i ] : 0,
						];

						$animal[] = $animal_single;
					}


					//$this->db->insert('product_animal', $animal_single);
				}
			}


			$cas = [];
			if ( isset( $result->cas_id ) && ! empty( $result->cas_id ) ) {
				$cas[] = [
					'id'          => (int) $result->cas_id,
					'mdoza'       => (int) $result->cas_mdoza,
					'vdoza'       => (int) $result->cas_vdoza,
					'mdoza2'      => (int) $result->cas_mdoza2,
					'vdoza2'      => (int) $result->cas_vdoza2,
					'purity_unit' => 0,
					'purity'      => 0,
					'atc_code'    => 0
				];
			}

			$product_data = [
				'id'           => $result->id,
				'user_id'      => $result->id_user,
				'checked'      => $result->checked,
				'country'      => $result->country,
				'packing_type' => json_encode( $packing_type ),
				'herbal'       => json_encode( $herbal ),
				'atc_code'     => json_encode( $atc_code ),
				'animal'       => json_encode( $animal ),
				'cas'          => json_encode( $cas ),
				'medical_cl'   => $result->medical_cl,
				'pr_type'      => $result->pr_type,
				'equipment'    => null,
				'moq'          => 0,
				'shelf_life'   => 0,
				'ctd'          => 0,
				'be'           => 0,
				'created_at'   => date( 'Y-m-d H:i:s', $result->add_date ),
				'updated_at'   => date( 'Y-m-d H:i:s', $result->edit_date ),
			];

			$this->db->insert( 'wc_product', $product_data );


			$product_translation_data = [
				'product_id'  => $result->id,
				'language_id' => 1,
				'title'       => $result->title,
				'alias'       => $result->alias,
				'description' => null,
				'storage'     => null
			];

			$this->db->insert( 'wc_product_translation', $product_translation_data );
			unset( $herbal );
			unset( $packing_type );
			unset( $atc_code );
			unset( $animal );
			unset( $cas );
		}
	}

	public function changeProcess() {
		$pr_id      = $this->input->get( 'pr_id' );
		$pr_process = $this->input->get( 'pr_process' );
		if ( is_numeric( $pr_id ) && is_numeric( $pr_process ) ) {
			$this->db->set( 'process', $pr_process )->where( 'id', $pr_id )->update( 'wc_users' );
			die( json_encode( array( 'changed' => 'ok' ) ) );
		} else {
			die( json_encode( array( 'changed' => 'no fuck' ) ) );
		}
	}

	public function suggestion() {
		$name  = $this->input->post( 'name' );
		$text  = $this->input->post( 'text' );
		$type  = $this->input->post( 'type' );
		$text2 = ( $this->input->post( 'text2' ) ) ? $this->input->post( 'text2' ) : '';
		switch ( $type ) {
			case 'chemical':
				$type = 'atc_code';
				break;
			case 'casNumber':
				$type = 'cas_list';
				break;
			case 'dossageForm':
				$type = 'packing_type';
				break;
			case 'medicalClassification':
				$type = 'medical_classifiction';
				break;
			case 'herbal':
				$type = 'herb_part';
				break;
			case 'animal':
				$type = 'animal_part';
				break;

			default:
				# code...
				break;
		}
		$suggestion_data = [
			'type'       => $type,
			'name'       => $name,
			'status'     => 0,
			'text'       => $text,
			'text2'      => $text2,
			'created_at' => date( 'Y-m-d H:i:s' )
		];

		$insert = $this->db->insert( 'wc_suggestion', $suggestion_data );
		if ( $insert ) {
			echo 'ok';
		} else {
			echo 'no';
		}
	}


	/*public function updater_user()
	{
	   $this->load->model('Home_model');
	   echo '<pre>';
	   $this->data['users'] = $this->Home_model->fields(['id','standart'])->all();
	   if(!empty($this->data['users']) && $this->data['users'] != NULL){
		   foreach ($this->data['users'] as $key => $value) {
			   $stan = json_decode($value->standart);
			   if(isset($stan) && !empty($stan))
			   {
				   $vare = '';
				   foreach ($stan as $amk)
				   {
					   if(!empty(trim($amk)))
					   {
						   $vare .= $amk.",";
					   }
				   }
				   $vare = rtrim($vare,',');
				   $this->db->where('id',$value->id);
				   $this->db->update('wc_users',['standart'=>$vare]);
			   }

		   }
	   }


	   $this->debug($this->data['users']);
	}*/
}
