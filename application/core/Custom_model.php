<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function callback_get_image($data, $params, $id= false)
	{
		if (!empty($data)) {
			return "<img src='" . $this->Model_tool_image->resize($data, $params['width'],
					$params['height']) . "' width='" . $params['width'] . "' height='" . $params['height'] . "'>";
		}
		return;
	}

	public function callback_get_status($data, $params = false, $id = false)
	{
		return '<div class="checkbox checkbox-switchery switchery-xs switchery-double">
			<label>
				<input type="checkbox" class="switchery changeStatus" data-id="'.$id.'" data-url="'.current_url().'" '.(($data) ? "checked=checked" : "").'>
			</label>
		</div>';
									
		// $rows = [
		//     '0' => "<span class='label label-danger  changeStatus' >"  . translate('disable', true) . "</span>",
		//     '1' => "<span class='label label-success changeStatus' data-url='".current_url()."'>" . translate('enable', true) . "</span>"
		// ];

		// return $rows[$data];
	}

	public function callback_get_name($data, $params = false, $id = false)
	{
		if (!empty($data)) {
			return (isset(json_decode($data)->index->title->{$this->data['current_lang']})) ? json_decode($data)->index->title->{$this->data['current_lang']} : json_decode($data)->index->title->{$this->data['default_language']};
		}
		return;
	}

	public function callback_get_icon($data, $params = false, $id = false)
	{
		if (!empty($data)) {
			return "<i class='" . $data . "'></i>";
		}
		return;
	}

	public function callback_get_status_label($data)
	{
		if($data) {
			return "<span class='label label-success'>" . translate('enable', true) . "</span>";
		} else {
			return "<span class='label label-danger'>" . translate('disable', true) . "</span>";
		}
	}

	public function callback_get_custom_data($data, $params = false)
	{
		if($data && $params) {
			return $params[$data];
		}
		
	}

	public function callback_get_file_label($data)
	{
		if(!empty($data)) {
			return base_url('uploads/'.$data);
		}
		return;
	}

	public function callback_get_image_label($data, $params = ['width' => 200, 'height' => 200]) 
	{
		if($data) {
			$image = $this->Model_tool_image->resize($data, $params['width'], $params['height']);
			if($image) {
				return '<img src="'.$image.'" width="'.$params["width"].'" height="'.$params["height"].'">';
			} else {
				return '<img src="'.$this->Model_tool_image->resize('no-photo.png', $params['width'], $params['height']).'" width="'.$params["width"].'" height="'.$params["height"].'">';
			}
		}

	}

	public function callback_get_option($data, $params = [])
	{
		$query = $this->db->get_where($params['table'], [$params['key'] => $data]);
		if($query->num_rows() > 0)
		{
			$row = $query->row();
//			var_dump($row);
			return $row->{$params['value']};
		}
	}

	public function callback_get_rating($rating, $params = [])
	{
		$stars = '';
		if($rating > 0) {
			for ($i=0; $i < $rating; $i++) { 
				$stars .= '<i class="icon-star-full2" style="color:#ebc733;"></i>';
			}
		}	
		return $stars;
	}

	public function callback_get_multiselect_label($data, $params = [])
	{
		$rows = [];
		if($data)
		{
			$explode = explode(',', $data);
			$this->db->where_in($params['key'], $explode);
			$query = $this->db->get($params['table']);			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$rows[] = $row->{$params['value']};
				}
			}
		}

		return implode(',', $rows);
	}

}