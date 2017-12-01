<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
	public $templates;
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form', 'date'));
		$this->templates = new League\Plates\Engine(APPPATH . '/views');
	}
}