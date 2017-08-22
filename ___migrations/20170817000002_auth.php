<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_auth extends CI_Migration {

	public function up()
	{
		$this->load->database();	
		$this->_user_account();
	}

	public function down()
	{
		$this->dbforge->drop_table('user_account');
	}

	public function _user_account()
	{
      $sql = 'DROP TABLE IF EXISTS `user_account`;';
      $this->db->query($sql);

      $sql = "CREATE TABLE `user_account` (
        `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `user_name` varchar(255) NOT NULL,
        `user_email` varchar(255) NOT NULL,
        `user_password` varchar(255) NOT NULL,
        `user_acctype` char(1) NOT NULL DEFAULT 'U',
        `user_acl_role` int(11) NOT NULL DEFAULT '2',
        `user_verification` varchar(255) NOT NULL DEFAULT '0',
        `user_active` tinyint(1) NOT NULL DEFAULT '0',
        `user_secret_key` varchar(255) NOT NULL DEFAULT '0',
        `user_last_use` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `created_by` varchar(255) DEFAULT NULL,
        `created_on` datetime DEFAULT NULL,
        `updated_by` varchar(255) DEFAULT NULL,
        `updated_on` datetime DEFAULT NULL,
        PRIMARY KEY (`user_id`),
        UNIQUE KEY `user_name` (`user_name`),
        UNIQUE KEY `user_email` (`user_email`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='to store user details for system' AUTO_INCREMENT=1";
      $this->db->query($sql);
      
      $sql = "INSERT INTO `user_account` (`user_name`, `user_email`, `user_password`,
      `user_acctype`, `user_acl_role`, `user_active`, `created_by`, `created_on`, `updated_by`, `updated_on`) 
      VALUES 
      ('admin@lovely.ninja','admin@lovely.ninja',  md5(123), 
      'A','1','1','admin',null,'admin',null),
      ('user@lovely.ninja','user@lovely.ninja', md5(123), 
      'U','2','1','admin',null,'admin',null); ";
      $this->db->query($sql);
	}
}