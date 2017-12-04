<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Punto extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function Index() {
		echo $this->templates->render('Punto/Inicio');
	}#sdsdfsdf
}
