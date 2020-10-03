<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class positioncon extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('detail');
        $this->load->database();
    }

    public function insertviewposi()
    {          
        $data['view'] = "add/insertposition";
        $this->load->view('actionindex',$data);     
    }

    public function posgenid()
    {
        $max = $this->detail->maxidpos();
        $str = substr($max, 3) + 1;
        $txt = "POS";
        if($str == ''){
            $posid = "POS001";
        }elseif ($str < 10) {
            $posid = $txt . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $posid = $txt . "0" . $str;
        } elseif ($str >= 100) {
            $posid = $txt . $str;
        }

        return $posid;
        
    }

    public function addposi()
    {
        $this->load->model('detail');
        $posid = $this->posgenid();
        $posi = $this->input->post('posi');

        // $box = $this->input->post('box');
        $box1 = $this->input->post('box1');
        $box2 = $this->input->post('box2');
        $box3 = $this->input->post('box3');
        $box4 = $this->input->post('box4');
        $box5 = $this->input->post('box5');
        $box6 = $this->input->post('box6');
        $box7 = $this->input->post('box7');
        $box8 = $this->input->post('box8');
        $box9 = $this->input->post('box9');
        $box10 = $this->input->post('box10');

        $permit = $box1.$box2.$box3.$box4.$box5.$box6.$box7.$box8.$box9.$box10;

        // echo $posid."<br>";
        // echo $posi."<br>";
        // echo $box1."<br>";
        // echo $box2."<br>";
        // echo $box3."<br>";
        // echo $box4."<br>";
        // echo $box5."<br>";
        // echo $box6."<br>";
        // echo $permit;
        // foreach($box as $re){
        //     echo "permit:$re<br>";
        // }

        
        $this->detail->insertposition($posid,$posi,$permit);
        echo '<script> alert("เพิ่มตำแหน่งสำเร็จ");
						window.location.href="/ER_GOLDV1/index.php/Welcome/viewposition";
						</script>';
    }

    public function editjob($jobid)
    {
        $this->load->model('detail');
        $data['editjob'] = $this->detail->displayjobid($jobid);
        $data['view'] = "add/editposition";

        $this->load->view('actionindex', $data);
    }

    public function updatejob()
    {
        $this->load->model('detail');
        $jobid = $this->input->post('updatejob');
        $posi = $this->input->post('posi');
        $box1 = $this->input->post('box1');
        $box2 = $this->input->post('box2');
        $box3 = $this->input->post('box3');
        $box4 = $this->input->post('box4');
        $box5 = $this->input->post('box5');
        $box6 = $this->input->post('box6');
        $box7 = $this->input->post('box7');
        $box8 = $this->input->post('box8');
        $box9 = $this->input->post('box9');
        $box10 = $this->input->post('box10');

        $permit = $box1.$box2.$box3.$box4.$box5.$box6.$box7.$box8.$box9.$box10;

        $this->detail->updatejob($jobid, $posi,$permit);

        

        echo "<script> alert('แก้ไขข้อมูลสำเร็จ');
							window.location.href='/ER_GOLDV1/index.php/Welcome/viewposition';
							</script>";
    }

    public function deletejob()
    {
        $this->load->model('detail');
        $jobid = $this->input->post('Pos_Id');
        $this->detail->deletejob($jobid);

        echo "<script> alert('ลบข้อมูลตำแหน่งสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/viewposition';
						</script>";
    }

}
?>