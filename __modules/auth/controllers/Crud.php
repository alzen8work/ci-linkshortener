<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends MY_Controller {

	protected $controller;
	protected $_table;
	protected $_primary_key;
	
	function __construct()
	{
		//Authentication
		parent::__construct();
		$this->controller = 'login';
		$this->vars['jscripts'][] = 'var controller="'.$this->controller.'";';
		$this->_table = 'user_account';
		$this->load->model('auth_model');
	}
	
	public function index($data = array())
	{
		if(!empty($_SESSION['user'])) redirect('/');
		// echo 'exit';exit;
		$vars = $this->vars;
		
		$this->load->view('header', $vars);
		$this->load->view('nav_login', $data);
		$this->load->view('login',$data);
		$this->load->view('footer', $data);
	}
	
	function check()
    {
		if(!$_POST || (!isset($_POST['processtype']['login'])) ) redirect(base_url($this->controller));
		
		$return_val['success'] 		= false;
		if(isset($_POST['processtype']['login']))
        {
        	$validate[] = array('field' => 'AUTH_USER', 'label' => ucwords(lang('login[email]')), 'rules' => 'trim|required|callback_validate_userlogin');
        	$validate[] = array('field' => 'AUTH_PW', 'label' => ucwords(lang('login[password]')), 'rules' => 'trim|required');
			$this->form_validation->set_rules($validate);
		
			// $this->form_validation->set_error_delimiters("'","'+");
			if($this->form_validation->run() == false){
				
				$msg = '';
				// _debug_array ( $this->form_validation->error_array() ); exit;
				foreach ( $this->form_validation->error_array() as $key => $val){
					$msg .= '<p>'.$val.'</p>'; 
				}
				$return_val['msg'] =$msg; 
			}
			else
			{				
				redirect('/');
			}
        }
        
		$this->index($return_val);
        
    }

	function z_debug(){
		_debug_array($_SESSION);
	}
	
	function logout()
	{
		$result = '';
		if(!empty($_SESSION)){			
			if(!empty($_SESSION['user']['user_name'])) {
				// $result = $this->auth_model->toggle_login('0');
			}
			unset($_SESSION);
			session_unset();				
			redirect('/');
		}	
	}

	function validate_userlogin()
    {    	
		return $this->common_model->validate_userlogin();		
	}
}
