<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends MY_Controller {

	protected  $controller;

	function __construct()
	{
		parent::__construct();
	}
	
	//this function will redirect to URL base on the shortcode given to query the DB else go to 404
    public function get_shortcode($shortcode = '') 
    {
    	
		echo 'test get_shortcode';
    }

	//query that return empty will redirect here
    function custom_404($arr = array()) 
    {	
		echo 'test custom_404';
    }

	//generic save doc from <form action=""> of this controller
	function save_doc()
	{
		echo 'test save_doc';
	}

	//form of detail page
	public function detail($data=array())
	{
		echo 'test detail';
	}

	//listing page	
	public function index()
	{
		echo 'test index';
    }

	//a request to return statistic of a given shortcode
    function api_request()
    {
    	echo 'test api_request'; exit;
    }
}
