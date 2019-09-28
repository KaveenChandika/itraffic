<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vehicle_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function get_user_belongs_vehicles(){
        $this->db->select('*');
        $this->db->from('tbl_users tu');
        $this->db->join('tbl_vehicle_belong_users vbu','tu.u_id = vbu.v_u_id');
        $this->db->where('tu.u_type',2);
        $this->db->where('tu.u_status',0);
        $query = $this->db->get();
        return $query->result();
    }
}