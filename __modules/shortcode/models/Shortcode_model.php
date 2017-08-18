<?php

class Shortcode_model extends MY_Model {

	protected $_table 		= 'urls';
	protected $_primary_key	= 'url_id';
	
	public function __construct()
	{
		parent::__construct();
	}

	function gen_url_bk()
	{
			$return_val['success'] 	= false;
			
			$result 		        	= remove_protocols($_POST['urls']['url']);
			$_POST['urls']['url'] 		= remove_url_last_slash($result['url']);
			$_POST['urls']['protocol'] 	= $result['protocol'];
			
			
			$validation_arr = $this->set_form_validation($this->_table, 1);
			
			$this->form_validation->set_error_delimiters('&nbsp;','&nbsp;');
		
			if($this->form_validation->run() == false){
				$return_val['success'] 	= false;
				$return_val['msg'] 		= validation_errors(); //ucwords(lang('msg[invalid]'));
			}
			else
			{
				$result 			= remove_protocols($_POST['urls']['url']);
				$data['url'] 		= remove_url_last_slash($result['url']);
				$data['protocol'] 	= $result['protocol'];
	
				$this->db->insert('urls', $data);
				$return_val['success'] 	= true;
				$return_val['msg'] 		= ucwords(lang('msg[generated]'));    		
				$return_val['url'] 		= base_url(str_replace('=','-', base64_encode($this->db->insert_id())));
			}

			return $return_val;
	}
}