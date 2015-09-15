<?php
/*
Author   : Fariz Yoga Syahputra
Facebook : http://www.facebook.com/yoga.aprilio
Github   : http://www.github.com/farizyoga
*/
if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class Userization_model extends CI_Model {

	private $default_role = 3;
	private $system_status = false;
	private $forbidden_controller = 'deny';

	public function init() {

		return $this->isAccessGranted();

	}

	/**
	 * return the ID of logged in user
	 */
	public function getLoggedUser() {

		if ($this->session->userdata('id_user') != null) {
			return $this->session->userdata('id_user');
		} else {
			return false;
		}
		
	}

	public function auth($email, $pass) {
		
		$query = $this->db->where('email', $email);
		$query = $this->db->where('password', md5($pass));
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {

			$query = $query->row();
			$this->session->set_userdata('id_user', $query->id_user);
			redirect('userize_admin');

		} else {

			redirect('nomatch');

		}

	}

	/**
	 * return the current controller accessed by user
	 */
	public function getController() {
		
		$controller_uri = $this->router->fetch_directory() . $this->router->class;
		return $controller_uri;

	}

	/**
	 * return the role of logged in user
	 */
	public function getUserRole() {
	
		if ($this->getLoggedUser()) {
		
			$this->db->select('role');
			$this->db->where('id_user', $this->getLoggedUser());
			$result = $this->db->get('users')->row();
			return $result->role;

		} else {

			return $this->default_role;

		}

	}

	/**
	 * if user doesn't have access to the controller, redirect user to somewhere
	 */
	public function isAccessGranted() {

		if ($this->system_status) {
		
			$this->db->where(array('id_role' => $this->getUserRole(), 'controller_name' => $this->getController()));
			$query = $this->db->get('controller_access');
			
			if ($query->num_rows() == 0) {

				redirect(base_url($this->forbidden_controller));

			} 

		}

	}
	
	public function controllerList() {
		
		$this->load->helper('directory');
		$rootpath = 'application/controllers/';
		$fileinfos = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootpath));

		foreach($fileinfos as $pathname => $fileinfo) {


    		if (!$fileinfo->isFile()) continue;
    		if ($this->_secureReturnedFileName($pathname) == '') continue;
    		$result[] = $this->_secureReturnedFileName($pathname);
		}
		
		return $result;

	}

	public function getControllerInDB() {

		$query = $this->db->get('controllers')->result();
		foreach($query as $controller) {

			$data[] = $controller->controller_name;

		}
		return $data;

	}

	public function getValidControllers() {

		$controller = array_intersect($this->getControllerInDB(), $this->controllerList());
		return $controller;

	}

	public function getFreeControllersByRole($role) {
		
		$choosen_controller = array();
		$query = $this->db->where('id_role', $role);
		$query = $this->db->get('controller_access');
		$result = $query->result();

		foreach($result as $result_choosen_controller) {

			$choosen_controller[] = $result_choosen_controller->controller_name;

		}

		$result_free_controller = array_diff($this->getControllerInDB(), $choosen_controller);

		return $result_free_controller;

	}

	public function getUser($request) {
	
		$this->db->where('id_user', $this->getLoggedUser());

		if ($request == 'all') {

			$this->db->select('users.*, roles.*');
			$this->db->from('users');
			$this->db->join('roles', 'users.role = roles.id_role');
			$query = $this->db->get('')->row();
			return $query;

		} else {

			$this->db->select('users.*, roles.*');
			$this->db->from('users');
			$this->db->join('roles', 'users.role = roles.id_role');
			$query = $this->db->get('')->row();
			return $query->$request;
		}

	}

	public function getAllUsers() {

		
		$this->db->select('users.*, roles.*');
		$this->db->from('users');
		$this->db->join('roles','roles.id_role = users.role');
		$query = $this->db->get();
		return $query->result();

	}

	public function getAllRoles() {

		$all_role = array();
		$can = array();
		
		$roles = $this->db->get('roles')->result();
		
		foreach($roles as $role) {

			$role->can = $this->db->where('id_role', $role->id_role)->get('controller_access')->result();

		}

		return $roles;
		
	}

	public function addRole($role) {

		
		
		if (!$this->_isRoleRegistered($role) == true) {

			$data['role_name'] = $role;
			$this->db->insert('roles', $data);

		} else {

			return 'Failed to add role, reason: role already registered';

		}

	}

	public function addController($data) {
	
		$this->db->insert('controllers', $data);

	}

	public function addControllerAccess($data) {

		$this->db->insert('controller_access', $data);
		redirect('userize_admin/roles');

	}

	public function isControllerCreated($controller) {
	
		$this->db->where('controller_name', $controller);
		$query = $this->db->get('controllers')->num_rows();

		if ($query > 0) {

			return true;

		} else {

			return false;

		}

	}

	public function deleteAccess($id) {
		
		$this->db->where('id',$id);
		$this->db->delete('controller_access');

	}

	public function getRole($id) {	
		
		$this->db->select('role_name');
		$this->db->where('id_role' , $id);
		$q = $this->db->get('roles');
		$q = $q->row();
		return $q->role_name;
	}


	private function _isRoleRegistered($role) {
	
		$this->db->where('role_name', $role);
		$result = $this->db->get('roles')->num_rows();

		if ($result == 1) {

			return true;

		} else {

			return false;

		}

	}


	private function _secureReturnedFileName($file) {

		$permitted_file_extension = '.php';
		
		if (strpos($file, $permitted_file_extension) == TRUE) {

			$secure = str_replace(array('.php','application/controllers/'),'',strtolower($file));
			return $secure;

		} 

	}

}
