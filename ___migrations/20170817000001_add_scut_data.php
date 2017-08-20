<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_scut_data extends CI_Migration {

	public function up()
	{
		$this->load->database();	
		$this->_urls();
		$this->_clicks();
		$this->_click_referrer();
		$this->_click_country();
		$this->_click_browser();
		$this->_click_platform();

	}

	public function down()
	{
		$this->dbforge->drop_table('urls');
		$this->dbforge->drop_table('clicks');
		$this->dbforge->drop_table('click_referrer');
		$this->dbforge->drop_table('click_country');
		$this->dbforge->drop_table('click_browser');
		$this->dbforge->drop_table('click_platform');
	}


	public function _urls()
	{	  
		$sql = 'DROP TABLE IF EXISTS `urls`;';
		$this->db->query($sql);
		//create table (`url_id`,`url`,`alias`,`created_on`)
		
		/*
		create table links(
			`url_id`int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
			`url`varchar(255) DEFAULT NULL,
			`alias` varchar(12) DEFAULT NULL,
			`created_on` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
		)
		*/
		
		//access log tables;
		$sql="CREATE TABLE urls (
			`url_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`protocol` varchar(255) DEFAULT NULL,
			`url` varchar(255) DEFAULT NULL,
			`alias` varchar(255) DEFAULT NULL,
			`details` longtext DEFAULT NULL,
			`created_by` varchar(100) NOT NULL DEFAULT '',
			`created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`url_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
		
		// if using mysql 5.6 and above
		// $sql = 'ALTER TABLE urls CHANGE created_on created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;';
		// $this->db->query($sql);
	}

	//visitor's clicks
	//use this for mysql lower than 5.6 
	public function _clicks()
	{	  
		$sql = 'DROP TABLE IF EXISTS `clicks`;';
		$this->db->query($sql);

		//access log tables;
		$sql="CREATE TABLE IF NOT EXISTS `clicks` (
			`clicks_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`urls_id` int(11) NOT NULL,
			`ip` VARCHAR(32) NOT NULL,
			`referrer` varchar(500) NOT NULL,
			`country` varchar(500) NOT NULL,
			`region` TEXT NOT NULL,
			`browser` VARCHAR(500) NOT NULL,
			`browser_version` VARCHAR(500) NOT NULL,
			`platform` VARCHAR(500) NOT NULL,
			`platform_version` VARCHAR(500) NOT NULL,
			`timezone` VARCHAR(64) NOT NULL,
			`agent_string` varchar(500) NOT NULL,
			`created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`clicks_id`),
			UNIQUE KEY `person` (`ip`,`created_on`)
			) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		
		$this->db->query($sql);
		
		// if using mysql 5.6 and above
		// $sql = 'ALTER TABLE clicks CHANGE created_on created_on DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;';
		// $this->db->query($sql);
	}
	
	
	//refferer base
	public function _click_referrer()
	{	  
		$sql = 'DROP TABLE IF EXISTS `click_referrer`;';
		$this->db->query($sql);

		$sql="CREATE TABLE IF NOT EXISTS `click_referrer` (
		`r_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`code` varchar(100) NOT NULL DEFAULT 'unknown',
		`label` varchar(100) NOT NULL DEFAULT 'Unknown/empty',
		PRIMARY KEY (`r_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
	}

	//country base
	public function _click_country()
	{	  
		$sql = 'DROP TABLE IF EXISTS `click_country`;';
		$this->db->query($sql);
		
		$sql="CREATE TABLE IF NOT EXISTS `click_country` (
		`c_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`code` varchar(100) NOT NULL DEFAULT 'unknown',
		`label` varchar(100) NOT NULL DEFAULT 'Unknown/empty',
		PRIMARY KEY (`c_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
	}

	//browsers base
	public function _click_browser()
	{	  
		$sql = 'DROP TABLE IF EXISTS `click_browser`;';
		$this->db->query($sql);

		$sql="CREATE TABLE IF NOT EXISTS `click_browser` (
		`b_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`code` varchar(100) NOT NULL DEFAULT 'unknown',
		`label` varchar(100) NOT NULL DEFAULT 'Unknown/empty',
		PRIMARY KEY (`b_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
	}
	
	//platforms base
	public function _click_platform()
	{	  
		$sql = 'DROP TABLE IF EXISTS `click_platform`;';
		$this->db->query($sql);

		$sql="CREATE TABLE IF NOT EXISTS `click_platform` (
		`p_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`code` varchar(100) NOT NULL DEFAULT 'unknown',
		`label` varchar(100) NOT NULL DEFAULT 'Unknown/empty',
		PRIMARY KEY (`p_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$this->db->query($sql);
	}
}