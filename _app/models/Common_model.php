<?php

Class Common_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function migrate_stable()
	{
		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
			exit;
		}
	}
}