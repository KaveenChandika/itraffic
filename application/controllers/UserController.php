<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    	public function drivers(){
			$this->load->view('templates/header');
			$this->load->view('drivers');
		}

		public function getUsers(){
			$this->load->model('../model/Users_Model');
			$data['users']=$this->Users_Model->getUsers();
			echo json_encode($data);
			// echo "check";
		}

}