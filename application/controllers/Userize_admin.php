<?php
if (!defined('BASEPATH')) exit('No direct access script allowed');

class Userize_admin extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper('directory');
		$this->userize->init();

	}

	public function index() {

		$this->load->view('userize/header');
		$this->load->view('userize/index');
		$this->load->view('userize/footer');

	}

	public function users() {

		$data['users'] = $this->userize->getAllUsers();
		$this->load->view('userize/header');
		$this->load->view('userize/users', $data);
		$this->load->view('userize/footer');

	}

	public function roles() {

		$data['roles'] = $this->userize->getAllRoles();
		$this->load->view('userize/header');
		$this->load->view('userize/roles', $data);
		$this->load->view('userize/footer');

	}
	
	public function controllers() {

		$data['menus'] = $this->userize->getValidControllers();
		$this->load->view('userize/header');
		$this->load->view('userize/menu', $data);
		$this->load->view('userize/footer');

	}

	public function assign_access() {

		$data['roles'] = $this->userize->getAllRoles();
		$data['menus'] = $this->userize->getValidControllers();
		$this->load->view('userize/header');
		$this->load->view('userize/assign_access', $data);
		$this->load->view('userize/footer');

	}

	public function get_free_controller_by_role() {

		$role = $this->uri->segment(3);
		$controller_list = $this->userize->getFreeControllersByRole($role);
		$data['list'] = $controller_list;
		$this->load->view('userize/controller_list', $data);

	}

	public function add_controller_access() {

		if ($_POST) {

			foreach($this->input->post('controller') as $access) {
				
				$post['id_role'] = $this->input->post('role');
				$post['controller_name'] = $access;
				$this->userize->addControllerAccess($post);
			}

		}

	}

	public function add_role() {

		$this->load->view('userize/header');
		$this->load->view('userize/add_role');
		$this->load->view('userize/footer');

		if ($_POST) {

			$role = $this->input->post('role');
			$this->userize->addRole($role);

		}

	}

	public function controller_generator() {

		$this->load->view('userize/header');
		$this->load->view('userize/controller_generator');
		if ($_POST) {

			$post['controller_name'] = strtolower($this->input->post('controller_name', true));
			$post['controller_allias'] = $this->input->post('controller_name', true);
			$post['description'] = $this->input->post('description', true);
			if (!$this->userize->isControllerCreated($post['controller_name'])) {

				$this->userize->addController($post);
				$data['file_name'] = $this->input->post('controller_name', true);
				$data['file_location'] = APPPATH . 'controllers/' . $data['file_name'].'.php';
				$this->load->view('userize/generate_controller', $data);	

			} else {

				redirect('userize_admin/controller_already_exist');

			}

		}
		$this->load->view('userize/footer');

	}

}