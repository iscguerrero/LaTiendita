<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Metricas extends Base_Controller {
	function __construct(){
		parent::__construct();
	}

	public function ABC() {
		echo $this->templates->render('Metricas/ABC');
	}
}
