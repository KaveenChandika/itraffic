<?php 
/**
 * 
 * @author Kaveen Gunawardhane.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Services_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_users($data){
        $this->db->insert('tbl_users',$data);
    }

    public function insert_vehicle_belong_users($data){
        $this->db->insert('tbl_vehicle_belong_users',$data);
    }
}