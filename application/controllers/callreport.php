<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class callreport extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('reportdb');
        $this->load->database();
    }

    public function callreportamount()
    {   
        $ld = date('Y-m-d');
        $dates = date('Y-m-01');
        $daten =  date("Y-m-t", strtotime($ld));
     
        $data['view'] = "report/reportamount";
        $data['reportpro'] = $this->reportdb->reportamountbytimepro($dates,$daten);
        $data['reportple'] = $this->reportdb->reportamountbytimeple($dates,$daten);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
       
        $this->load->view('actionindex', $data);
    }

    public function inputdate()
    {
        $dates = $this->input->post('dates');
        $daten = $this->input->post('daten');

        $data['reportpro'] = $this->reportdb->reportamountbytimepro($dates,$daten);
        $data['reportple'] = $this->reportdb->reportamountbytimeple($dates,$daten);

        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportamount";
        $this->load->view('actionindex', $data);
    }

    public function crosstab()
    {
        $y = date('Y');
        $data['cross'] = $this->reportdb->reportcrosspro($y);
        $data['ple'] = $this->reportdb->reportcrossple($y);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportcrosstab";
        $this->load->view('actionindex', $data);
    }


}

?>