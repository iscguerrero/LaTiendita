<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventarios extends Base_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function Index() {
		echo $this->templates->render('Inventarios/Index');
	}
}
