<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
    public function __construct(){
		    parent:: __construct();
			$this->load->helper('url');
			$this->load->library('session');
			$this->load->database();
	}
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
            $vnumber = $jsonString['users']['v_number'];
            $vname = $jsonString['users']['v_name'];
            $vtype = $jsonString['users']['v_type'];
            $latitude = $jsonString['users']['latitude'];
            $longitude = $jsonString['users']['longitude'];
            $data = array(
                'u_name'=> $jsonString['users']['u_name'],
                'username'=> $jsonString['users']['username'],
                'password'=> md5($jsonString['users']['password']),
                'u_mobile'=> $jsonString['users']['u_mobile'],
                'u_tel'=> $jsonString['users']['u_tel'],
                'u_address'=> $jsonString['users']['u_address'],
                'u_email'=> $jsonString['users']['u_email'],
                'u_type'=> $jsonString['users']['u_type'],
                'u_status'=>0
            );
            $this->Services_Model->insert_users($data);
            
            $this->db->select('u_id');
            $this->db->from('tbl_users');
            $this->db->where('u_type',2);
            $this->db->order_by('u_id','desc');
            $this->db->limit('1');
            $dataSet = $this->db->get();
            $result = $dataSet->result();


            $dataVehicle = array(
                'v_u_id'=>$result[0]->u_id,
                'v_number'=>$vnumber,
                'v_type'=>$vtype,
                'latitude'=>$latitude,
                'longtitude'=>$longitude,
                'v_status'=>0
            );
            $this->Services_Model->insert_vehicle_belong_users($dataVehicle);

        }else{
            $response['result'] = false;
        }

        echo json_encode($response);
    }

    public function dataSend(){
    //   if (isset($_GET['id']) && isset($_GET['value'])) {
            $array_set = array();
            $results = array();
            $lat = $_GET['id'];
    		$lon = $_GET['value'];
    // 		$array_set['lat'] = $lat;
    // 		$array_set['lon'] = $lon;
    // 	    array_push($results,$array_set);
    		$gpsData = array(
                'lat'=>$lat,
                'lon'=>$lon
            );
            $this->db->insert('tbl_gps',$gpsData);
            $myfile = fopen(__DIR__.'/gpsTracker.json', "w") or die("Unable to open file!");
            fwrite($myfile,json_encode($_GET['id']));
            fclose($myfile);
        // }
        
        	
        
    }
    
    public function getLatitute(){
        $nic = $_REQUEST['nic'];   
        $pin = $_REQUEST['pin'];           
        $results = array();
        $results['data'] = array();
        $result = $this->db->query("SELECT * FROM `userdetails` WHERE nic = '$nic' AND pin = '$pin'");
        // while($row = mysqli_fetch_array($result)){
        //     array_push($results['data'],$row);
        // }
        
        foreach($result->result() as $res){
             array_push($results['data'],$res);
        }
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($results);
    }
    
    public function getLatituteForMap_1(){
        $nic = $_REQUEST['nic']; 
        $results = array();
        $results['data'] = array();
        $sql = $this->db->query("SELECT * FROM `userdetails` WHERE nic = '$nic' ");
        foreach($sql->result() as $res){
          array_push($results['data'],$res);
        }
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($results);
    }
    
    public function getLatituteForMap_2(){
        $nic = $_REQUEST['nic']; 
        $results = array();
        $results['data'] = array();
        $sql = $this->db->query("SELECT * FROM `userdetails` WHERE nic = '$nic' ");
        foreach($sql->result() as $res){
          array_push($results['data'],$res);
        }
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($results);
    }
    
    public function getLatituteForMap_3(){
        $nic = $_REQUEST['nic']; 
        $results = array();
        $results['data'] = array();
        $sql = $this->db->query("SELECT * FROM `userdetails` WHERE nic = '$nic' ");
        foreach($sql->result() as $res){
          array_push($results['data'],$res);
        }
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($results);
    }
    
    public function getMaxblId(){
        $results = array();
        $results['data'] = array();
        $sql = $this->db->query("SELECT MAX(tblid) AS tblid FROM `invitecoretravel` ");
        
        // while($row = mysqli_fetch_array($result)){
        //   array_push($results['data'],$row);
        // }
        
        foreach($sql->result() as $res){
            array_push($results['data'],$res);
        }
        
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($results);
    }
    
    public function inviteCoreTravel(){
        $tblid = $_REQUEST['tblid'];  
    	$nic = $_REQUEST['nic'];  
    	$emptysheets = $_REQUEST['emptysheets'];
    	$startlocation = $_REQUEST['startlocation'];  
    	$endlocation = $_REQUEST['endlocation'];   
    	$showphone = $_REQUEST['showphone'];  
    	$comptime = $_REQUEST['comptime'];   
    	$status = $_REQUEST['status'];  

    	$result = $this->db->query("INSERT INTO inviteCoreTravel(tblid,nic,emptysheets,startlocation,endlocation,showphone, comptime,status) VALUES ('$tblid','$nic' , '$emptysheets' , '$startlocation' , '$endlocation' ,'$showphone' , '$comptime','$status')"); 
    	if($result == true){
    		header('Content-type: application/json');
    		echo json_encode("1");
    	}else{
    		header('Content-type: application/json');
    		echo json_encode("0");
    	}
    }
    
    public function LoginU(){
        $nic = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $results = array();
        $results['data'] = array();
          
        $result = $this->db->query("SELECT nic,password FROM `userdetails` WHERE nic = '$nic' AND password = '$password' "); 
        
            $response = array();
            $response["success"] = false;  
            
           foreach($result->result() as $statement){
                $response["success"] = true;  
        
                $response["nic"] =$statement->nic;
                $response["password"] = $statement->password;
            }
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($response);
    }
    
    public function searchCoreTravel(){
        $nic = $_REQUEST['nic']; 
        $results = array();
        $results['data'] = array();
          
        $result = $this->db->query("SELECT * FROM `invitecoretravel` WHERE nic = '$nic' "); 
        
        foreach($result->result() as $row){
          array_push($results['data'],$row);
        }
        // /* Output header */
         header('Content-type: application/json');
         echo json_encode($results);
    }
    
}