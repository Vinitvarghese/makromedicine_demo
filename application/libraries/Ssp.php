<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}

/*
 * Helper functions for building a DataTables server-side processing SQL query
 *
 * The static functions in this class are just helper functions to help build
 * the SQL used in the DataTables demo server-side processing scripts. These
 * functions obviously do not represent all that can be done with server-side
 * processing, they are intentionally simple to show how it works. More complex
 * server-side processing operations will likely require a custom script.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

class Ssp {


	/**
	 * Create the data output array for the DataTables rows
	 *
	 * @param array $columns Column information array
	 * @param array $data Data from the SQL get
	 *
	 * @return array          Formatted data in a row based format
	 */
	static function ssp_data_output( $columns, $data, $conn ) {
		$out = array();
		$db  = self::ssp_db( $conn );

		for ( $i = 0, $ien = count( $data ); $i < $ien; $i ++ ) {
			$row = array();

			for ( $j = 0, $jen = count( $columns ); $j < $jen; $j ++ ) {
				$column = $columns[ $j ];

				// Is there a formatter?
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] = $column['formatter']( $data[ $i ][ $column['db'] ], $data[ $i ], $db );
				} else {
					$row[ $column['dt'] ] = $data[ $i ][ $columns[ $j ]['db'] ];
				}
			}

			$out[] = $row;
		}

		usort( $out, function ( $a, $b ) {
			return strcmp( strip_tags( $a[2] ), strip_tags( $b[2] ) );
		} );

		// print_r($out);
		return $out;
	}


	/**
	 * Database connection
	 *
	 * Obtain an PHP PDO connection from a connection details array
	 *
	 * @param array $conn SQL connection details. The array should have
	 *    the following properties
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 *
	 * @return resource PDO connection
	 */
	static function ssp_db( $conn ) {
		if ( is_array( $conn ) ) {
			return self::ssp_sql_connect( $conn );
		}

		return $conn;
	}


	/**
	 * Paging
	 *
	 * Construct the LIMIT clause for server-side processing SQL query
	 *
	 * @param array $request Data sent to server by DataTables
	 * @param array $columns Column information array
	 *
	 * @return string SQL limit clause
	 */
	static function ssp_limit( $request, $columns ) {
		$limit = '';

		if ( isset( $request['start'] ) && $request['length'] != - 1 ) {
			$limit = "LIMIT " . intval( $request['start'] ) . ", " . intval( $request['length'] );
		}

		return $limit;
	}


	/**
	 * Ordering
	 *
	 * Construct the ORDER BY clause for server-side processing SQL query
	 *
	 * @param array $request Data sent to server by DataTables
	 * @param array $columns Column information array
	 *
	 * @return string SQL order by clause
	 */
	static function ssp_order( $request, $columns ) {
		$order = '';

		if ( isset( $request['order'] ) && count( $request['order'] ) ) {
			$orderBy   = array();
			$dtColumns = self::ssp_pluck( $columns, 'dt' );

			for ( $i = 0, $ien = count( $request['order'] ); $i < $ien; $i ++ ) {
				// Convert the column index into the column data property
				$columnIdx     = intval( $request['order'][ $i ]['column'] );
				$requestColumn = $request['columns'][ $columnIdx ];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column    = $columns[ $columnIdx ];

				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][ $i ]['dir'] === 'asc' ?
						'ASC' :
						'DESC';

					$orderBy[] = '`' . $column['db'] . '` ' . $dir;
				}
			}

			if ( count( $orderBy ) ) {
				$order = 'ORDER BY ' . implode( ', ', $orderBy );
			}
		}

		return $order;
	}


	/**
	 * Searching / Filtering
	 *
	 * Construct the WHERE clause for server-side processing SQL query.
	 *
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here performance on large
	 * databases would be very poor
	 *
	 * @param array $request Data sent to server by DataTables
	 * @param array $columns Column information array
	 * @param array $bindings Array of values for PDO bindings, used in the
	 *    sql_exec() function
	 *
	 * @return string SQL where clause
	 */
	static function filter( $request, $columns, &$bindings ) {
		$globalSearch = array();
		$columnSearch = array();
		$dtColumns    = self::ssp_pluck( $columns, 'dt' );

		if ( isset( $request['search'] ) && $request['search']['value'] != '' ) {
			$str = $request['search']['value'];

			for ( $i = 0, $ien = count( $request['columns'] ); $i < $ien; $i ++ ) {
				$requestColumn = $request['columns'][ $i ];
				$columnIdx     = array_search( $requestColumn['data'], $dtColumns );
				$column        = $columns[ $columnIdx ];

				if ( $requestColumn['searchable'] == 'true' ) {
					$binding = self::ssp_bind( $bindings, $str, PDO::PARAM_INT );
					if ( $column['db'] != 'work' ) {
						$columnSearch[] = "`wc_product`.`" . $column['db'] . "` in(" . $binding . ")";
					} else {
						$columnSearch[] = "`" . $column['db'] . "` in(" . $binding . ")";
					}
				}
			}
		}

		// Individual column filtering
		if ( isset( $request['columns'] ) ) {
			for ( $i = 0, $ien = count( $request['columns'] ); $i < $ien; $i ++ ) {
				$requestColumn = $request['columns'][ $i ];
				$columnIdx     = array_search( $requestColumn['data'], $dtColumns );
				$column        = $columns[ $columnIdx ];

				$str = $requestColumn['search']['value'];

				if ( $requestColumn['searchable'] == 'true' &&
				     $str != '' ) {
					//	echo $column['db'].'-';
					if ( $column['db'] == 'atc_code' ) {
						$str_arr = explode( '|', $str );

						foreach ( $str_arr as $key => $value ) {
							$binding           = self::ssp_bind( $bindings, $value, PDO::PARAM_INT );
							$globalSearch[0][] = "`wc_atc_code_translation`.`meaning` like " . $binding;
						}

					} else if ( $column['db'] == 'title' ) {

						$binding           = self::ssp_bind( $bindings, $str, PDO::PARAM_INT );
						$globalSearch[6][] = "wc_product_translation.title LIKE concat('%'," . $binding . ",'%')";


					} else if ( $column['db'] == 'packing_type' ) {
						$str_arr = explode( '|', $str );

						foreach ( $str_arr as $key => $value ) {
							$binding           = self::ssp_bind( $bindings, $value, PDO::PARAM_INT );
							$globalSearch[1][] = "`wc_packing_type_translation`.`name` like " . $binding;
						}

					} else if ( $column['db'] == 'pr_type' ) {
						$str_arr = explode( '|', $str );

						foreach ( $str_arr as $key => $value ) {
							$binding           = self::ssp_bind( $bindings, $value, PDO::PARAM_INT );
							$globalSearch[2][] = "`wc_product`.`pr_type` = " . $binding;
						}

					} else if ( $column['db'] == 'country' ) {

						$str_arr = explode( '|', $str );
						$vals    = array();

						foreach ( $str_arr as $key => $value ) {
							$binding = self::ssp_bind( $bindings, $value, PDO::PARAM_INT );
							$vals[]  = $binding;
						}
						$binding           = implode( ',', $vals );
						$globalSearch[3][] = "`wc_product`.`country` in (" . $binding . ")";


					} else if ( $column['db'] == 'medical_cl' ) {

						$str_arr = explode( '|', $str );

						foreach ( $str_arr as $key => $value ) {
							$binding           = self::ssp_bind( $bindings, (int) $value, PDO::PARAM_INT );
							$globalSearch[4][] = "find_in_set(" . $binding . ", `wc_product`.`medical_cl`)";
						}

					} else if ( $column['db'] == 'user_id' ) {
						$str_arr = explode( '|', $str );
						$vals    = array();

						foreach ( $str_arr as $key => $value ) {
							$binding = self::ssp_bind( $bindings, $value, PDO::PARAM_INT );
							$vals[]  = $binding;
						}
						$binding           = implode( ',', $vals );
						$globalSearch[5][] = "`wc_product`.`user_id` in (" . $binding . ")";

					}

				}
			}
		}

		// Combine the filters into a single string
		$where = '';

		if ( count( $globalSearch ) ) {
			$where_arr = array();
			foreach ( $globalSearch as $key => $val ) {
				$where_arr[] = '(' . implode( ' OR ', $val ) . ')';
			}
			$where = '(' . implode( ' AND', $where_arr ) . ')';
		}

		if ( count( $columnSearch ) ) {
			$where = $where === '' ?
				implode( ' AND ', $columnSearch ) :
				$where . ' AND ' . implode( ' AND ', $columnSearch );
		}

		/*if ( $where !== '' ) {
			$where = 'WHERE '.$where;
		}*/

		//echo $where;

		return $where;
	}


	/**
	 * Perform the SQL queries needed for an server-side processing requested,
	 * utilising the helper functions of this class, limit(), order() and
	 * filter() among others. The returned array is ready to be encoded as JSON
	 * in response to an SSP request, or can be modified if needed before
	 * sending back to the client.
	 *
	 * @param array $request Data sent to server by DataTables
	 * @param array|PDO $conn PDO connection resource or connection parameters array
	 * @param string $table SQL table to query
	 * @param string $primaryKey Primary key of the table
	 * @param array $columns Column information array
	 *
	 * @return array          Server-side processing response array
	 */
	static function ssp_simple( $request, $conn, $table, $primaryKey, $columns ) {
		$bindings = array();
		$db       = self::ssp_db( $conn );

		// Build the SQL query string from the request
		$limit = self::ssp_limit( $request, $columns );
		$order = self::ssp_order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );

		$query = $_SESSION['lastsearchquery'];

		/*	$query1 = str_replace('LIMIT 500', '', $query);
			$query1 = str_replace('LIMIT 1, 500', '', $query1);
		*/    //echo $query;
		$query1 = str_replace( 'ORDER BY `wc_product_translation`.`title` ASC', '', $query );
		$query1 = str_replace( 'GROUP BY `id`', '', $query1 );

		if ( $where != '' ) {
			$where = ' and ' . $where . ' AND wc_users.user_groups_id IN(2,3,4,5) ';
		}
		//$limit = ' limit 10';
		// Main query to actually get the data
		$order = " order by `wc_users`.`status` desc,`wc_product`.`id` desc";

		//echo $query1." ".$where." GROUP BY `id` ". $order." ".$limit;


		$data = self::ssp_sql_exec( $db, $bindings,
			$query1 . " " . $where . " GROUP BY `id` " . $order . " " . $limit
		);


		//$sql=$query1.$where.' GROUP by p.id';

		//echo $query1.' '.$where.' GROUP by p.id';

		$resTotalLength = self::ssp_sql_exec( $db, $bindings,
			$query1 . " " . $where . " GROUP by id "
		);

		$resFilterLength = self::ssp_sql_exec( $db, $bindings,
			$query1 . " " . $where . " GROUP by id "
		);

		//print_r($resFilterLength);


		// Total data set length

		$recordsTotal    = count( $resTotalLength );
		$recordsFiltered = count( $resFilterLength );

		$data_all = self::ssp_sql_exec( $db, $bindings,
			$query1 . " " . $where . " GROUP by id "
		);

		//echo $query1." ".$where." GROUP by id ";

		//$data_all_out = self::ssp_data_output( $columns, $data_all, $conn );
		$dataFilterOptions = self::ssp_filter_options( $db, $data_all );

		/*if(isset($resTotalLength[0][0])&&is_numeric($resTotalLength[0][0]))
			$recordsTotal = $resTotalLength[0][0];
		else $recordsTotal=0;*/

		/*
		 * Output
		 */

		/*print_r(array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data, $conn )
		));*/

		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"filterOptions"   => $dataFilterOptions,
			"data"            => self::ssp_data_output( $columns, $data, $conn )
		);
	}


	static function ssp_filter_options( $conn, $data_all ) {
		$pr_types = array();
		$content  = array();
		$bindings = array();
		$db       = self::ssp_db( $conn );

		foreach ( $data_all as $key => $value ) {
			$pr_types[] = strip_tags( $value['pr_type'] );
		}
		$pr_types = array_unique( $pr_types );

		$atc_ids = array();
		foreach ( $data_all as $key => $value ) {
			$atc_code = json_decode( $value['atc_code'] );
			if ( count( $atc_code ) > 0 ) {
				foreach ( $atc_code as $atc ) {
					$atc_ids[] = $atc->id;
				}
			}

		}
		if ( ! empty( $atc_ids ) && count( $atc_ids ) > 0 ) {
			$atc_query = self::ssp_sql_exec( $db, $bindings,
				"select meaning from wc_atc_code_translation where atc_code_id in (" . implode( ',', $atc_ids ) . ")"
			);
			foreach ( $atc_query as $key => $value ) {
				$content[] = $value['meaning'];
			}
		}

		$dosage     = array();
		$dosage_ids = array();

		foreach ( $data_all as $key => $value ) {
			$dosage_arr = json_decode( $value['packing_type'] );
			if ( count( $dosage_arr ) > 0 ) {
				foreach ( $dosage_arr as $d ) {
					$dosage_ids[] = $d->id;
				}
			}

		}

		if ( count( $dosage_ids ) > 0 ) {

			$dosage_query = self::ssp_sql_exec( $db, $bindings,
				"select name from wc_packing_type_translation where packing_type_id in (" . implode( ',', $dosage_ids ) . ")"
			);
			foreach ( $dosage_query as $key => $value ) {
				$dosage[] = $value['name'];
			}
			$dosage = array_unique( $dosage );
		}


		$country = array();
		foreach ( $data_all as $key => $value ) {
			$country[] = strip_tags( $value['country'] );
		}

		$md_array = array();

		$medical = array();
		foreach ( $data_all as $key => $value ) {
			$md_array[] = $value['medical_cl'];
		}

		$md      = implode( ',', $md_array );
		$medical = explode( ',', $md );

		$company = array();
		foreach ( $data_all as $key => $value ) {
			$company[] = strip_tags( $value['user_id'] );
		}
		$company = array_unique( $company );


		return array(
			'pr_types' => $pr_types,
			'content'  => $content,
			'dosage'   => $dosage,
			'country'  => $country,
			'medical'  => $medical,
			'company'  => $company
		);
	}


	/**
	 * The difference between this method and the `simple` one, is that you can
	 * apply additional `where` conditions to the SQL queries. These can be in
	 * one of two forms:
	 *
	 * * 'Result condition' - This is applied to the result set, but not the
	 *   overall paging information query - i.e. it will not effect the number
	 *   of records that a user sees they can have access to. This should be
	 *   used when you want apply a filtering condition that the user has sent.
	 * * 'All condition' - This is applied to all queries that are made and
	 *   reduces the number of records that the user can access. This should be
	 *   used in conditions where you don't want the user to ever have access to
	 *   particular records (for example, restricting by a login id).
	 *
	 * @param array $request Data sent to server by DataTables
	 * @param array|PDO $conn PDO connection resource or connection parameters array
	 * @param string $table SQL table to query
	 * @param string $primaryKey Primary key of the table
	 * @param array $columns Column information array
	 * @param string $whereResult WHERE condition to apply to the result set
	 * @param string $whereAll WHERE condition to apply to all queries
	 *
	 * @return array          Server-side processing response array
	 */
	static function ssp_complex( $request, $conn, $table, $primaryKey, $columns, $whereResult = null, $whereAll = null ) {
		$bindings         = array();
		$db               = self::ssp_db( $conn );
		$localWhereResult = array();
		$localWhereAll    = array();
		$whereAllSql      = '';

		// Build the SQL query string from the request
		$limit = self::ssp_limit( $request, $columns );
		$order = self::ssp_order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );

		$whereResult = self::ssp_flatten( $whereResult );
		$whereAll    = self::ssp_flatten( $whereAll );

		if ( $whereResult ) {
			$where = $where ?
				$where . ' AND ' . $whereResult :
				'WHERE ' . $whereResult;
		}

		if ( $whereAll ) {
			$where = $where ?
				$where . ' AND ' . $whereAll :
				'WHERE ' . $whereAll;

			$whereAllSql = 'WHERE ' . $whereAll;
		}

		// Main query to actually get the data
		$data = self::ssp_sql_exec( $db, $bindings,
			"SELECT `" . implode( "`, `", self::ssp_pluck( $columns, 'db' ) ) . "`
			 FROM `$table`
			 $where
			 $order
			 $limit"
		);

		// Data set length after filtering
		$resFilterLength = self::ssp_sql_exec( $db, $bindings,
			"SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table`
			 $where"
		);
		$recordsFiltered = $resFilterLength[0][0];

		// Total data set length
		$resTotalLength = self::ssp_sql_exec( $db, $bindings,
			"SELECT COUNT(`{$primaryKey}`)
			 FROM   `$table` " .
			$whereAllSql
		);
		$recordsTotal   = $resTotalLength[0][0];

		/*
		 * Output
		 */

		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::ssp_data_output( $columns, $data, $conn )
		);
	}


	/**
	 * Connect to the database
	 *
	 * @param array $sql_details SQL server connection details array, with the
	 *   properties:
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 *
	 * @return resource Database connection handle
	 */
	static function ssp_sql_connect( $sql_details ) {
		try {
			$db = @new PDO(
				"mysql:host={$sql_details['host']};dbname={$sql_details['db']}",
				$sql_details['user'],
				$sql_details['pass'],
				array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
			);
			$db->exec( "set names utf8" );
		} catch ( PDOException $e ) {
			self::ssp_fatal(
				"An error occurred while connecting to the database. " .
				"The error reported by the server was: " . $e->getMessage()
			);
		}

		return $db;
	}


	/**
	 * Execute an SQL query on the database
	 *
	 * @param resource $db Database handler
	 * @param array $bindings Array of PDO binding values from bind() to be
	 *   used for safely escaping strings. Note that this can be given as the
	 *   SQL query string if no bindings are required.
	 * @param string $sql SQL query to execute.
	 *
	 * @return array         Result from the query (all rows)
	 */
	static function ssp_sql_exec( $db, $bindings, $sql = null ) {
		// Argument shifting
		if ( $sql === null ) {
			$sql = $bindings;
		}

		$stmt = $db->prepare( $sql );
		//echo $sql;

		// Bind parameters
		if ( is_array( $bindings ) ) {
			for ( $i = 0, $ien = count( $bindings ); $i < $ien; $i ++ ) {
				$binding = $bindings[ $i ];
				$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
				//var_dump($binding['val']).'-';
			}
		}

//	var_dump($stmt);

		// Execute
		try {
			$stmt->execute();
		} catch ( PDOException $e ) {
			self::ssp_fatal( "An SQL error occurred: " . $e->getMessage() );
		}


		$ad = $stmt->fetchAll( PDO::FETCH_BOTH );

		// Return all
		return $ad;
	}


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal methods
	 */

	/**
	 * Throw a fatal error.
	 *
	 * This writes out an error message in a JSON string which DataTables will
	 * see and show to the user in the browser.
	 *
	 * @param string $msg Message to send to the client
	 */
	static function ssp_fatal( $msg ) {
		echo json_encode( array(
			"error" => $msg
		) );

		exit( 0 );
	}

	/**
	 * Create a PDO binding key which can be used for escaping variables safely
	 * when executing a query with sql_exec()
	 *
	 * @param array &$a Array of bindings
	 * @param  *      $val  Value to bind
	 * @param int $type PDO field type
	 *
	 * @return string       Bound key to be used in the SQL where this parameter
	 *   would be used.
	 */
	static function ssp_bind( &$a, $val, $type ) {
		$key = ':binding_' . count( $a );

		$a[] = array(
			'key'  => $key,
			'val'  => $val,
			'type' => $type
		);

		return $key;
	}


	/**
	 * Pull a particular property from each assoc. array in a numeric array,
	 * returning and array of the property values from each item.
	 *
	 * @param array $a Array to get data from
	 * @param string $prop Property to read
	 *
	 * @return array        Array of property values
	 */
	static function ssp_pluck( $a, $prop ) {
		$out = array();

		for ( $i = 0, $len = count( $a ); $i < $len; $i ++ ) {
			if ( @$a[ $i ] ) {
				$out[] = $a[ $i ][ $prop ];
			}
		}

		return $out;
	}


	/**
	 * Return a string from an array or a string
	 *
	 * @param array|string $a Array to join
	 * @param string $join Glue for the concatenation
	 *
	 * @return string Joined string
	 */
	static function ssp_flatten( $a, $join = ' AND ' ) {
		if ( ! $a ) {
			return '';
		} else if ( $a && is_array( $a ) ) {
			return implode( $join, $a );
		}

		return $a;
	}
}

