<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/vendor/autoload.php";

class Mercadopay {

	protected $CI;

	public function __construct() {
        $this->CI =& get_instance();
    }

	public function probuy($accessToken,$params,$id = 0){
		MercadoPago\SDK::initialize();
		$config = MercadoPago\SDK::config();
		$config->set('ACCESS_TOKEN', $accessToken);
		$preference = new MercadoPago\Preference();
		$item = new MercadoPago\Item();
		$item->id = $params->id;
		$item->title = $params->title;
		$item->quantity = 1;
		$item->currency_id = "COP";//Cambiar por UYU
		$item->category_id = $id;
		$item->unit_price = intval($params->price);//El valor de unit_price debe ser entero.
		$preference->items = array($item);
		$preference->back_urls = array(
			"success" => site_url('home/success'),
			"failure" => site_url('home/failure'),
			"pending" => site_url('home/pending')
		);
		$preference->auto_return = "approved";
		
		$preference->save();
		return $preference;
	}
	
	public function payment_methods_fsc($accessToken){
		MercadoPago\SDK::setAccessToken($accessToken);
		$payment_methods = MercadoPago\SDK::get("/v1/payment_methods");
		return $payment_methods;
	}
	
	public function get_payment_fsc($accessToken,$id){
		MercadoPago\SDK::setAccessToken($accessToken);
		$out = MercadoPago\SDK::get("/v1/payments/".$id);
		return $out;
	}
}