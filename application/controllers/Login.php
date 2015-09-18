<?php
if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class Login extends CI_Controller {

	public function index() {

		$this->load->view('login');
		if ($this->input->post()) {

			$email = $this->input->post('email', true);
			$pass = $this->input->post('password', true);
			$this->load->model('userize');
			$this->userize->auth($email, $pass);

		}

	}

}