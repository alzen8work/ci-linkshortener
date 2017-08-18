<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends MY_Controller {

	protected  $controller;

	function __construct()
	{
		parent::__construct();
		$this->controller = 'shortcode';
	}
	
	//this function will redirect to URL base on the shortcode given to query the DB else go to 404
    public function get_shortcode($shortcode = '') 
    {
    	
		echo 'test get_shortcode';
    }

	//query that return empty will redirect here
    function custom_404($arr = array()) 
    {	
		$data['success'] = false;
		
		$data['msg']	 = '';
		if(!empty($arr['url']))
			$data['msg']	 = sprintf($this->lang->line('msg[404_desc]'), '<b>'.$arr['url'].'</b>');
		
		$data['cssfiles'] 	= $this->vars['cssfiles'];
		$data['jsfiles'] 	= $this->vars['jsfiles'];
		$data['jscripts'] 	= $this->vars['jscripts'];

		$this->load->view('header', $data);
		$this->load->view('nav_login', $data);
		$this->load->view('404', $data);
		$this->load->view('footer', $data);
    }

	//generic save doc from <form action=""> of this controller
	function save_doc()
	{
		echo 'test save_doc';
		if($_POST){
			_debug_array($_POST); exit;
		}
	}

	//form of detail page
	public function detail($data=array())
	{
		$this->vars['jscripts'][]	= 'var controller="'.$this->controller.'";';
		$this->vars['jscripts'][]	= 'var swal_title="'.ucwords(lang('btn[your_shorten_url]')).'";';
		$this->vars['jscripts'][]	= 'var copy_url="'.ucwords(lang('btn[copy_url]')).'";';
		$this->vars['jscripts'][]	= 'var btn_done="'.ucwords(lang('btn[done]')).'";';

		if(!empty($data['msg'])) $this->vars['jscripts'][]	= 'var msg="'.$data['msg'].'";';
		if(empty($data['url'])) $this->vars['jscripts'][]	= 'var shortcode="";';
		else $this->vars['jscripts'][]						= 'var shortcode="'.$data['url'].'";';
		
		$data['cssfiles'] 	= $this->vars['cssfiles'];
		$data['jsfiles'] 	= $this->vars['jsfiles'];
		$data['jscripts'] 	= $this->vars['jscripts'];
		$data['form_action'] = base_url($this->controller.'/save_doc');

		$this->load->view('header', $data);
		$this->load->view('nav_login', $data);
		$this->load->view('detail', $data); //load the single view get_url and send any data to it
		$this->load->view('footer', $data);
	}

	//listing page	
	public function index()
	{
		$this->detail();
    }

	//a request to return statistic of a given shortcode
    function api_request()
    {
    	echo 'test api_request'; exit;
    }
}
