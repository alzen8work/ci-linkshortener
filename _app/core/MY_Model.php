<?php
//application/models/

class MY_Model extends CI_Model
{
	protected $_table = null;
	protected $_primary_key = null;

	//------------------------------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}
}