<?php

class Deny extends CI_Controller {

	public function index() {

		$this->load->view('userize/login');
		if ($this->input->post()) {

			$email = $this->input->post('email', true);
			$pass = $this->input->post('pass', true);	
			$this->userize->auth($email, $pass);

		}	

	}

}