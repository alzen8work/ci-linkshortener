<?php
class Clicks_model extends MY_Model {

	protected $_table 		= 'clicks';
	protected $_primary_key	= 'clicks_id';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	function gen_data($result = array()){
		
		$return_val['success'] = false;
		
		if(!empty($result['data']['url_id'])){
			
			// $return_val 				= $result['data'];
			// _debug_array($result['data']);
			
			$data['where_custom'][] = 'urls_id = "'.$result['data']['url_id'].'";';
			$saved = $this->clicks_model->get_by_arr($data);
			$return_val['success']		= true;
			$return_val['short_url'] 	= $result['data']['short_url'];
			$return_val['long_url'] 	= $result['data']['protocol'].$result['data']['url'];
			$return_val['creation_time']= $result['data']['created_on'];
			$return_val['total_clicks']	= $saved['total_row'];
			$return_val['details']		= $saved['result']->result_array();
		}
		
		return $return_val;
	}
}