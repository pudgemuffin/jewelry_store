<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class customercon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('detail');
        $this->load->database();
        $id = $this->session->userdata('id');
        $per = $this->session->userdata('Permit');
        if (!$id) {
            echo "<script> 
            window.alert('กรุณาลงชื่อเข้าใช้งาน');
            window.location.href='/ER_GOLDV1/index.php/auth/loginform';
            </script>";
        }
        if ($per[1] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.location.href='/ER_GOLDV1/index.php/Welcome';
            </script>";
        }
    }

    public function register()
    {

        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/registers";
        $this->load->view('actionindex', $data);
    }

    public function cusidgen()
    {
        $ye = substr(date("Y"), 2) . date("m");
        $this->load->model('customer');
        $max = $this->customer->maxid();
        $str = substr($max, 7) +1;
        $txt = "CUS";
        if($str == ''){
            $cusid = "CUS".$ye."001";
        }elseif ($str < 10) {
            $cusid = $txt . $ye . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $cusid = $txt . $ye ."0" . $str;
        } elseif ($str >= 100) {
            $cusid = $txt . $ye . $str;
        }
        // echo $cusid."<br>";
        // echo $str."<br>";
        return $cusid;
        // echo $cusid;
    }

    public function cusregis()
    {
        $this->load->model('customer');
        $cusid = $this->cusidgen();
        $cusfname = $this->input->post('cusfname');
        $cuslname = $this->input->post('cuslname');
        $cusgender = $this->input->post('cusgender');
        $cusemail = $this->input->post('cusemail');
        $cus_tel = $this->input->post('cus_tel');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $cusaddress = $this->input->post('cusaddress');
        $cusbdate = $this->input->post('cusbdate');
        $custstatus = 1;
        $this->input->post('customer');


        $data['insert'] = $this->customer->insertcus(
            $cusid,
            $cusfname,
            $cuslname,
            $cusgender,
            $cusemail,
            $province,
            $amphur,
            $district,
            $postcode,
            $cusaddress,
            $cusbdate,
            $custstatus
        );

        $CusId = $this->customer->maxid();

        $cus_tel = $this->input->post('cus_tel');

        foreach ($cus_tel as $ct) {
            $data = array(
                'cus_tel' => $ct,
                'Id' => $CusId
            );
            $checktel = $this->customer->count_cus_tel($CusId, $ct);
            if ($checktel == 0) {
                $this->customer->custel($CusId, $ct);
            }
        }
        echo "<script> alert('สมัครสำเร็จ');
                        window.location.href='/ER_GOLDV1/index.php/Welcome/viewcust';
                        </script>";

        // $data1['getcheck'] = $this->customer->checkinsertcus();
        // foreach ($data1['getcheck'] as $value) {
        //     $count = $value->COUNT;
        //     if ($count == 0) {  
        //   
        //     }else {
        //         echo "<script> alert ('พบชื่อ User ');
        //         window.history.back();           
        //             </script>";

        //         $data['depts'] = $this->detail->Depts();
        //         $data['pos']   = $this->detail->Position();
        //         $data['province'] = $this->detail->Province();
        //         $data['amphur'] = $this->detail->Amphur();
        //         $data['district'] = $this->detail->District();
        //         $this->load->view('add/registers', $data);
        //     }
        // }

    }

    public function editcust($id)
    {
        $this->load->model('customer');
        $data['editcust'] = $this->customer->displaybyid($id);
        $data['edittel'] = $this->customer->custelbyid($id);
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/editcust";
        $this->load->view('actionindex', $data);

    }

    public function updatecust()
    {
        $this->load->model('customer');
        $cusid = $this->input->post('Updateacc');
        $cusfname = $this->input->post('cusfname');
        $cuslname = $this->input->post('cuslname');
        $cusgender = $this->input->post('cusgender');
        $cusemail = $this->input->post('cusemail');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $cusaddress = $this->input->post('cusaddress');
        $cus_tel = $this->input->post('cus_tel');

        $this->customer->editcust($cusid, $cusfname, $cuslname, $cusgender, $cusemail, $province, $amphur, $district, $postcode, $cusaddress); //ไปทำModelต่อ

        $this->customer->custeldel($cusid);
        $cus_tel = $this->input->post('cus_tel');

        foreach ($cus_tel as $et) {
            $data = array(
                'cus_tel' => $et,
                'Id' => $cusid
            );
            $checktel = $this->customer->count_cus_tel($cusid, $et);
            if ($checktel == 0) {
                $this->customer->custel($cusid, $et);
            }
        }
        // echo $cusid."<br>";
        // echo $cusfname."<br>";
        // echo $cuslname."<br>";
        // echo $cusgender."<br>";
        // echo $cusemail."<br>";
        // echo $province."<br>";
        // echo $amphur."<br>";
        // echo $district."<br>";
        // echo $postcode."<br>";
        // echo $cusaddress."<br>";
        echo "<script> alert('แก้ไขข้อมูลลูกค้าสำเร็จ');
							window.location.href='/ER_GOLDV1/index.php/Welcome/viewcust';
							</script>";
    }

    public function deletecust($Cus_Id)
    {
        $this->load->model('customer');
        // $cusid = $this->input->post('Cus_Id');
        $this->customer->deletecust($Cus_Id);

        echo "<script> alert('ลบข้อมูลสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/viewcust';
							 </script>";
    }
}