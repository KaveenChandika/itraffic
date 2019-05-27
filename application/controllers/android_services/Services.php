<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
    public function registration(){
        $this->load->model('../model/Services_Model');
        $response = array();
        if(isset($_REQUEST['jsonString']) &&  $_REQUEST['jsonString'] != ""){
            $response['result'] =true;
            $jsonString = json_decode($_REQUEST['jsonString'],TRUE);
            $uname = $jsonString['users']['u_name'];
            $username = $jsonString['users']['username'];
            $password = $jsonString['users']['password'];
            $umobile = $jsonString['users']['u_mobile'];
            $utel = $jsonString['users']['u_tel'];
            $uaddress = $jsonString['users']['u_address'];
            $uemail = $jsonString['users']['u_email'];
            $utype = $jsonString['users']['u_type'];
            $data = array(
                'u_name'=> $jsonString['users']['u_name'],
                'username'=> $jsonString['users']['username'],
                'password'=> $jsonString['users']['password'],
                'u_mobile'=> $jsonString['users']['u_mobile'],
                'u_tel'=> $jsonString['users']['u_tel'],
                'u_address'=> $jsonString['users']['u_address'],
                'u_email'=> $jsonString['users']['u_email'],
                'u_type'=> $jsonString['users']['u_type'],
                'u_status'=>0
            );
            $this->Services_Model->insert_users($data);
        }else{
            $response['result'] = false;
        }

        echo json_encode($response);
    }
    
}