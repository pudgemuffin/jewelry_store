<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Regis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('detail');
        $this->load->database();
    }

   
    public function register()
    {
      
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $this->load->view('add/registers',$data);
    }

    public function insert()
    {
        $data['depts'] = $this->detail->Depts();
        $data['pos']   = $this->detail->Position();
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $this->load->view('add/insertemp', $data);
    }
    public function addemp()
    {
        $idcard = $this->input->post('idcard');
        $nametitle = $this->input->post('nametitle');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $gender = $this->input->post('gender');
        $religion = $this->input->post('religion');
        $blood = $this->input->post('blood');
        $empdate = $this->input->post('empdate');
        $pnum = $this->input->post('pnum');
        $email = $this->input->post('email');
        $depts = $this->input->post('depts');
        $pos = $this->input->post('pos');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $det = $this->input->post('det');
        $this->input->post('detail');

        
        $data1['getcheck'] = $this->detail->checkinsert($idcard);

        foreach ($data1['getcheck'] as $value) {
            $count = $value->COUNT;
            if ($count == 0) {

                $data['insert'] = $this->detail->insertemp(
                    $idcard,
                    $nametitle,
                    $fname,
                    $lname,
                    $gender,
                    $religion,
                    $blood,
                    $empdate,
                    $pnum,
                    $email,
                    $depts,
                    $pos,
                    $province,
                    $amphur,
                    $district,
                    $postcode,
                    $det
                );

                echo "<script> alert('Record Saved');
						window.location.href='/ER_GOLDV1/index.php';
						</script>";
            } else {
                echo "<script> alert ('พบพนักงานแล้ว')</script>";

                $data['depts'] = $this->detail->Depts();
                $data['pos']   = $this->detail->Position();
                $data['province'] = $this->detail->Province();
                $data['amphur'] = $this->detail->Amphur();
                $data['district'] = $this->detail->District();
                $this->load->view('add/insertemp', $data);
            }
        }
    }

    public function edit($id)
    {
        
        $data['edit'] = $this->detail->displaybyid($id);
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['position'] = $this->detail->position();
        
        
         $this->load->view('add/edit',$data);
    }

    public function update()
    {
        $id = $this->input->post('updateId');
        $idcard = $this->input->post('idcard');
        $nametitle = $this->input->post('nametitle');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $gender = $this->input->post('gender');
        $religion = $this->input->post('religion');
        $blood = $this->input->post('blood');
        $empdate = $this->input->post('empdate');
        $pnum = $this->input->post('pnum');
        $email = $this->input->post('email');
        $pos = $this->input->post('pos');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $det = $this->input->post('det');

        $this->detail->update($id,$idcard,$nametitle,$fname,$lname,$gender,$religion,$blood,$empdate,$pnum,$email,$pos,$province,$amphur,$district,$postcode,$det);

        echo "<script> alert('Record Updated');
							window.location.href='/ER_GOLDV1/index.php';
							</script>";
    }

    public function delete()
    {
        $idcard = $this->input->post('idcard');
        $this->detail->delete($idcard);

            echo "<script> alert('Record Deleted');
		 					window.location.href='/ER_GOLDV1/index.php';
							 </script>";

    }

    public function cusregis()
    {
        $this->load->model('customer');
        $cususer = $this->input->post('cususer');
        $cuspass = $this->input->post('cuspass');
        $cusfname = $this->input->post('cusfname');
        $cuslname = $this->input->post('cuslname');
        $cusgender = $this->input->post('cusgender');
        $cusemail = $this->input->post('cusemail');
        $custel = $this->input->post('custel');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $cusaddress = $this->input->post('cusaddress');
        $this->input->post('customer');

        $data1['getcheck'] = $this->customer->checkinsertcus($cususer);
        foreach ($data1['getcheck'] as $value) {
            $count = $value->COUNT;
            if ($count == 0) {

                $data['insert'] = $this->customer->insertcus(
                    $cususer,
                    $cuspass,
                    $cusfname,
                    $cuslname,
                    $cusgender,
                    $cusemail,
                    $custel,
                    $province,
                    $amphur,
                    $district,
                    $postcode,
                    $cusaddress
                );

                echo "<script> alert('สมัครสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php';
						</script>";
            }else {
                echo "<script> alert ('พบชื่อ User ');
                window.history.back();           
                    </script>";

                $data['depts'] = $this->detail->Depts();
                $data['pos']   = $this->detail->Position();
                $data['province'] = $this->detail->Province();
                $data['amphur'] = $this->detail->Amphur();
                $data['district'] = $this->detail->District();
                $this->load->view('add/registers', $data);
            }
        }
        
    }

    public function editcust($id)
    {
        $this->load->model('customer');
        $data['editcust'] = $this->customer->displaybyid($id);
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        
        
         $this->load->view('add/editcust',$data);
    }

    public function updatecust()
    {
        $this->load->model('customer');
        $cusid = $this->input->post('Updateacc');
        $cususer = $this->input->post('cususer');
        $cuspass = $this->input->post('cuspass');
        $cusfname = $this->input->post('cusfname');
        $cuslname = $this->input->post('cuslname');
        $cusgender = $this->input->post('cusgender');
        $cusemail = $this->input->post('cusemail');
        $custel = $this->input->post('custel');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $cusaddress = $this->input->post('cusaddress');

        $this->customer->editcust($cusid,$cususer,$cuspass,$cusfname,$cuslname,$cusgender,$cusemail,$custel,$province,$amphur,$district,$postcode,$cusaddress); //ไปทำModelต่อ

        echo "<script> alert('Record Updated');
							window.location.href='/ER_GOLDV1/index.php/Welcome/viewcust';
							</script>";
    }

    public function deletecust()
    {
        $this->load->model('customer');
        $cusid = $this->input->post('Cus_Id');
        $this->customer->delete($cusid);

            echo "<script> alert('Record Deleted');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/viewcust';
							 </script>";

    }

    public function insertviewposi()
    {
        $this->load->view('add/insertposition');
        
    }

    public function addposi()
    {
       $this->load->model('detail');
       $posi = $this->input->post('posi');

       $this->detail->insertposition($posi);

       echo "<script> alert('เพิ่มตำแหน่งสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/viewposition';
						</script>";
    }

    public function editjob($jobid)
    {
        $this->load->model('detail');
        $data['editjob'] = $this->detail->displayjobid($jobid);

        $this->load->view('add/editposition',$data);

        

    }

    public function updatejob()
    {
        $this->load->model('detail');
        $jobid = $this->input->post('updatejob');
        $posi = $this->input->post('posi');
        $this->detail->updatejob($jobid,$posi);

        echo "<script> alert('Record Updated');
							window.location.href='/ER_GOLDV1/index.php/Welcome/viewposition';
							</script>";
    }

    public function deletejob()
    {
        $this->load->model('detail');
        $jobid = $this->input->post('Job_Id');
        $this->detail->deletejob($jobid);

        echo "<script> alert('Record Deleted');
						window.location.href='/ER_GOLDV1/index.php/Welcome/viewposition';
						</script>";
    }

    public function dept()
    {
        $depts = $this->input->post('depts');
        if ($depts != '') {
            $depts = "and Dep_Id = '$depts'";
        } else {
            $depts = '';
        }

        $data['result'] = $this->detail->Positionc($depts);
        $this->load->view('change/changedept', $data);
    }

    public function amphur()
    {
        $province = $this->input->post('province');
        if ($province != '') {
            $province = "and PROVINCE_ID = '$province'";
        } else {
            $province = '';
        }

        $data['result'] = $this->detail->Amphurc($province);
        $this->load->view('change/changeamphur', $data);
    }

    function district()
    {
        $amphur = $this->input->post('amphur');
        if ($amphur != '') {
            $amphur = "and AMPHUR_ID = '$amphur'";
        } else {
            $amphur = '';
        }

        $data['result'] = $this->detail->Districtc($amphur);
        $this->load->view('change/changedistrict', $data);
    }

    function postcode()
    {
        $district = $this->input->post('district');
        if ($district != '') {
            $district = " DISTRICT_ID = '$district'";
        } else {
            $district = '';
        }

        $data['result'] = $this->detail->postcodec($district);
        $this->load->view('change/changepos', $data);
    }
}
