<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class pledgecon extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('pledgedb');
        $this->load->database();
    }

    public function genpledge()
    {
        $ye = substr(date("Y"), 2) . date("m");
        $max = $this->pledgedb->maxpledge();

        $str = substr($max, 7) + 1;

        $txt = "PLE";

        if ($str == '') {
            $plid = "PLE" . $ye . "0001";
        } elseif ($str < 10) {
            $plid = $txt . $ye . "000" . $str . '<br>';
        } elseif ($str >= 10 && $str <= 99) {
            $plid = $txt . $ye . "00" . $str;
        } elseif ($str >= 100 && $str <= 999) {
            $plid = $txt . $ye . "0" . $str;
        } elseif ($str >= 1000) {
            $plid = $txt . $ye . $str;
        }

        // echo $plid;
        return $plid;
    }

    public function pledge()
    {
        $this->load->model('selldb');
        $plid = $this->genpledge();
        $data['cus'] = $this->selldb->custselect();
        $data['buy'] = $this->pledgedb->recbuy();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['id'] = $this->session->userdata('id');
        $data['view'] = "add/pledge";

        $this->load->view('actionindex', $data);
    }

    public function genexppro()
    {
        $ye = substr(date("Y"), 2) . date("m");
        $max = $this->pledgedb->exppl();

        $str = substr($max, 7) + 1;

        $txt = "EXP";

        if ($str == '') {
            $expd = "EXP" . $ye . "0001";
        } elseif ($str < 10) {
            $expd = $txt . $ye . "000" . $str . '<br>';
        } elseif ($str >= 10 && $str <= 99) {
            $expd = $txt . $ye . "00" . $str;
        } elseif ($str >= 100 && $str <= 999) {
            $expd = $txt . $ye . "0" . $str;
        } elseif ($str >= 1000) {
            $expd = $txt . $ye . $str;
        }

        // echo $expd;
        return $expd;
    }

    public function insertpledge()
    {
        $pledgeid = $this->genpledge();
        $pledgedetail = $this->input->post('det');
        $pledgeprice = $this->input->post('payout');
        $pledgedebt = $this->input->post('debt');
        $pledgedebtprice = $this->input->post('pay');
        $pledgeSdate = $this->input->post('date');
        $pledgeNdate = $this->input->post('endate');
        $pledgeMonth = $this->input->post('month');
        $pledgeemp = $this->input->post('id');
        $pledgecus = $this->input->post('cust');
        // $pledgestat = 1;

        $pledgepro = $this->input->post('pled_pro');
        $pledgeweightper = $this->input->post('weight_per');


        $count = count($pledgepro);

        // echo $count.'<br>';

        // print_r($_POST);

        $data['insertple'] = $this->pledgedb->addple(
            $pledgeid,
            $pledgedetail,
            $pledgeprice,
            $pledgedebt,
            $pledgedebtprice,
            $pledgeSdate,
            $pledgeNdate,
            $pledgeMonth,
            $pledgeemp,
            $pledgecus
        );

        for ($i = 0; $i < $count; $i++) {

            $this->pledgedb->addplelist($pledgeid, $pledgeweightper[$i], $pledgepro[$i]);
        }

        echo "<script> alert('เพิ่มข้อมูลใบจำนำสำเร็จ');
        window.location.href='/ER_GOLDV1/index.php/Welcome/receives';
        </script>";
    }

    public function checkpledge()
    {
        $Ndate = $this->pledgedb->selectndate();

        foreach ($Ndate as $r) {
            $enddate = $r->Pledge_Ndate;
        }

        // $ndate = date_create($enddate);
        $ndate = date_create($enddate);
        date_add($ndate,date_interval_create_from_date_string("60 days"));
        $check = date_format($ndate,"Y-m-d");
        $today = date('Y-m-d');
        // echo $today.'<br>';
        echo $check.'<br>';

        // echo gettype($check).'<br>';
        // echo gettype($today).'<br>';
        
        if ($check == $today){
            echo "Equal";
        }else{
            echo "Not Equal";
        }
    }
}
