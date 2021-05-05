<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_default_tables extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function default_tables_test() {
        //mysql
		$t = 'pxo_user';
		if (!($this->db->table_exists($t))) {
            //pxo_user --- id,name,email,password,role,foto, (**__** state,created_by,created_at **__**)
            $sql = "CREATE TABLE IF NOT EXISTS `".$t."` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(80),`email` varchar(80),`password` varchar(120),`role` varchar(80),`foto` varchar(80) NULL,`state` varchar(50),`created_by` Integer, `created_at` timestamp NOT NULL DEFAULT now(),UNIQUE KEY `id` (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            $this->db->query($sql);
			$values = array('name' => 'Admin', 'email' => 'admin@fullstackcolombia.com', 'password' => md5('admin'), 'role' => 'administrator', 'state' => 'active', 'created_by' => 0);
            $this->default_model->add_item($t, $values);
			$values = array('name' => 'Jhon Doe', 'email' => 'example@fullstackcolombia.com', 'password' => md5('example'), 'role' => 'invited', 'state' => 'active', 'created_by' => 1);
            $this->default_model->add_item($t, $values);
        }
		$t = 'pxo_mp_fsc';
		if (!($this->db->table_exists($t))) {
            //pxo_mp_fsc --- id,client_id,client_secret,state
            $sql = "CREATE TABLE IF NOT EXISTS `".$t."` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`client_id` varchar(150) NULL,`client_secret` varchar(150) NULL,`state` varchar(50), `created_at` timestamp NOT NULL DEFAULT now(),UNIQUE KEY `id` (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            $this->db->query($sql);
			$values = array('client_id' => '4430885254264565', 'client_secret' => 'TEST-4430885254264565-031222-dfea53e70dba00bd8c93be990403e76a-727544520', 'state' => 'active');
            $this->default_model->add_item($t, $values);
        }
		$t = 'pxo_plan';
		if (!($this->db->table_exists($t))) {
            $sql = "CREATE TABLE IF NOT EXISTS `".$t."` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`title` varchar(150) NULL,`price` float,`state` varchar(50), `created_at` timestamp NOT NULL DEFAULT now(),UNIQUE KEY `id` (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            $this->db->query($sql);
			$values = array('title' => 'Plan de ejemplo','price' => 628, 'state' => 'active');
            $this->default_model->add_item($t, $values);
        }
		$t = 'pxo_subscription';
		if (!($this->db->table_exists($t))) {
            //pxo_subscription - user,plan,price,payment_id,state
			$sql = "CREATE TABLE IF NOT EXISTS `".$t."` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`user` Integer,`pxo_plan` Integer,`price` float,`payment_id` varchar(50),`state` varchar(50), `created_at` timestamp NOT NULL DEFAULT now(),UNIQUE KEY `id` (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
            $this->db->query($sql);
        }
		//
    }
}