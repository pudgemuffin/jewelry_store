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
        $ye = date('ym');
        $max = $this->pledgedb->maxpledge();
        if ($max == '') {
            $plid = 'PLE' . $ye . '0001';
            return $plid;
            // echo $plid;
        } else {
            $yeId = substr($max, 3, 4);
            if ($yeId != $ye) {

                return $plid = 'PLE' . $ye . '0001';
                // echo $plid;
            } else {
                $plid = substr($max, 7);
                $plid += 1;
                while (strlen($plid) < 4) {
                    $plid = '0' . $plid;
                }
                $plid = 'PLE' . $yeId . $plid;
                return $plid;
                // echo $plid;

            }
        }
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
        $ye = date('ym');
        $max = $this->pledgedb->exppl();
        if ($max == '') {
            $expd = 'EXP' . $ye . '0001';
            return $expd;
            // echo $expd;
        } else {
            $yeId = substr($max, 3, 4);
            if ($yeId != $ye) {

                return $expd = 'EXP' . $ye . '0001';
                // echo $expd;
            } else {
                $expd = substr($max, 7);
                $expd += 1;
                while (strlen($expd) < 4) {
                    $expd = '0' . $expd;
                }
                $expd = 'EXP' . $yeId . $expd;
                return $expd;
                // echo $expd;

            }
        }
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
        $pledgeweight = $this->input->post('weight');
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
            $pledgecus,
            $pledgeweight
        );

        for ($i = 0; $i < $count; $i++) {

            $this->pledgedb->addplelist($pledgeid, $pledgeweightper[$i], $pledgepro[$i]);
        }

        echo "<script> alert('เพิ่มข้อมูลใบจำนำสำเร็จ');
        window.location.href='/ER_GOLDV1/index.php/Welcome/allpledge';
        </script>";
    }

    public function selectpledge($plid)
    {
        $this->load->model('selldb');
        $data['pledge'] = $this->pledgedb->selectpledge($plid);
        $data['subpledge'] = $this->pledgedb->selectsubpledge($plid);
        $data['cus'] = $this->selldb->custselect();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/updatepledge";
        $this->load->view('actionindex', $data);
    }

    public function contipledge()
    {
        $pledgeid = $this->input->post('pledgeid');
        $pledgendd = $this->input->post('pledgeenddate');
        $pledgeprice = $this->input->post('payout');
        $pledgedebt = $this->input->post('debt');
        $pledgedebtprice = $this->input->post('pay');
        $pledgeweight = $this->input->post('weight');

        // echo $pledgeprice;



        $pledday = $this->input->post('month');
        $time = strtotime($pledgendd);
        $time = strtotime("+$pledday day", $time);
        $date = date("Y-m-d", $time);
        // echo $date;
        // echo $pledgeweight;
        // echo $pledgeprice;

        $pledgepro = $this->input->post('pled_pro');
        $pledgeweightper = $this->input->post('weight_per');
        // print_r($_POST);
        $count = count($pledgepro);
        $data['update'] = $this->pledgedb->updatepledge(
            $pledgeid,
            $date,
            $pledgeprice,
            $pledgedebt,
            $pledgedebtprice,
            $pledgeweight,
            $pledday
        );
        $this->pledgedb->deladdplelist($pledgeid);

        for ($i = 0; $i < $count; $i++) {

            $this->pledgedb->addplelist($pledgeid, $pledgeweightper[$i], $pledgepro[$i]);
        }

        echo "<script> alert('ต่อดอกสำเร็จ');
        window.location.href='/ER_GOLDV1/index.php/Welcome/allpledge';
        </script>";
    }

    public function checkpledge()
    {
        $this->pledgedb->setpledgezero();

        $this->pledgedb->setpledgelistzero();

        $data['insert'] = $this->pledgedb->selectlist();
        if ($data['insert'] != null) {

            foreach ($data['insert'] as $i) {

                $pledgepro = $i->Pledge_Pro;
                $pledgeweightp = $i->Pledge_Weight_Per;
                $float = (float)$i->Pledge_Price;
                $price =  ($float / $i->Pledge_Weight);
                $result = ($price * ($i->Pledge_Weight_Per));
                $result;
                $plid = $i->Pledge_Id;
                $id = $this->genexppro();
                // echo $pledgepro.'<br>';
                // echo $pledgeweightp.'<br>';
                // echo $result.'<br>';
                // echo $plid.'<br>';
                $this->pledgedb->insertstock($id, $pledgepro, $result, $pledgeweightp, $plid);
            }
            $this->pledgedb->changestat($plid);
        }
    }

    public function returnpledge($plid)
    {
        $this->pledgedb->returnpledge($plid);
        echo "<script> alert('ไถ่คืนสำเร็จ');
        window.location.href='/ER_GOLDV1/index.php/Welcome/allpledge';
        </script>";
    }
}
