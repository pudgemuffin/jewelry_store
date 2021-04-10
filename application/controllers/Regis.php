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
        $per = $this->session->userdata('Permit');
        $id = $this->session->userdata('id');
        if (!$this->session->userdata('id')) {
            echo "<script> 
            window.alert('กรุณาลงชื่อเข้าใช้งาน');
            window.location.href='/ER_GOLDV1/index.php/auth/loginform';
            </script>";
            
        }
        if ($per[0] != 1) {
                echo "<script> 
                window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
                window.location.href='/ER_GOLDV1/index.php/Welcome/employee';
                </script>";
            }

        
    }


    

    public function insert()
    {
      
        $data['posi']   = $this->detail->callposition();
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['view'] = "add/insertemp";
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        // $this->load->view('add/insertemp', $data);
        // $this->load->view('index',$data);
        $this->load->view('actionindex', $data);
        
    }

    public function empidgen()
    {
        $max = $this->detail->maxid();
        $str = substr($max, 3) + 1;
        $txt = "EMP";
        if ($str == '') {
            $empid = "EMP001";
        } elseif ($str < 10) {
            $empid = $txt . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $empid = $txt . "0" . $str;
        } elseif ($str >= 100) {
            $empid = $txt . $str;
        }

        return $empid;
        // echo $empid;
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

        $email = $this->input->post('email');
        $pos = $this->input->post('pos');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $det = $this->input->post('det');
        $status = 1;
        $startdate = $this->input->post('empsdate');
        $salary = $this->input->post('salary');
        $national = $this->input->post('national');
        $user = $id;
        $pass = $id;
        
        // echo $gender;
        $this->input->post('detail');



        $config['upload_path'] = './img/EMP/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config["overwrite"] = TRUE;
        $config['file_name'] = $id . ".jpg";
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('empim')) {
            // echo $this->upload->display_errors();
            echo "<script> alert ('ไฟล์รูปภาพไม่ถูกต้อง')
            window.history.back();
            </script>";

            // $data['pos']   = $this->detail->Position();
            // $data['province'] = $this->detail->Province();
            // $data['amphur'] = $this->detail->Amphur();
            // $data['district'] = $this->detail->District();
            // $this->load->view('add/insertemp', $data);
        } else {


            $data1['getcheck'] = $this->detail->checkinsert($idcard);



            foreach ($data1['getcheck'] as $value) {
                $count = $value->COUNT;
                if ($count == 0) {
                    $data = $this->upload->data();
                    $filename = $data['file_name'];
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
                        $filename,
                        $user,
                        $pass
                    );
                    $Id = $this->detail->maxid();
                    $emp_tel = $this->input->post('emp_tel');

                    foreach ($emp_tel as $et) {
                        $data = array(
                            'emp_tel' => $et,
                            'Id' => $Id
                        );
                        $checktel = $this->detail->count_emp_tel($id, $et);
                        if ($checktel == 0) {
                            $this->detail->emptel($id, $et);
                        }
                    }
                    echo "<script> alert('เพิ่มข้อมูลพนักงานสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/employee';
                    	</script>";
                } else {
                    echo "<script> alert ('พบพนักงานแล้ว')
                    window.history.back();
                    </script>";
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
        $data['position'] = $this->detail->callposition();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/edit";
        // $this->load->view('add/edit', $data);
        $this->load->view('actionindex', $data);
        
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
        $emp_tel = $this->input->post('emp_tel');
        $pass = $this->input->post('password');


        if (empty($_FILES['empim']['name'])) {


            $this->detail->updatenoimg($id, $idcard, $nametitle, $fname, $lname, $gender, $religion, $blood, $empdate, $email, $pos, $province, $amphur, $district, $postcode, $det, $status, $startdate, $salary, $national,$pass);

            $this->detail->empteldel($id);
            foreach ($emp_tel as $et) {
                $data = array(
                    'emp_tel' => $et,
                    'Id' => $id
                );
                $checktel = $this->detail->count_emp_tel($id, $et);
                if ($checktel == 0) {
                    $this->detail->emptel($id, $et);
                }
            }

            echo "<script> alert('แก้ไขข้อมูลพนักงานสำเร็จ');
            window.location.href='/ER_GOLDV1/index.php/Welcome/employee';
            </script>";
        } else {

            $config['upload_path'] = './img/EMP/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '3000';
            $config['max_height'] = '3000';
            $config["overwrite"] = TRUE;
            $config['file_name'] = $id . ".jpg";
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('empim')) {
                $oldImg = $this->input->post('oldImg');
                // echo $this->upload->display_errors();
                echo "<script> alert ('ไฟล์รูปภาพไม่ถูกต้อง')
                window.history.back();
                </script>";

                // $data['edit'] = $this->detail->displaybyid($id);
                // $data['edittel'] = $this->detail->emptelbyid($id);
                // $data['province'] = $this->detail->Province();
                // $data['amphur'] = $this->detail->Amphur();
                // $data['district'] = $this->detail->District();
                // $data['position'] = $this->detail->position();
                //  $this->load->view('add/edit', $data);

            } else {
                $data = $this->upload->data();
                $filename = $data['file_name'];
                // $oldImg = $this->input->post('oldImg');
                $this->detail->update($id, $idcard, $nametitle, $fname, $lname, $gender, $religion, $blood, $empdate, $email, $pos, $province, $amphur, $district, $postcode, $det, $status, $startdate, $salary, $national, $filename,$pass);
                // unlink('./img/EMP/' . $oldImg);
            }

            $this->detail->empteldel($id);
            foreach ($emp_tel as $et) {
                $data = array(
                    'emp_tel' => $et,
                    'Id' => $id
                );
                $checktel = $this->detail->count_emp_tel($id, $et);
                if ($checktel == 0) {
                    $this->detail->emptel($id, $et);
                }
            }


            echo "<script> alert('แก้ไขข้อมูลพนักงานสำเร็จ');
            window.location.href='/ER_GOLDV1/index.php/Welcome/employee';
            </script>";
        }
    }

    public function delete($Id)
    {
        
        // $Id = $this->input->post('Id');
        // echo $Id;
        $this->detail->delete($Id);

        echo "<script> alert('ลบข้อมูลสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/employee';
                             </script>";
       
    }

    public function test()
    {

        $ye = substr(date("Y"), 2) . date("m");
        $this->load->model('customer');
        $max = $this->customer->maxid();
        $str = substr($max, 3) + 1;
        $txt = "CUS";
        if ($str == '') {
            $cusid = "CUS" . $ye . "001";
        } elseif ($str < 10) {
            $cusid = $txt . $ye . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $cusid = $txt . $ye . "0" . $str;
        } elseif ($str >= 100) {
            $cusid = $txt . $ye . $str;
        }
        echo $cusid;
        return $cusid;
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
