<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

/**
 * Description of my_controller
 *
 * @author http://roytuts.com
 */
class MY_Controller extends MX_Controller
{
	protected $vars				= array();
	protected $top_nav			= array();
	protected $sidebar			= array();
	protected $data				= array();
	
    function __construct() {
        parent::__construct();
        if (version_compare(CI_VERSION, '2.1.0', '<')) {
            $this->load->library('security');
        }
		include_once(APPPATH.'core/MY_Constant.php');
		
		//fix callback form_validation
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->form_validation->CI =& $this;
		
		$this->get_language();
		
		$this->vars['jscripts']			= array();
		$this->vars['jsfiles']			= array();
		$this->vars['cssfiles']			= array();
		$this->vars['metaheaders']		= array();

		$this->vars['metaheaders'][]	= 'charset="utf-8"';
		$this->vars['metaheaders'][]	= 'http-equiv="Content-Type" content="text/html; charset=utf-8"';
		$this->vars['metaheaders'][]	= 'http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"';
		$this->vars['metaheaders'][]	= 'http-equiv="Pragma" content="no-cache"';
		$this->vars['metaheaders'][]	= 'http-equiv="Expires" content="0"';
		$this->vars['metaheaders'][]	= 'http-equiv="Cache-control" content="no-cache"';
		$this->vars['metaheaders'][]	= 'content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"';



		$this->vars['body']['id']	    = '';
		$this->vars['body']['class']	= ' skin-blue fixed sidebar-mini sidebar-mini-expand-feature ';
// 		$this->vars['body']['style']	= ' height: auto; min-height: 100%; ';
		$this->vars['body']['style']	= '';
		
		$this->top_nav['user_name']	=
		$this->sidebar['user_name']	= 'Alzen8work';

		$this->data['vars'] 	= $this->vars;
		$this->data['top_nav']  = $this->top_nav;
		$this->data['sidebar']  = $this->sidebar;
		
		
		
		
		$this->load->library('migration'); 	// if migration_auto_latest is set to true // will skip below code
        $this->load->model('common_model');
		$this->common_model->migrate_stable();  //for stable release 	
		
		if(ENVIRONMENT == 'development'){
			$this->vars['jscripts'][]		= 'const proj_dev ="'.ENVIRONMENT.'";';
			$this->for_development();//before grunt concat
		}else{
			// $this->for_production(); //after grunt concat 
		}
		
		$this->vars['jscripts'][]	= 'var base_url="'.base_url().'";';
    }
    
	function for_development() {
		//vendor jquery
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js';  
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js';  
		

		//vendor bootstrap
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css';
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js';
		
		//vendor theme AdminLTE
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css';
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/skins/_all-skins.min.css'; 
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.js'; 

		//vendor sweetalert1
		// $this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css';
		// $this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js';
		
		
		//vendor sweetalert2
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css';
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js';  
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js';  
		

		//vendor fontawesome
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css';

		//chartjs only
		// $this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js';  
		//chartjs + momentjs
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js';  
		
		$this->vars['cssfiles'][]	= base_url('__build/app.css');  
		$this->vars['jsfiles'][]	= base_url('__build/common.js');
		$this->vars['jsfiles'][]	= base_url('__build/app.js?123');  
	}
	
	function for_production() {
		$this->vars['cssfiles'][]	= base_url('assets/app.css');  
		$this->vars['jsfiles'][]	= base_url('assets/app.js');  
	}

	function get_segment()
	{		
		$seg = 1;
		$segment = array();
		while ($seg != 0)
		{							
			$seg_info 	= '';
				
			$segment[] = $seg_info = $this->uri->segment($seg);
							
			if($seg_info != ''){
				//~ echo $seg_info; echo '';
				$seg++;	
			}
			else
			{	
				$seg = 0;
				return $segment;
			}				
		}
	}
    
    function get_language($lang = 'english') {
    	
    	if(empty($_SESSION['language'])) {
    		$_SESSION['language'] = 'english'; //'','english', 'chinese_simplified'
    	}
    	
    	if(!empty($_GET['lang'])) {
			$lang =	(empty($_GET['lang']))?'english':$_GET['lang'];
	    	if($_SESSION['language'] != $lang) {
	    		$_SESSION['language'] = $lang; 
	    	}
    	}
    	
		$this->lang->load('custom_text', $_SESSION['language']); 
    }
    
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
