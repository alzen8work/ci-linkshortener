<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_scut_data extends CI_Migration {

	public function up()
	{
		$this->load->database();	
		$this->_urls();
		$this->_clicks();

	}

	public function down()
	{
		$this->dbforge->drop_table('urls');
		$this->dbforge->drop_table('clicks');
	}


	public function _urls()
	{	  
		$sql = 'DROP TABLE IF EXISTS `urls`;';
		$this->db->query($sql);

		//access log tables;
		$sql="CREATE TABLE urls (
			`url_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`protocol` varchar(255) DEFAULT NULL,
			`url` varchar(255) DEFAULT NULL,
			`alias` varchar(255) DEFAULT NULL,
			PRIMARY KEY (`url_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
	}

	//visitor's clicks
	public function _clicks()
	{	  
		$sql = 'DROP TABLE IF EXISTS `clicks`;';
		$this->db->query($sql);

		//access log tables;
		$sql="CREATE TABLE IF NOT EXISTS `clicks` (
		`clicks_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`urls_id` int(11) NOT NULL,
		`controller_name` varchar(100) NOT NULL DEFAULT '',
		`action_by` int(11) NOT NULL,
		`action_desc` TEXT ,
		`date_modified` datetime NOT NULL,
		PRIMARY KEY (`clicks_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
	}
}