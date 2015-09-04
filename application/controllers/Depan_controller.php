<?php
if (!defined('BASEPATH')) exit('No direct access script allowed');

class Depan_controller extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('depan_model');

	}

	private function tableName() {

		return 'mccontact';

	}

	public function index() {

		echo $this->userize->getUserRole();

	}

}