<?php
class Auth_model extends MY_Model {

	protected $_table 		= 'user_account';
	protected $_primary_key	= 'user_id';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	function user_login_get_data($username = '',$password = '')
	{	
		$return_val = '';
		if(!empty($username) && !empty($password))
		{
			$query_str	= "SELECT * FROM ".$this->_table." 
			WHERE user_name = '".$username."' AND user_password = '".$password."' LIMIT 1";

			$query 		= $this->db->query($query_str);			
			$return_val	= $query->result_array();
			
			if(!empty($return_val))
			{
				//unset due to security reasons
				unset($return_val[0]['user_acctype']);
				unset($return_val[0]['user_acl_role']);
				unset($return_val[0]['user_verification']);
				unset($return_val[0]['user_secret_key']);
				// unset($return_val[0]['user_active']);
				unset($return_val[0]['user_last_use']);
				unset($return_val[0]['user_password']);
				unset($return_val[0]['created_by']);
				unset($return_val[0]['created_on']);
				unset($return_val[0]['updated_by']);
				unset($return_val[0]['updated_on']);
			}
		}
		
		return $return_val;
	}
}