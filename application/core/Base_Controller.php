<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
	public $templates, $created_user, $updated_user;
	public function __construct(){
		parent::__construct();
		# Cargamos la base de datos por defecto
			$this->load->database();
		# Cargamos Helpers basicos
			$this->load->helper(array('url','form', 'date'));
		# Cargamos la libreria para la validacion de los formularios
			$this->load->library(array('form_validation', 'session', 'encrypt'));
		# Configuracion inicial del motor de plantillas Plates
			$this->templates = new League\Plates\Engine(APPPATH . '/views');
			$this->templates->addFolder('partials', APPPATH . '/views/partials');
		# Comprobamos que exista una sesion de usuario creada
			if($this->session->userdata('logueado') == false) redirect(base_url());
		# Seteamos la clave de usuario en variables globales
			$this->created_user = $this->session->userdata() ? $this->session->userdata('cve_usuario') : null;
			$this->updated_user = $this->session->userdata() ? $this->session->userdata('cve_usuario') : null;
	}#asdasdasd

	# Funcion para formatear la fecha a formato Y-m-d
	function str_to_date($string){
		$meses = array("Enero" => "01", "Febrero" => "02", "Marzo" => "03", "Abril" => "04", "Mayo" => "05", "Junio" => "06", "Julio" => "07", "Agosto" => "08", "Septiembre" => "09", "Octubre" => "10", "Noviembre" => "11", "Diciembre" => "12");
		if(!isset($string)) exit(json_encode(array('flag'=>false, 'msj'=>'UNA O VARIAS DE LAS FECHAS NO FUE PROPORCIONADA CORRECTAMENTE')));
		if($string == null) exit(json_encode(array('flag'=>false, 'msj'=>'UNA O VARIAS DE LAS FECHAS ES NULA')));
		if($string == '') exit(json_encode(array('flag'=>false, 'msj'=>'UNA O VARIAS DE LAS FECHAS ES NULA')));
		isset($string)?$fecha=explode("-", $string):exit(array('flag'=>false, 'msj'=>'UNA DE LAS FECHAS NO SE PROPORCIONO CORRECTAMENTE'));
		$date = $fecha[2] . '-' . $meses[$fecha[1]] . '-' . $fecha[0];
		return $date;
	}

	# Funcion para generar un digito de control de codigo de barras
	function generarDigitoControl($barcode) {
		$sum = 0;
		for ($i = 1; $i <= 11; $i += 2)
			$sum += 3 * $barcode[$i];
		for ($i = 0; $i <= 10; $i += 2)
			$sum += $barcode[$i];
		$r = $sum % 10;
		if ($r > 0)
			$r = 10 - $r;
		if ($r > 10 || $r <= 0)
			$r = 4;
		return $r;
	}

}
