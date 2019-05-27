<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function getUsers(){
        $query = $this->db->get('tbl_users');
        return $query->result();
    }
}