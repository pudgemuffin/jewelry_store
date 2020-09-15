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
        $this->load->view('add/registers', $data);
    }

    public function insert()
    {
        $data['pos']   = $this->detail->Position();
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $this->load->view('add/insertemp', $data);
    }
    public function empidgen()
    {
        $max = $this->detail->maxid();
        $str = substr($max, 4) + 1;
        $txt = "EMP";
        if ($str < 10) {
            $empid = $txt . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $empid = $txt . "0" . $str;
        } elseif ($str <= 100) {
            $empid = $txt . $str;
        }

        return $empid;
    }

    public function addemp()
    {
        $id = $this->empidgen();
        $idcard = $this->input->post('idcard');
        $nametitle = $this->input->post('nametitle');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $gender = $this->input->post('gender');
        $religion = $this->input->post('religion');
        $blood = $this->input->post('blood');
        $empdate = $this->input->post('empdate');
        $emp_tel = $this->input->post('emp_tel');
        $email = $this->input->post('email');
        $pos = $this->input->post('pos');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $det = $this->input->post('det');
        $status = $this->input->post('status');
        $startdate = $this->input->post('empsdate');
        $salary = $this->input->post('salary');
        $national = $this->input->post('national');
        $this->input->post('detail');



        $config['upload_path'] = './img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('empim')) {
            // echo $this->upload->display_errors();
            echo "<script> alert ('ไฟล์รูปภาพไม่ถูกต้อง')</script>";

            $data['pos']   = $this->detail->Position();
            $data['province'] = $this->detail->Province();
            $data['amphur'] = $this->detail->Amphur();
            $data['district'] = $this->detail->District();
            $this->load->view('add/insertemp', $data);
        } else {
            $data = $this->upload->data();
            $filename = $data['file_name'];

            $data1['getcheck'] = $this->detail->checkinsert($idcard);


            foreach ($data1['getcheck'] as $value) {
                $count = $value->COUNT;
                if ($count == 0) {

                    $data['insert'] = $this->detail->insertemp(
                        $id,
                        $idcard,
                        $nametitle,
                        $fname,
                        $lname,
                        $gender,
                        $religion,
                        $blood,
                        $empdate,
                        $email,
                        $pos,
                        $province,
                        $amphur,
                        $district,
                        $postcode,
                        $det,
                        $status,
                        $startdate,
                        $salary,
                        $national,
                        $filename
                    );
                    $Id = $this->detail->maxid();


                    foreach ($emp_tel as $tel) {
                        $data['inserttel'] = $this->detail->emptel(
                            $Id,
                            $tel
                        );
                    }
                    echo "<script> alert('เพิ่มข้อมูลพนักงานสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php';
						</script>";
                } else {
                    echo "<script> alert ('พบพนักงานแล้ว')</script>";

                    $data['pos']   = $this->detail->Position();
                    $data['province'] = $this->detail->Province();
                    $data['amphur'] = $this->detail->Amphur();
                    $data['district'] = $this->detail->District();
                    $this->load->view('add/insertemp', $data);
                }
            }
        }
    }

    public function edit($id)
    {

        $data['edit'] = $this->detail->displaybyid($id);
        $data['edittel'] = $this->detail->emptelbyid($id);
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['position'] = $this->detail->position();


        $this->load->view('add/edit', $data);
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
        $emp_tel = $this->input->post('emp_tel');
        $email = $this->input->post('email');
        $pos = $this->input->post('pos');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $det = $this->input->post('det');
        $status = $this->input->post('status');
        $startdate = $this->input->post('empsdate');
        $salary = $this->input->post('salary');
        $national = $this->input->post('national');


        if(empty($_FILES['empim']['name'])){
            
            $filename = $this->input->post('oldimg');
            $this->detail->update($id, $idcard, $nametitle, $fname, $lname, $gender, $religion, $blood, $empdate, $email, $pos, $province, $amphur, $district, $postcode, $det, $status, $startdate, $salary, $national,$filename);
        } else {
          
            $config['upload_path'] = './img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('empim')) {
                // echo $this->upload->display_errors();
                echo "<script> alert ('ไฟล์รูปภาพไม่ถูกต้อง')</script>";

                $data['pos']   = $this->detail->Position();
                $data['province'] = $this->detail->Province();
                $data['amphur'] = $this->detail->Amphur();
                $data['district'] = $this->detail->District();
                $this->load->view('add/insertemp', $data);
            } else {
                $data = $this->upload->data();
                $filename = $data['file_name'];
                $oldImg = $this->input->post('oldImg');
                $this->detail->update($id, $idcard, $nametitle, $fname, $lname, $gender, $religion, $blood, $empdate, $email, $pos, $province, $amphur, $district, $postcode, $det, $status, $startdate, $salary, $national, $filename);
                
            }
            unlink('./img/'.$oldImg);
        }
        $this->detail->empteldel($id);
        foreach ($emp_tel as $tel) {
            $data['updateemptel'] = $this->detail->emptelupdate(
                $id,
                $tel
            );
            echo "<script> alert('แก้ไขข้อมูลพนักงานสำเร็จ');
                                window.location.href='/ER_GOLDV1/index.php';
                                </script>";
        }
        
    }

    public function test()
    {
        unlink('./img/week2.jpg');
    }



    public function delete()
    {
        $Id = $this->input->post('Id');
        $this->detail->delete($Id);

        echo "<script> alert('ลบข้อมูลสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php';
							 </script>";
    }

    public function cusidgen()
    {
        $this->load->model('customer');
        $max = $this->customer->maxid();
        $str = substr($max, 4) + 1;
        $txt = "CUS";
        if ($str < 10) {
            $cusid = $txt . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $cusid = $txt . "0" . $str;
        } elseif ($str <= 100) {
            $cusid = $txt . $str;
        }

        return $cusid;
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
            $cusbdate
        );

        $CusId = $this->customer->maxid();

        foreach ($cus_tel as $tel) {
            $data['inserttel'] = $this->customer->custel(
                $CusId,
                $tel
            );
        }
        echo "<script> alert('สมัครสำเร็จ');
                        window.location.href='/ER_GOLDV1/index.php/Welcome/viewcust';
                        </script>";

        // $data1['getcheck'] = $this->customer->checkinsertcus();
        // foreach ($data1['getcheck'] as $value) {
        //     $count = $value->COUNT;
        //     if ($count == 0) {        
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


        $this->load->view('add/editcust', $data);
    }

    public function updatecust()
    {
        $this->load->model('customer');
        $cusid = $this->input->post('Updateacc');
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
        $cus_tel = $this->input->post('cus_tel');

        $this->customer->editcust($cusid, $cusfname, $cuslname, $cusgender, $cusemail, $custel, $province, $amphur, $district, $postcode, $cusaddress); //ไปทำModelต่อ

        $this->customer->custeldel($cusid);
        foreach ($cus_tel as $tel) {
            $data['updatecustel'] = $this->customer->updatecustel(
                $cusid,
                $tel
            );
        }
        echo "<script> alert('แก้ไขข้อมูลลูกค้าสำเร็จ');
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

        $this->load->view('add/editposition', $data);
    }

    public function updatejob()
    {
        $this->load->model('detail');
        $jobid = $this->input->post('updatejob');
        $posi = $this->input->post('posi');
        $this->detail->updatejob($jobid, $posi);

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
