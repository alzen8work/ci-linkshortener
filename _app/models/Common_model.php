<?php

Class Common_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function migrate_stable()
	{
		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
			exit;
		}
	}
	
	//generate click data for a URL
	function gen_data($result = array()){
		
		$return_val['success'] = false;
		
		if(!empty($result['data']['url_id'])){
			
			// $return_val 				= $result['data'];
			// _debug_array($result['data']);
			
			$data['where_custom'][] = 'urls_id = "'.$result['data']['url_id'].'";';
			$saved = $this->clicks_model->get_by_arr($data);
			
			$return_val['short_url'] 	= $result['data']['short_url'];
			$return_val['long_url'] 	= $result['data']['protocol'].$result['data']['url'];
			$return_val['created_on']	= $result['data']['created_on'];
			$return_val['total_clicks']	= $saved['total_row'];
			$return_val['details']		= $saved['result']->result_array();
			$return_val['success']		= true;
		}
		
		return $return_val;
	}
	
	function gen_url($data= array())
	{
		$return_val['success']	= false;
		$url_exist				= $this->url_exist($data['url']); //Check if URL exist;
		
		// _debug_array($data); exit;
		if( (!empty($url_exist['success'])) && (!empty($url_exist['result'][0]['alias'] ) ) ) {
			
			//if record exist, then return with URL in db
			$return_val['url']		= base_url($url_exist['result'][0]['alias']);
			$return_val['success']	= true;
			
		} else {
			
			//if record not exist, insert into db new URL
			$id					= $this->shortcode_model->add($data);
			$data2['alias']		= gen_code($id);
			$where['url_id']	= $id;
			$result_update		= $this->shortcode_model->edit($data2, $where);
			 
			if(!empty($result_update)) {
				$return_val['url']		= base_url($data2['alias']);
				$return_val['success']	= true;
			}
		}
		// _debug_array($return_val); // exit;
		return $return_val;
	}
	
	function get_url($code)
	{
		
		$return_val['success']		=false;
		$arr 						= array();
		$arr['where_custom'][]		= 'alias = "'.$code.'"';
		$query 						= $this->shortcode_model->get_by_arr($arr);
		$result						= $query['result']->result_array();
		
		// _debug_array($result); exit;
		if(!empty($result[0])) {
			$return_val['success']	= true;
			$protocol 				= (!empty($result[0]['protocol']))?$result[0]['protocol']:'http://';
			$return_val['url'] 		= $protocol.$result[0]['url'];
			$return_val['data']		= $result[0];
		}
		return $return_val;
	}
	
	
	function code_exist($code)
	{
		$return_val['success']		= false;
		
		$limit						= '1';//set it at session or make it at UI
		$offset 					= '';
		
		$arr 						= array();
		$arr['limit']				= array($limit,$offset);
		$arr['where_custom'][]		= 'alias = "'.$code.'"';
		
		$query 						= $this->shortcode_model->get_by_arr($arr);
		$result						= $query['result']->result_array();
		
		if(!empty($result[0])) {
			$return_val['success']	= true;
			$return_val['result']	= $result[0];
		}
		
		// _debug_array($return_val['result']); exit;
		return $return_val;
	}
	
	function url_exist($url)
	{
		$return_val['success']	= true;
		$result					= remove_protocols($url);
		$data['url']			= remove_url_last_slash($result['url']);
		
		$limit						= '1';//set it at session or make it at UI
		$offset 					= '';
		
		$arr 						= array();
		$arr['limit']				= array($limit,$offset);
		$arr['where_custom'][]		= 'url = "'.$data['url'].'"';
		
		
		$result 				= $this->shortcode_model->get_by_arr($arr);
		$return_val['result']	= $result['result']->result_array();
		
		if(empty($return_val['result'])) {
			$return_val['success']	= false;
		}
		
		// _debug_array($return_val['result']); exit;
		return $return_val;
	}
}