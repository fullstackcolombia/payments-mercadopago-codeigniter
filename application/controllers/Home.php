<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $session_role = '';
    private $genClass = 'El';
    private $disClass = 'o';
    private $table = '';
    private $objName = 'Dashboard';
    private $objNames = '';
    private $cName = 'home';
    private $vUrl = 'home';
    private $tplUrl = 'tpl';
    private $o_Requireds = array('----' => '----');
	//Public Key
    private $publicToken = 'TEST-dd6b6bf6-708c-4506-81fd-42b885a2836c';
	//Access Token
    private $accessToken = 'TEST-4430885254264565-031222-dfea53e70dba00bd8c93be990403e76a-727544520';
	
	function __construct() {
        parent::__construct();
		$this->session_role = $this->config->item('session_role_fsc');
    }
	
	function is_logged() {
		if(!$this->session->has_userdata($this->session_role)){
			redirect($this->router->default_controller);
		}
		if($this->config->item('maintenance_fsc')){
			redirect($this->config->item('maintenance_url_fsc'));
		}
    }
	
	function is_config_db() {
        $this->load->model('Test_default_tables', 'comienzo');
        $this->comienzo->default_tables_test();
    }
	
	public function index(){
		if(!is_https() AND $_SERVER['HTTP_HOST'] != '127.0.0.1'){
			redirect('/');
		}
		$this->is_config_db();
		$this->is_logged();
		$this->load->library('mercadopay');
		$us_log = $this->session->userdata($this->session_role);
		$data['us_log'] = $us_log;
		$data['title'] = $this->objName;
		$data['active_menu'] = $this->cName;
		$data['publicToken'] = $this->publicToken;
		$data['accessToken'] = $this->accessToken;
		//*********************************************************************
		$o = $this->default_model->get_one_where('pxo_plan', ['id' => 1]);
		$data['o'] = $o;
		$this->load->library('mercadopay');
		$data['preference'] = $this->mercadopay->probuy($this->accessToken,$o,$us_log->id);
		//*********************************************************************
		$this->load->view($this->tplUrl.'/header', $data);
		$this->load->view($this->vUrl.'/index', $data);
		$this->load->view($this->tplUrl.'/footer', $data);
	}
	
	public function success(){
		$id = $_REQUEST['payment_id'];//Este id se puede guardar en la base de datos para no generar mas registros con esa informacion
		$this->load->library('mercadopay');
		$r = $this->mercadopay->get_payment_fsc($this->accessToken,$id);
		if($r['code'] == 200 AND $r['body']['status'] == 'approved'){
			$o = $this->default_model->get_one_where('pxo_subscription', ['payment_id' => $id]);
			//verificamos que no exista el registro del pago para no hacer duplicados.
			if(empty($o->id)){
				$idplan = $r['body']['additional_info']['items'][0]['id'];
				//$price = $r['body']['additional_info']['items'][0]['unit_price'];
				//$quantity = $r['body']['additional_info']['items'][0]['quantity'];
				//$title = $r['body']['additional_info']['items'][0]['title'];
				$price = $r['body']['transaction_details']['total_paid_amount'];
				$iduser = $r['body']['additional_info']['items'][0]['category_id'];
				//$first_name = $r['body']['payer']['first_name'];
				//$last_name = $r['body']['payer']['last_name'];
				//$phone_code = $r['body']['payer']['phone']['area_code'];
				//$phone = $r['body']['payer']['phone']['number'];
				//$identification_number = $r['body']['payer']['identification']['number'];
				//$identification_type = $r['body']['payer']['identification']['type'];
				$email = $r['body']['payer']['email'];
				//pxo_subscription - pxo_user,pxo_plan,price,state
				$additem = $this->default_model->add_item('pxo_subscription',['user' => $iduser,'plan' => $idplan,'price' => $price,'payment_id' => $id,'state' => 'Aceptado']);
				
				//Descomentarear si se desea notificar
				//Notificar      ****************
				/*$msj = 'Enhorabuena!!! Su pago ha sido completado correctamente.';//Aqui colocar un mensaje
				$this->load->library('ntfsc');
				@$this->ntfsc->mail_fsc($email,$email,'Pago completado',$msj);*/
				//END Notificar  ****************
			}
		}
		$this->is_logged();
		$us_log = $this->session->userdata($this->session_role);
		$data['us_log'] = $us_log;
		$data['title'] = $this->objName;
		$data['active_menu'] = $this->cName;
		$this->load->view($this->tplUrl.'/header', $data);
		$this->load->view($this->vUrl.'/success');
		$this->load->view($this->tplUrl.'/footer', $data);
	}

	public function failure(){
		$this->is_logged();
		$us_log = $this->session->userdata($this->session_role);
		$data['us_log'] = $us_log;
		$data['title'] = $this->objName;
		$data['active_menu'] = $this->cName;
		$this->load->view($this->tplUrl.'/header', $data);
		$this->load->view($this->vUrl.'/failure');
		$this->load->view($this->tplUrl.'/footer', $data);
	}

	public function pending(){
		$this->is_logged();
		$us_log = $this->session->userdata($this->session_role);
		$data['us_log'] = $us_log;
		$data['title'] = $this->objName;
		$data['active_menu'] = $this->cName;
		$this->load->view($this->tplUrl.'/header', $data);
		$this->load->view($this->vUrl.'/pending');
		$this->load->view($this->tplUrl.'/footer', $data);
	}

	//*****************************************************************************
	//************************** SOLO PARA PROBAR *********************************
	//*****************************************************************************
	//*****************************************************************************
	//Ejecutar el siguiente curl para generar un usuario de prueba:
	public function test_user(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/users/test_user');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"site_id\":\"MCO\"}");
		$headers = [];
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Bearer '.$this->accessToken;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		echo $result;exit();
	}
	
	//{"id":727544520,"nickname":"TESTVHEALPGJ","password":"qatest2923","site_status":"active","email":"test_user_24210532@testuser.com"}
	//{"id":727548596,"nickname":"TESTMQPCVF0R","password":"qatest938","site_status":"active","email":"test_user_27423595@testuser.com"}
	//Usuario de prueba
	//"id":727548596
	//"nickname":"TESTMQPCVF0R"
	//"password":"qatest938"
	//"email":"test_user_27423595@testuser.com"
	
	//Tarjeta
	//Mastercard
	//Número
	//5254 1336 7440 3564
	//Código de seguridad
	//123
	//Fecha de vencimiento
	//11/25
	
	/*
	APRO: Pago aprobado.
	CONT: Pago pendiente.
	OTHE: Rechazado por error general.
	CALL: Rechazado con validación para autorizar.
	FUND: Rechazado por monto insuficiente.
	SECU: Rechazado por código de seguridad inválido.
	EXPI: Rechazado por problema con la fecha de expiración.
	FORM: Rechazado por error en formulario.
	*/
}