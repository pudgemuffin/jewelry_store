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
            $plid = $txt . $ye . "000" . $str.'<br>';
        } elseif ($str >= 10 && $str <= 99) {
            $plid = $txt . $ye . "00" . $str;
        } elseif ($str >= 100 && $str <=999 ) {
            $plid = $txt . $ye . "0" . $str;
            echo "hi";
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

    public function caldate()
    {
        // $month =  date('m');
        $day = date('d');
        $month = 4;
        $ye = date('Y');

        $am = 3;

        $total = $month + $am;

        if ($total > 12){
            $result = ($ye + 1) . "-" . ("0") . ( $total - 12) . '-' . $day;
             
        }else{
            $result = $ye . '-' ."0" .$total . '-' . $day . 'eiei';
        }
        echo $result.'<br>';    
        echo $ye.'<br>';
        
        echo date('Y-m-d');
    }
}