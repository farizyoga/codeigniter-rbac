<?php
if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class File extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->userize->init();

	}

	public function index() {

		print_r($this->userize->getController());

	}

}