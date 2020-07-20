<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('partner');
        $this->load->database();
    }
    public function addpartner()
    {
        $this->load->view('add/insertpartner');
    }

    public function insertpart()
    {
        $partname = $this->input->post('partname');
        $partemail = $this->input->post('partemail');
        $parttel = $this->input->post('parttel');
        $partaddress = $this->input->post('partaddress');

        $data1['getcheck'] = $this->partner->checkinsertpart($partname);
        foreach ($data1['getcheck'] as $value) {
            $count = $value->COUNT;
            if ($count == 0) {
                $data['insert'] = $this->partner->insertpart(
                    $partname,
                    $partemail,
                    $parttel,
                    $partaddress
                    
                );
                echo "<script> alert('เพิ่มบริษัทสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/company/partner';
						</script>";
            }else{
                echo "<script> alert ('พบชื่อ บริษัทซ้ำ ');
                window.history.back();           
                    </script>";

            
                $this->load->view('add/insertpart');
            }
        }
    }

    public function partner()
    {
        $data['partner'] = $this->partner->allpartner();
        $data['view'] = "detail/partner";
        $this->load->view('index',$data);
    }

    public function editpart($id)
    {
    
        $data['partner'] = $this->partner->displaybyid($id);
        $this->load->view('add/editpartner',$data);
    }
    
    public function updatepart()
    {
        $partid = $this->input->post('updatepart');
        $partname = $this->input->post('partname');
        $partemail = $this->input->post('partemail');
        $parttel = $this->input->post('parttel');
        $partaddress = $this->input->post('partaddress');

        $this->partner->updatepart($partid,$partname,$partemail,$parttel,$partaddress);

        echo "<script> alert('Record Updated');
							window.location.href='/ER_GOLDV1/index.php/company/partner';
							</script>";
    }

    public function deletepartner()
    {
        $partid = $this->input->post('Part_Id');
        $this->partner->deletepartner($partid);

            echo "<script> alert('Record Deleted');
		 					window.location.href='/ER_GOLDV1/index.php/company/partner';
							 </script>";

    }
}

?>