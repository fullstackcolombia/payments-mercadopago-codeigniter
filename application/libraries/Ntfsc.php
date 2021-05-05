<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ntfsc {

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }
	
	public function mail_fsc($email_to, $name_to, $subject, $body, $uploadfile = ''){
		$this->CI->load->library('email');
		$configFss = array(
		'protocol' => 'smtp',
		'smtp_host' => $this->CI->config->item('fsc_mail_smtp_host'),
		'smtp_port' => $this->CI->config->item('fsc_mail_smtp_port'),
		'smtp_user' => $this->CI->config->item('fsc_mail_smtp_user'),
		'smtp_pass' => $this->CI->config->item('fsc_mail_smtp_pass'),
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'newline' => "\r\n");
		$this->CI->email->initialize($configFss);
		$this->CI->email->from($this->CI->config->item('fsc_mail_from'), $this->CI->config->item('fsc_mail_name'));
		$this->CI->email->to($email_to);
		$this->CI->email->subject($subject);
		$this->CI->email->message($body);
		if(!empty($uploadfile)){
			$this->CI->email->attach($uploadfile);
		}
		$this->CI->email->send();
	}
}