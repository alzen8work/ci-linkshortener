<?php

class Shortcode_model extends MY_Model {

	protected $_table 		= 'urls';
	protected $_primary_key	= 'url_id';
	
	public function __construct()
	{
		parent::__construct();
	}

	// function get_url($shortcode =''){
	// 	$return_val['success'] = false; 
	// 	$query=$this->db->get_where('urls', array('url_id'=> base64_decode(str_replace('-','=', $shortcode))));
	// 	$result = $query->result_array();

	// 	if(!empty($result[0]))
	// 	{
	// 		$protocol 	= (!empty($result[0]['protocol']))?$result[0]['protocol']:'http://';
	// 		$url 		= $result[0]['url'];
	// 		$return_val['url'] 		= $protocol.$url;
	// 		$return_val['data'] 	= $result[0];
	// 		$return_val['success'] 	= true; 

	// 	}else{
	// 		$return_val['url'] 		= current_url();
	// 		$return_val['success'] = false; 
	// 	}

	// 	return $return_val;
	// }
}