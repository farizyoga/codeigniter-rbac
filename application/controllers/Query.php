<?php
if( ! defined('BASEPATH')) exit('No direct access script allowed');

class Query extends CI_Controller {

	public function index() {

		$this->db->select('*');
		$this->db->from('mcpagu');
		$this->db->join('mcspmmak', 'mcpagu.thang = mcspmmak.thang  AND mcpagu.kdakun = mcspmmak.kdakun', 'left');
		$this->db->join('mcppkpagu', 'mcpagu.id = mcppkpagu.idmcpagu', 'left');
		$this->db->join('refppk', 'mcppkpagu.idrefppk = refppk.id', 'left');
		$this->db->join('mcworkingppk', 'refppk.id = mcworkingppk.idrefppk', 'left');
		$this->db->join('refworkingunit' ,'mcworkingppk.idrefworkingunit = refworkingunit.id', 'left');
		$query = $this->db->get();
		var_dump($query->result());

	}

}