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
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
