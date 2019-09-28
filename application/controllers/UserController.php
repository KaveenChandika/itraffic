<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
		public function __construct(){
			parent:: __construct();
			$this->load->helper('url');
			$this->load->library('session');
		}

		public function check_auth() {
			if (!$this->session->userdata('logged_in')) {
				$this->session->set_flashdata('msg', "You need to be logged in to access the  page.");
				redirect(base_url());
			}else{
				redirect('UserController/home');
			}
		}

		public function logout() {
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('logged_in');
			redirect(base_url());
		}

		// public function flash_message(){
		// 	$this->session->set_flashdata('msg', 'Welcome to CodeIgniter Flash Messages');
		// 	redirect(base_url('welcome_message'));
		// }


		public function login_auth(){
			$this->load->model('../model/Users_Model');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));	
			$data['status'] = $this->Users_Model->login_auth($username,$password);
			if($data['status'] == 1){
				$this->session->set_userdata('logged_in', TRUE);
				echo json_encode($data);
			}else{
				echo json_encode($data);
			}
		}

		public function home(){
			$this->load->view('templates/header_login');
			$this->load->view('welcome_message');
		}

    	public function drivers(){
			$this->load->view('templates/header');
			$this->load->view('drivers');
		}

		public function vehicle_belongs_user_view(){
			$this->load->view('templates/header');
			$this->load->view('vehicle_belongs_user');
		}
		
		public function login_view(){
			$this->load->view('templates/header_login');
			$this->load->view('login');
		}

		public function getUsers(){
			$this->load->model('../model/Users_Model');
			$data['users']=$this->Users_Model->getUsers();
			echo json_encode($data);
			// echo "check";
		}

		public function get_user_belongs_vehicles(){
			$this->load->model('../model/Vehicle_Model');
			$data['vehicleUsers'] = $this->Vehicle_Model->get_user_belongs_vehicles();
			echo json_encode($data);
		}

		public function get_map(){
			$this->load->view('templates/header');
			$this->load->view('map');
		}

		

}