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
		
		// $this->load->model('shortcode_model');
		// $this->load->model('clicks_model');
		
	}
	
	public function index()
	{
		$this->login();
	}
	
	public function login($data = array())
	{
		// echo 'exit';exit;
		$vars = $this->vars;
		
		$this->load->view('header', $vars);
		$this->load->view('nav_login', $data);
		$this->load->view('login');
		$this->load->view('footer', $data);
	}
	
	public function xyz()
	{
		echo 'abc'; exit;
		$this->load->view('xyz');
	}
}
