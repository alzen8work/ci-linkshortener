<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends MY_Controller {

	protected $controller;
	protected $_table;
	protected $_primary_key;
	
	function __construct()
	{
		parent::__construct();
		$this->controller = 'shortcode';
		$this->load->model('shortcode_model');
		$this->load->model('clicks_model');
		$this->_table = 'urls';
		$this->vars['jscripts'][] = 'var controller="'.$this->controller.'";';
		
	}
	
	public function test_page(){
		echo '<a target="_blank" href="https://demo-alextehkh.c9users.io/u/1njcjb">generate clicks</a><br>'	;
		echo '<a target="_blank" href="https://demo-alextehkh.c9users.io/u/api/1njcjb">analytic page</a>'	;
	}
	
	public function test()
	{
		echo 'page tested!!!<br>Check the clicks in :<br>';
		echo '<a target="_blank" href="https://demo-alextehkh.c9users.io/u/api/1njcjb">analytic page</a>';
	}
	
	//this function will redirect to URL base on the shortcode given to query the DB else go to 404
    public function get_shortcode($shortcode = '') 
    {
		$seg = $this->get_segment();
		
		//get the last segment of the URL
		foreach ($seg as $seg_key => $seg_val){
			if(!empty($seg_val) && $seg_val != 'get_shortcode') {
				$shortcode = $seg_val;        		
			}
		}
		
		if(!empty($shortcode)){
			// $result =  $this->shortcode_model->get_url($shortcode);
			$result = $this->common_model->get_url($shortcode);
			$saved	= '';	
			
			// _debug_array($shortcode);	 exit;
			// _debug_array($result);	 exit;	
			if(!empty($result['success']))
			{
				// _debug_array($result); exit;	
				if(!empty($result['data']['url_id']))
				{
					$data['urls_id']			= $result['data']['url_id'];
					$data['ip'] 				= user_ip();
					$data['referrer'] 			= get_referer_data();
					$ip_info					= ip_info();
					$data['country'] 			= strtoupper($ip_info['country_code']);
					$data['region'] 			= json_encode($ip_info);
					
				
					$data['browser']			= get_browser_data();
					$data['browser_version']	= get_browser_version();
					$data['platform'] 			= get_platform_data();	
					$data['platform_version'] 	= get_platform_data();	
					$data['agent_string'] 		= $this->agent->agent_string(); 
					
					
					$saved = $this->clicks_model->add($data);
				}
			}
			
			if(!empty($saved)){
				
				redirect($result['url']);		
			}else{
				$result['url'] = base_url($shortcode);
				$this->custom_404($result);
			}	
		}
    	
    }

	//query that return empty will redirect here
    function custom_404($arr = array()) 
    {	
		$data['success'] = false;
		
		$data['msg']	 = '';
		if(!empty($arr['url']))
			$data['msg']	 = sprintf($this->lang->line('msg[404_desc]'), '<b>'.$arr['url'].'</b>');
		
		$vars = $this->vars;

		$this->load->view('header', $vars);
		$this->load->view('nav_login', $data);
		$this->load->view('404', $data);
		$this->load->view('footer', $data);
    }

	//generic save doc from <form action=""> of this controller
	function save_doc()
	{
		if(!$_POST) redirect(base_url($this->controller.'/detail'));
		
		$return_val					= array(); 
		$return_val['success'] 		= false;
		if(isset($_POST['processtype']['save'])){
			
			
			$validation_arr = $this->_set_form_validation($this->_table, 1);
			$this->form_validation->set_error_delimiters('&nbsp;','&nbsp;');
			
			if($this->form_validation->run() == false){
				$return_val['msg'] 		= validation_errors(); //ucwords(lang('msg[invalid]'));
			}
			else
			{
				//submitting data
				$result 			= remove_protocols($_POST['urls']['url']);
				$data['url'] 		= remove_url_last_slash($result['url']);
				$data['protocol'] 	= $result['protocol'];
				$gen_result = $this->common_model->gen_url($data);
				// $this->shortcode_model->add($data);
				
				// _debug_array($gen_result); exit;
				if(empty($return_val['success'])){
					$return_val['success'] 	= $gen_result['success'];
					$return_val['msg'] 		= ucwords(lang('msg[generated]'));    		
					$return_val['url'] 		= $gen_result['url'];
				}
				
				// $return_val['url'] 		= base_url(str_replace('=','-', base64_encode($this->db->insert_id())));
				// _debug_array($return_val); exit;
				
			}
		}
		$this->detail($return_val);
	}

	//form of detail page
	public function detail($data=array())
	{
		$vars = $this->vars;

		if(!empty($data['msg'])) {
			$vars['jscripts'][]		= 'var msg="'.$data['msg'].'";';
		}
			
		if(empty($data['url'])) {
			$vars['jscripts'][]		= 'var shortcode="";';
		} else {
			$vars['jscripts'][]		= 'var shortcode="'.$data['url'].'";';
			$vars['jscripts'][]		= 'var swal_title="'.ucwords(lang('btn[your_shorten_url]')).'";';
			$vars['jscripts'][]		= 'var btn_done="'.ucwords(lang('btn[done]')).'";';
			$vars['jscripts'][]		= 'var btn_analytics="'.ucfirst(lang('shorten[analytics]')).'";';
			$vars['jscripts'][]		= 'var copy_url="blablabla";';
			
			
		}
		
		$data['form_action'] = base_url($this->controller.'/save_doc');

		$this->load->view('header', $vars);
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
    public function api_request($shortcode = '') 
    {
		$json_result['success'] = false; 
		$seg	= $this->get_segment();
		
		//get the last segment of the URL
		foreach ($seg as $seg_key => $seg_val) {
			if(!empty($seg_val) && $seg_val != 'api' && $seg_val != 'api_request') {
				$shortcode = $seg_val;        		
			}
		}
		
		if(!empty($shortcode)) {
			$result = $this->common_model->get_url($shortcode);
			//get from urls
			// _debug_array($result); exit;
			if(!empty($result['data']['url_id'])) {
				
				$result['data']['short_url'] = base_url($shortcode);
				
				// get from clicks table
				$json_result = $this->common_model->gen_data($result);
				
				// $this->db->from('clicks');
				// $this->db->where('urls_id', $result['data']['url_id']);
				// $saved = $this->db->count_all_results();
				// _debug_array($saved);
			}
		}
		
		// _debug_array($json_result); exit;
		
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Cache-Control: no-store, no-cache");
		$this->output->set_content_type('application/json')->set_output(json_encode($json_result));
    }
    
	//a request to return statistic of a given shortcode
    public function analytics($got_val=array()) 
    {
		if(empty($got_val)){ redirect(base_url()); } //redirect if no value
    	$result = $this->_validate_analytics();
    	$vars = $this->vars;
    	
   		// _debug_array($result); exit;
   		
    	if(empty($result['success'])) {
			$this->custom_404();
    	} else {
			
    		//scripts
    		$url_arr			= remove_protocols(base_url($result['result']['alias']));
			$vars['jscripts'][]	= 'var shortcode_display="'.$url_arr['url'].'";';
			$vars['jscripts'][]	= 'var shortcode="'.$result['result']['alias'].'";';
			$vars['jscripts'][]	= 'var shortcode_url="'.base_url($result['result']['alias']).'";';
			
			//js files
			$vars['jsfiles'][]	= base_url('__build/analytics_basic.js');   
    	}
    	
    	if(!empty($_GET)) {
    		// _debug_array($_GET);
    		// _debug_array(isset($_GET['all_time']));
    		if(isset($_GET['all_time'])) {
					$vars['jscripts'][] = 'var timeframe = "all_time";';
    		}
    	}
    	
		$data['form_action'] = base_url($this->controller.'/save_doc');

		$this->load->view('header', $vars);
		$this->load->view('nav_login', $data);
		$this->load->view('analytics', $data); //load the single view get_url and send any data to it
		$this->load->view('footer', $data);
    }
    
	function _validate_analytics()
	{	
		$return_val['success'] = false; 
		$seg = $this->get_segment(); // _debug_array('Check Entire Segment'); _debug_array($seg); _debug_array('------------------------------');
		
		//get $param of the URL
    	// _debug_array('$param');
		foreach ($seg as $seg_key => $seg_val) {
			if(!empty($seg_val) && $seg_val != 'shortcode' && $seg_val != 'analytics') 
			$param[] = $seg_val;
		}
    	// _debug_array($param);
    	// _debug_array('------------------------------');
    	
		
    	// _debug_array('$get_base');
    	$get_base = remove_protocols(remove_url_last_slash(base_url()));
    	$base_arr = explode("/",$get_base['url']); 
    	// _debug_array($base_arr); _debug_array('------------------------------');
    	
    	
    	// _debug_array('array_diff exclude base url');
		$left_over_param = array_diff($param,$base_arr);
		// _debug_array($left_over_param);
		// _debug_array('------------------------------');
		
    	// _debug_array('$left_over_param count = 1');
    	//remaining param. counted != 1, 404
    	
    	
    	if(count($left_over_param) == 1) 
    	{
    		// echo 'yes, left over param is 1';
			$left_over_param_val	= array_values($left_over_param)[0];
    		// _debug_array(array_values($left_over_param)[0]);
    		$code_exist				= $this->common_model->code_exist($left_over_param_val);
    		
    		// _debug_array($code_exist);exit;
    		if(!empty($code_exist['success']))
    		{
	    		$return_val['result']	=$code_exist['result'];
				$return_val['success']	= true; 
    		}
    		
    	}
    	
    	
		return $return_val;
	}
	
    //validation methods
	function _set_form_validation($mode = 'urls', $auto_set_rules = '1')
	{		
		$table_1 = 'urls';

		$config['urls'][] =	array(
		    'field' => $table_1.'[url]', 
		    'label' => ucwords(lang('txt[url]')),
		    'rules' => 'trim|required|valid_url|min_length[5]|max_length[250]'); //add callback__validate_code_exist for further functions 

		// need if u need to set rules outside this function, set $auto_set_rules = 0
		if($auto_set_rules == '1') $this->form_validation->set_rules($config[$mode]);
		else return $config[$mode]; 
	}
	
    //callback validation methods
	function _validate_code_exist()
	{
		$arr['field_to_check']	= 'url';
		$arr['field_name']  	= 'url';
		$arr['validate_func'] 	= '_validate_code_exist';
		return $this->shortcode_model->validate_field_exist($arr);
	}
	
	// unused
	public function _user_agent_test()
	{
		_debug_array('USER AGENT');
		echo get_agent();
		// echo $this->agent->agent_string();
		_debug_array('-----------------------------------------------------');
		_debug_array('REFERRER');
		echo get_referer_data();
		_debug_array('-----------------------------------------------------');
		_debug_array('BROWSERS');
		echo get_browser_data();
		echo '<br>';
		echo get_browser_version();
		_debug_array('-----------------------------------------------------');
		_debug_array('PLATFORM');
		echo get_platform_data();
		_debug_array('-----------------------------------------------------');
		_debug_array('mobile');
		echo $this->agent->mobile();
		_debug_array('-----------------------------------------------------');
		_debug_array('$user_ip');
		$user_ip =  user_ip();
		_debug_array($user_ip);
		_debug_array('-----------------------------------------------------');
		_debug_array('$ip_info');
		$ip_info = ip_info();
		_debug_array(json_encode($ip_info));
		_debug_array($ip_info['country_code']);
		_debug_array($ip_info);
		_debug_array('-----------------------------------------------------');
		echo "The time is " . date("h:i:sa");
		echo "<br>My timezone is UTC+08:00, so the time is <br>" ;
		$new_time = date("Y-m-d H:i:s", strtotime('+8 hours'));
		echo $new_time;
		_debug_array('-----------------------------------------------------');
		// $this->load->helper('user_agent');
		// echo '<pre>';
		// var_dump(user_agent());
		_debug_array('-----------------------------------------------------');
		// $test = 'geoip_time_zone_by_country_and_region() is ';
		// $test .= (!function_exists('geoip_time_zone_by_country_and_region'))?' not available ': 'not available';
		// echo '<br><br>'.$test;
		_debug_array('-----------------------------------------------------');
	}
	
	public function _gen_alias(){
		
		$id = 1;
		while($id < 49) {
			$limit						= '1';//set it at session or make it at UI
			$offset 					= '';
			$arr 						= array();
			$arr['limit']				= array($limit,$offset);
			$arr['where_custom'][]		= 'url_id = "'.$id.'"';
			$result 					= $this->shortcode_model->get_by_arr($arr);
			$return_val['result']	= $result['result']->result_array();
			
			if(!empty($return_val['result'])) {
				$data2['alias']		= gen_code($id);
				$where['url_id']	= $id;
				$result_update		= $this->shortcode_model->edit($data2, $where);
			}
			$id = $id + 1;
		}
	}
}
