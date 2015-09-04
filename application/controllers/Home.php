<?php
if (!defined('BASEPATH')) exit('No direct access script allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper('directory');
		$this->userize->init();

	}

	public function index() {

		print_r($this->userize->getController());

	}

}