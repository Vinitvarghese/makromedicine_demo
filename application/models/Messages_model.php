<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Messages_model extends Webcoder_Model {
	public $table = 'user_conversation_reply';
	public $primary_key = 'c_id_fk';
	public $protected = [];
	public $relation_tables = [
		[
			'name'   => 'user_conversation',
			'column' => 'c_id'
		]
	];

	public function __construct() {
		parent::__construct();
	}

	public function messages( $user_id ) {
		$query = $this->db->query( "
        SELECT U.id, C.c_id, C.time, comp.company_name, U.email, U.images
        FROM
            wc_users as U,
            wc_user_conversation as C,
             `wc_company_user_rel` AS `rel`,
             `wc_companies` AS `comp`
        WHERE 
        rel.user_id=U.id AND rel.company_id=comp.id AND
            CASE
              WHEN C.user_one = '$user_id'
              THEN C.user_two = U.id
              WHEN C.user_two = '$user_id'
              THEN C.user_one= U.id
            END
            AND (C.user_one ='$user_id' OR C.user_two ='$user_id')
            GROUP BY C.c_id
            ORDER BY C.c_id DESC
        " );

		$res = $query->result_array();

		foreach ( $res as $key => $value ) {
			$query_seen = $this->db->query( "select seen from wc_user_conversation_reply where c_id_fk=" . $value['c_id'] . " and user_id_fk2=" . $this->data['user']['id'] . " and seen=0" )->result();
			if ( count( $query_seen ) > 0 ) {
				$res[ $key ]['isnew'] = 1;
			}
			$query2 = $this->db->query( "
        UPDATE  wc_user_conversation_reply
        SET seen = 1
        WHERE c_id_fk=" . $value['c_id'] . " and user_id_fk2=" . $this->data['user']['id'] );
		}


		return $res;
	}

	public function check_conversation( $sentby, $sentto ) {
		$query = $this->db->query( "SELECT c_id FROM wc_user_conversation WHERE (user_one='$sentby' AND user_two='$sentto') OR (user_one='$sentto' AND user_two='$sentby')" );

		return $query->result_array();
	}

	public function create_conversation( $data ) {
		$this->db->insert( 'wc_user_conversation', $data );

		return $this->db->insert_id();
	}

	public function addMessage( $data ) {
		$this->db->insert( 'wc_user_conversation_reply', $data );

		return $this->db->insert_id();
	}

	public function getMessage( $c_id, $limit ) {
		$query = $this->db->query( "
        SELECT R.cr_id,R.time,R.reply,U.id, U.company_name, U.email, U.images
        FROM wc_users as U, wc_user_conversation_reply as R
        WHERE R.user_id_fk=U.id and R.c_id_fk='$c_id'
        ORDER BY R.cr_id ASC
        LIMIT $limit" );

		return $query->result_array();
	}
}
