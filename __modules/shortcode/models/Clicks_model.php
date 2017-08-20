<?php
class Clicks_model extends MY_Model {

	protected $_table 		= 'clicks';
	protected $_primary_key	= 'clicks_id';
	
	public function __construct()
	{
		parent::__construct();
	}
}