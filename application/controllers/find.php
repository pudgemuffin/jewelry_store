<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class find extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('detail');
        $this->load->database();
    }
    public function searchemp()
    {
        $txtsearch = $this->input->post('semp');
        $data['result'] = $this->detail->empdata($txtsearch);
        $data['view'] = "Detail/emp";
		$this->load->view('index',$data);
    }
}
?>