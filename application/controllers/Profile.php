<?php
if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class Profile extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->userize->init();

	}

	public function index() {

		echo "Profile";

	}

}