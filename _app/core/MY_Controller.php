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


		$this->vars['jscripts'][]		= 'var base_url="'.base_url().'";';


		$this->vars['body']['id']	    = '';
		$this->vars['body']['class']	= ' skin-blue fixed sidebar-mini sidebar-mini-expand-feature ';
// 		$this->vars['body']['style']	= ' height: auto; min-height: 100%; ';
		$this->vars['body']['style']	= '';


		$this->top_nav['user_name']	=
		$this->sidebar['user_name']	= 'Alzen8work';

		$this->data['vars'] 	= $this->vars;
		$this->data['top_nav']  = $this->top_nav;
		$this->data['sidebar']  = $this->sidebar;
		
		$_SESSION['language'] = 'english';
        $current_language 	= $this->session->userdata('language'); //'','english', 'chinese_simplified'	        
		$this->lang->load('custom_text', $current_language); 
		
		$this->load->library('migration'); 	// if migration_auto_latest is set to true // will skip below code

        $this->load->model('common_model');
		$this->common_model->migrate_stable();  // for stable release 	


		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js';  

		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css';
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js';

		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/AdminLTE.min.css';
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/css/skins/_all-skins.min.css'; 
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.11/js/app.js'; 


		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css';
		$this->vars['jsfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js';  

		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
		$this->vars['cssfiles'][]	= 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.10/font-awesome-animation.min.css';


		$this->vars['cssfiles'][]	= base_url('assets/app.css');  
		$this->vars['jsfiles'][]	= base_url('assets/app.js');  

		$this->vars['jscripts'][]	= 'var base_url="'.base_url().'";';
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
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
