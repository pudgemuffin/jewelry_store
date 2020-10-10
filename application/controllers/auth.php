<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('loginpermit');
        $this->load->database();
    }
    public function loginform()
    {
        if($this->session->userdata('id')){
            redirect('Welcome');
        }else{
        $this->load->view('login');
        }
    }
    public function login()
    {
        if($this->session->userdata('id')){
            redirect('Welcome');
        }else{
        $this->load->library('session');
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');

        $data = $this->loginpermit->checkuserexist($user,$pass);
        $data1= $this->loginpermit->loginauth($user,$pass);

        if($data[0]->EMP > 0){
            foreach ($data1 as $val){
                $id = $val->Username;
                $fname = $val->FNAME;
                $sname = $val->SNAME;
                $per = $val->per;
                
            }$session_data = array(
                'id' =>$id,
                'Firstname' =>$fname,
                'Surname' =>$sname,
                'Permit' =>$per
            );
            $this->session->set_userdata($session_data);
            // echo $per[0]."<br>";
            // echo $per[1]."<br>";
            // echo $per[2]."<br>";
            // echo $per[3]."<br>";
            // echo $per[4]."<br>";
            // echo $per[5]."<br>";
            // echo $per[6]."<br>";

            redirect('Welcome');
        }else{
            echo "<script> alert ('ไม่พบข้อมูลผู้ใช้งาน')
            window.history.back();
            </script>";
        }
    }
        
    }

    public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('auth/loginform');
	}
}
?>