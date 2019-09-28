<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function getUsers(){
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('u_type',2);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @user authentication
     */
    public function login_auth($username,$password){
        $query = $this->db->query('select * from tbl_users where username="'.$username.'" and password="'.$password.'" and u_type = 1');
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;   
        }
    }
}