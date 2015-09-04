<?php
if ( !defined('BASEPATH')) exit('No direct access script allowed');

class Depan_model extends CI_Model {

	public function __construct() {

		parent::__construct();

	}

	public function getAllDataContactList() {

		return $this->db->query("SELECT * FROM mccontact INNER JOIN mcorganization ON mcorganization.id = mccontact.organization_id
			 ORDER BY mccontact.id ASC")->result();

	}

}