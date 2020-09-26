<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('ergold');
        $this->load->database();
    }
    public function insertprotype()
    {
        $this->load->view('add/insertprotype');
    }

    public function genprotype()
    {
        $max = $this->ergold->maxtypeid();
        $str = substr($max, 4) + 1;
        $txt = "TYPE";
        if ($str < 10) {
            $typeid = $txt . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $typeid = $txt . "0" . $str;
        } elseif ($str >= 100) {
            $typeid = $txt . $str;
        }

        return $typeid;
    }

    public function addprotype()
    {
        $typeid = $this->genprotype();
        $typename = $this->input->post('ptype');

        $data1['checkname'] = $this->ergold->checkinsert($typename);

        foreach ($data1['checkname'] as $value) {
            $count = $value->COUNT;
            if ($count == 0) {
                $this->ergold->inserttype($typeid, $typename);

                echo "<script> alert('เพิ่มข้อมูลประเภทสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/protype';
						</script>";
            } else {
                echo "<script> alert ('ประเภทสิ้นค้าซ้ำ')</script>";

                $this->load->view('add/insertprotype');
            }
        }
    }

    public function editprotype($Prot_Id)
    {
        $data['edittype'] = $this->ergold->displaytype($Prot_Id);

        $this->load->view('add/edittype', $data);
    }

    public function updatetype()
    {
        $typeid = $this->input->post('updatetype');
        $typename = $this->input->post('ptype');

        $data1['checkname'] = $this->ergold->checkinsert($typename);

        foreach ($data1['checkname'] as $value) {
            $count = $value->COUNT;
            if ($count == 0) {
                $this->ergold->inserttype($typeid, $typename);

                echo "<script> alert('แก้ไขข้อมูลประเภทสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/protype';
						</script>";
            } else {
                echo "<script> alert('ชื่อประเภทซ้ำ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/protype';
						</script>";
            }
        }
    }
    public function addproduct()
    {
        $data['protype'] = $this->ergold->protype();
        $data['weight'] = $this->ergold->weight();
        $this->load->view('add/insertproduct', $data);
    }

    public function grams()
    {
        $prodweight = $this->input->post('prodweight');
        if ($prodweight != '') {
            $prodweight = "and Weight_Id = '$prodweight'";
        } else {
            $prodweight = '';
        }

        $data['result'] = $this->ergold->grams($prodweight);
        foreach ($data['result'] as $value) {
            $r = $value->Weight_Grams;
        }
        echo $r;
        // $this->load->view('change/grams', $data);
    }

    public function genidproduct()
    {
        $max = $this->ergold->maxprodid();
        $str = substr($max, 4) + 1;
        // $str = substr("PROD09999", 4) + 1;
        $txt = "PROD";
        if ($str == '') {
            $prodid = "PROD09999";
        } elseif ($str < 10) {
            $prodid = $txt . "0000" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $prodid = $txt . "000" . $str;
        } elseif ($str >= 100 && $str <= 999) {
            $prodid = $txt . "00" . $str;
        } elseif ($str >= 1000 && $str <= 9999) {
            $prodid = $txt . "0" . $str;
        }elseif($str >= 10000){
            $prodid = $txt . $str;
        }

        // echo $prodid;
        return $prodid;
    }

    public function insertproduct()
    {
        $prodid = $this->genidproduct();
        $prodtype = $this->input->post('prodtype');
        $prodname = $this->input->post('prodname');
        $prodweight = $this->input->post('prodweight');
        $prodgram = $this->input->post('prodgram');
        $fee = $this->input->post('fee');

        // echo $prodid."<br>";
        // echo $prodtype."<br>";
        // echo $prodname."<br>";
        // echo $prodweight."<br>";
        // echo $prodgram."<br>";
        // echo $fee."<br>";

        $config['upload_path'] = './img/product';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config['file_name'] = $prodid;
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('prodim')) {
            // echo $this->upload->display_errors();
            echo "<script> alert ('ไฟล์รูปภาพไม่ถูกต้อง')</script>";

            $data['protype'] = $this->ergold->protype();
            $data['weight'] = $this->ergold->weight();
            $this->load->view('add/insertproduct', $data);
        } else {
            $data = $this->upload->data();
            $filename = $data['file_name'];

            $data1['getcheck'] = $this->ergold->checkinsertprod($prodname);
            foreach ($data1['getcheck'] as $value) {
                $count = $value->COUNT;
                if ($count == 0) {

                    $data['insert'] = $this->ergold->insertprod(
                        $prodid,
                        $prodtype,
                        $prodname,
                        $prodweight,
                        $prodgram,
                        $fee,
                        $filename
                    );
                    echo "<script> alert('เพิ่มข้อมูลสินค้าสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php';
						</script>";
                } else {
                    echo "<script> alert ('พบชื่อสินค้าซ้ำ')</script>";


                    $data['protype'] = $this->ergold->protype();
                    $data['weight'] = $this->ergold->weight();
                    $this->load->view('add/insertproduct', $data);
                }
            }
        }
    }
}
