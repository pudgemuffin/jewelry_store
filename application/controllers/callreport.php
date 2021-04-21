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

    public function inputcrosstab()
    {
        $year = $this->input->post('year');
        $data['cross'] = $this->reportdb->reportcrosspro($year);
        $data['ple'] = $this->reportdb->reportcrossple($year);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportcrosstab";
        $this->load->view('actionindex', $data);
    }

    public function reportpledge()
    {
        $ld = date('Y-m-d');
        $dates = date('Y-m-01');
        $daten =  date("Y-m-t", strtotime($ld));
        $data['over'] = $this->reportdb->reportpledgeover($dates,$daten);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportpledge";
        $this->load->view('actionindex', $data);
    }

    public function inputpledge()
    {
        $dates = $this->input->post('dates');
        $daten = $this->input->post('daten');

        $data['over'] = $this->reportdb->reportpledgeover($dates,$daten);


        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportpledge";
        $this->load->view('actionindex', $data);
    }

    public function age()
    {
        $ld = date('Y-m-d');
        $dates = date('Y-m-01');
        $daten =  date("Y-m-t", strtotime($ld));
        $a1 = 18;
        $a2 = 29;
        $data['agepro'] = $this->reportdb->reportagepro($a1,$a2,$dates,$daten);
        $data['ageple'] = $this->reportdb->reportageple($a1,$a2,$dates,$daten);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportage";
        $this->load->view('actionindex', $data);
    }

    public function inputage()
    {
        $dates = $this->input->post('dates');
        $daten = $this->input->post('daten');
        $select = $this->input->post('age');
        $a1 = substr($select,0,2);
        $a2 = substr($select,3);
        $data['agepro'] = $this->reportdb->reportagepro($a1,$a2,$dates,$daten);
        $data['ageple'] = $this->reportdb->reportageple($a1,$a2,$dates,$daten);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "report/reportage";
        $this->load->view('actionindex', $data);
    }


}

?>