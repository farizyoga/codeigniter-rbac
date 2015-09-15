<?php
/*
Author   : Fariz Yoga Syahputra
Facebook : http://www.facebook.com/yoga.aprilio
Github   : http://www.github.com/farizyoga
*/
if ( ! defined('BASEPATH')) exit('No direct access script allowed');

class Userize {

	private $default_role = 3;
	private $system_status = true;
	private $forbidden_controller = 'deny';

	public function init() {

		return $this->isAccessGranted();

	}

	/**
	 * return the ID of logged in user
	 */
	public function getLoggedUser() {

		$CI =& get_instance();
		if ($CI->session->userdata('id_user') != null) {
			return $CI->session->userdata('id_user');
		} else {
			return false;
		}
		
	}

	public function auth($email, $pass) {

		$CI =& get_instance();
		$query = $CI->db->where('email', $email);
		$query = $CI->db->where('password', md5($pass));
		$query = $CI->db->get('users');
		if ($query->num_rows() == 1) {

			$query = $query->row();
			$CI->session->set_userdata('id_user', $query->id_user);
			header('Location:'. $CI->config->item('base_url'). 'welcome');


		} else {

			header('Location:'. $CI->config->item('base_url'). 'nomatch');

		}

	}

	/**
	 * return the current controller accessed by user
	 */
	public function getController() {

		$CI =& get_instance();
		$controller_uri = $CI->router->fetch_directory() . $CI->router->class;
		return $controller_uri;

	}

	/**
	 * return the role of logged in user
	 */
	public function getUserRole() {

		$CI =& get_instance();
		if ($this->getLoggedUser()) {
		
			$CI->db->select('role');
			$CI->db->where('id_user', $this->getLoggedUser());
			$result = $CI->db->get('users')->row();
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
		
			$CI =& get_instance();
			$CI->db->where(array('id_role' => $this->getUserRole(), 'controller_name' => $this->getController()));
			$query = $CI->db->get('controller_access');
			
			if ($query->num_rows() == 0) {

				header('Location:'. $CI->config->item('base_url'). $this->forbidden_controller);

			} 

		}

	}

	
	public function controllerList() {

		$CI =& get_instance();
		$CI->load->helper('directory');
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

		$CI =& get_instance();
		$query = $CI->db->get('controllers')->result();
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

		$CI =& get_instance();
		$choosen_controller = array();
		$query = $CI->db->where('id_role', $role);
		$query = $CI->db->get('controller_access');
		$result = $query->result();

		foreach($result as $result_choosen_controller) {

			$choosen_controller[] = $result_choosen_controller->controller_name;

		}

		$result_free_controller = array_diff($this->getControllerInDB(), $choosen_controller);

		return $result_free_controller;

	}

	public function getUser($request) {

		$CI =& get_instance();
		$CI->db->where('id_user', $this->getLoggedUser());

		if ($request == 'all') {

			$CI->db->select('users.*, roles.*');
			$CI->db->from('users');
			$CI->db->join('roles', 'users.role = roles.id_role');
			$query = $CI->db->get('')->row();
			return $query;

		} else {

			$CI->db->select('users.*, roles.*');
			$CI->db->from('users');
			$CI->db->join('roles', 'users.role = roles.id_role');
			$query = $CI->db->get('')->row();
			return $query->$request;
		}

	}

	public function getAllUsers() {

		$CI =& get_instance();
		$CI->db->select('users.*, roles.*');
		$CI->db->from('users');
		$CI->db->join('roles','roles.id_role = users.role');
		$query = $CI->db->get();
		return $query->result();

	}

	public function getAllRoles() {

		$all_role = array();
		$can = array();
		$CI =& get_instance();
		$roles = $CI->db->get('roles')->result();
		
		foreach($roles as $role) {

			$role->can = $CI->db->where('id_role', $role->id_role)->get('controller_access')->result();

		}

		return $roles;
		
	}

	public function addRole($role) {

		$CI =& get_instance();
		
		if (!$this->_isRoleRegistered($role) == true) {

			$data['role_name'] = $role;
			$CI->db->insert('roles', $data);

		} else {

			return 'Failed to add role, reason: role already registered';

		}

	}

	public function addController($data) {

		$CI =& get_instance();
		$CI->db->insert('controllers', $data);

	}

	public function addControllerAccess($data) {

		$CI =& get_instance();
		$CI->db->insert('controller_access', $data);
		header('Location:'. $CI->config->item('base_url'). 'userize_admin/roles');

	}

	public function isControllerCreated($controller) {

		$CI =& get_instance();
		$CI->db->where('controller_name', $controller);
		$query = $CI->db->get('controllers')->num_rows();

		if ($query > 0) {

			return true;

		} else {

			return false;

		}

	}

	public function deleteAccess($id) {

		$CI =& get_instance();
		$CI->db->where('id',$id);
		$CI->db->delete('controller_access');

	}

	public function getRole($id) 
	{	
		$CI =& get_instance();
		$CI->db->select('role_name');
		$CI->db->where('id_role' , $id);
		$q = $CI->db->get('roles');
		$q = $q->row();
		return $q->role_name;
	}


	private function _isRoleRegistered($role) {

		$CI =& get_instance();
		$CI->db->where('role_name', $role);
		$result = $CI->db->get('roles')->num_rows();

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
