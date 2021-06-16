<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Module_model extends Webcoder_Model {

	public $table = 'modules';
	public $primary_key = 'id';
	public $protected = [ 'id' ];
	public $rules = [];


	public function __construct() {
		parent::__construct();
	}

	public function generate_option( $table, $key, $value ) {
		$query = $this->db->get( $table );
		if ( $query->num_rows() > 0 ) {
			$rows = $query->result();
			if ( $rows ) {
				$options[0] = translate( 'select', true );
				foreach ( $rows as $row ) {
					$options[ $row->{$key} ] = $row->$value;
				}

				return $options;
			}

			return [];
		}

		return [];
	}

}