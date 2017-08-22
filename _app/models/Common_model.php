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
	
	
	function validate_userlogin()
	{
		$return_val['success'] = false;
		$error_msg	= ucwords(lang('msg[login_error]'));
		if($_POST && ($_POST['AUTH_USER']!= '' &&  $_POST['AUTH_PW'] != ''))
		{
			$username 	= $this->db->escape_str($this->input->post('AUTH_USER', TRUE));
			$password 	= $this->db->escape_str(md5($this->input->post('AUTH_PW', TRUE)));
			
			$result_arr	= $this->auth_model->user_login_get_data($username,$password);

			if(!empty($result_arr))
			{
				$return_val['success'] = true;
				if($result_arr[0]['user_active'] != 1)
				{
					$return_val['success'] = false;
					$error_msg  = ucwords(lang('msg[user_susp_error]'));
				}else{
					$_SESSION['user']		= $result_arr[0];
					$return_val['success']	= true;
				}
			}
		}

		if($return_val['success'] == false)
		{
			$this->form_validation->set_message('validate_userlogin', $error_msg);
		}

		return $return_val['success'];
	}

	function validate_captcha($post_value = '', $mode = '')
	{		
		$this->remove_expire_captcha();

		$error_msg 	= ucwords(lang('msg[captcha_error]'));
		// captcha_expired
		$return_val	= false;

		//if file expired file already being remove
		if(!file_exists(sys_captcha_img_path.$_SESSION['captcha']['filename']))
		{
			$error_msg 	= ucwords(lang('msg[captcha_expired]'));
		}
		else
		{			
			if($post_value == $_SESSION['captcha']['word'])
			{
				$return_val = true;
			}
			else
			{
				$return_val = false;
			}
		}

		if(($mode == '') && $return_val == false) 
		{
			$this->form_validation->set_message('validate_captcha', $error_msg);
		}	

		return $return_val;
	}

	function generate_captcha()
	{
		$this->load->helper('captcha_helper');
		$vals = array(
				'img_path'	 => sys_captcha_img_path, //value store at MY_Constant.php
				'img_url'	 => sys_captcha_img_url, //value store at MY_Constant.php
				'img_width'	 => 300,
				'img_height' => 40,
				'font_path'	 => sys_captcha_font_path, //value store at MY_Constant.php
				'font_size'	 => 30,
				'word_length' => 4,
        		'expiration'  => sys_captcha_expiration, //value store at MY_Constant.php
				'pool' 	     => '1234567890'
			);
		$captcha = create_captcha($vals);
		$_SESSION['captcha'] = $captcha;
		return $captcha;
	}

	function remove_expire_captcha()
	{
		//info https://goo.gl/3KMYs9
		$this->load->helper('captcha_helper');
		$vals = array(
				'img_path'	 => sys_captcha_img_path, //value store at MY_Constant.php
				'img_url'	 => sys_captcha_img_url, //value store at MY_Constant.php
				'img_width'	 => 300,
				'img_height' => 40,
				'font_path'	 => sys_captcha_font_path, //value store at MY_Constant.php
				'font_size'	 => 30,
				'word_length' => 4,
        		'expiration'  => sys_captcha_expiration, //value store at MY_Constant.php
				'pool' 	     => '1234567890'
			);
		$captcha = create_captcha($vals);
		return $captcha;
	}
}