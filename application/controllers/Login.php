<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

    private $session_role = '';
    private $genClass = 'El';
    private $disClass = 'o';
    private $table = 'pxo_user';
    private $objName = 'Usuario';
    private $objNames = 'Usuarios';
    private $cName = 'login';
    private $vUrl = 'auth';
    private $tplUrl = 'tpl';
    private $o_Requireds = array('email' => 'Correo', 'password' => 'Contrase&ntilde;a');

    function __construct() {
        parent::__construct();
		$this->session_role = $this->config->item('session_role_fsc');
    }
	
	function is_logged() {
		if($this->session->has_userdata($this->session_role)){
			redirect($this->config->item('default_controller_home'));
		}
		if($this->config->item('maintenance_fsc')){
			redirect($this->config->item('maintenance_url_fsc'));
		}
    }
	
	function is_config_db() {
        $this->load->model('Test_default_tables', 'comienzo');
        $this->comienzo->default_tables_test();
    }

    public function index() {
        if(!is_https() AND $_SERVER['HTTP_HOST'] != '127.0.0.1'){
			redirect('/');
		}
		$this->is_logged();//Aqui pregunta si esta logueado lo envia a home
        $this->is_config_db();//Para cuando se ejecute la app por primera ves se creen las tablas
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $o_required = $this->o_Requireds;
        $data['error_credenciales'] = FALSE;
        if (count($o_required) > 0) {
            foreach ($o_required as $key => $row) {
                $this->form_validation->set_rules($key, '<em>' . $row . '</em>', 'trim|required');
            }
        }
        if (!empty($_POST)) {
            if ($this->form_validation->run() == TRUE) {
                $o = $this->default_model->get_one_where($this->table, ['email' => $_POST['email'], 'password' => md5($_POST['password'])]);
                if (!empty($o->id) AND $o->state == 'active') {
                    $this->session->set_userdata($this->session_role, $o);
                    redirect($this->config->item('default_controller_home'));
                }
                $data['error_credenciales'] = TRUE;
            }
        }
        $data['title'] = 'Inicio de sesi&oacute;n';
        $this->load->view($this->vUrl . '/' . $this->cName, $data);
    }

    public function logout() {
        if ($this->session->has_userdata($this->session_role)) {
            $this->session->unset_userdata($this->session_role);
        }
		redirect($this->cName);
    }

}