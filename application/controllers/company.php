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
        $this->load->model('detail');
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['view'] = "add/insertpartner";
        // $this->load->view('add/insertpartner',$data);
        $this->load->view('actionindex', $data);
    }

    public function partgenid()
    {
        
        $max = $this->partner->maxparterid();
        $str = substr($max, 4) + 1;
        $txt = "PART";
        if ($str < 10) {
            $partid = $txt . "00" . $str;
        } elseif ($str >= 10 && $str <= 99) {
            $partid = $txt . "0" . $str;
        } elseif ($str >= 100) {
            $partid = $txt . $str;
        }

        return $partid;
    }

    public function insertpart()
    {
        $partid = $this->partgenid();
        $partname = $this->input->post('partname');
        $partemail = $this->input->post('partemail');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $parttel = $this->input->post('part_tel');
        $partaddress = $this->input->post('partaddress');

        $data1['getcheck'] = $this->partner->checkinsertpart($partname);
        foreach ($data1['getcheck'] as $value) {
            $count = $value->COUNT;
            if ($count == 0) {
                $data['insert'] = $this->partner->insertpart(
                    $partid,
                    $partname,
                    $partemail,
                    $province,
                    $amphur,
                    $district,
                    $postcode,
                    $partaddress
                    
                );
                $Id = $this->partner->maxparterid();
                $parttel = $this->input->post('part_tel');

                    foreach ($parttel as $pt) {
                        $data = array(
                            'Part_tel' => $pt,
                            'Part_Id' => $Id
                        );
                        $checktel = $this->partner->count_partner_tel($partid, $pt);
                        if ($checktel == 0) {
                            $this->partner->parttel($partid, $pt);
                        }
                    }
                echo "<script> alert('เพิ่มบริษัทสำเร็จ');
						window.location.href='/ER_GOLDV1/index.php/Welcome/partner';
						</script>";
            }else{
                echo "<script> alert ('พบชื่อ บริษัทซ้ำ ');
                window.history.back();           
                    </script>";

            
                // $this->load->view('add/insertpart');
            }
        }
    }

    

    public function editpart($id)
    {
        $this->load->model('detail');
        $data['partner'] = $this->partner->displaybyid($id);
        $data['edittel'] = $this->partner->parttelbyid($id);
        $data['province'] = $this->detail->Province();
        $data['amphur'] = $this->detail->Amphur();
        $data['district'] = $this->detail->District();
        $data['view'] = "add/editpartner";
        // $this->load->view('add/editpartner',$data);
        $this->load->view('actionindex', $data);
    }
    
    public function updatepart()
    {
        $partid = $this->input->post('updatepart');
        $partname = $this->input->post('partname');
        $partemail = $this->input->post('partemail');
        $province = $this->input->post('province');
        $amphur = $this->input->post('amphur');
        $district = $this->input->post('district');
        $postcode = $this->input->post('postcode');
        $parttel = $this->input->post('part_tel');
        $partaddress = $this->input->post('partaddress');

        $this->partner->updatepart($partid,$partname,$partemail, $province,$amphur,$district,$postcode,$partaddress);
        $this->partner->partteldel($partid);
        foreach ($parttel as $pt) {
            $data = array(
                'Part_tel' => $pt,
                'Part_Id' => $partid
            );
            $checktel = $this->partner->count_partner_tel($partid, $pt);
            if ($checktel == 0) {
                $this->partner->parttel($partid, $pt);
            }
        }

        echo "<script> alert('แก้ไขข้อมูลบริษัทสำเร็จ');
							window.location.href='/ER_GOLDV1/index.php/Welcome/partner';
							</script>";
    }

    public function deletepartner()
    {
        $partid = $this->input->post('Part_Id');
        $this->partner->deletepartner($partid);

            echo "<script> alert('ลบข้อมูลบริษัทสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/partner';
							 </script>";

    }

    public function cost($partid)
    {
        $this->load->model('ergold');
        $data1['getcheck'] = $this->partner->countpart($partid);
        foreach ($data1['getcheck'] as $value) {
            $count = $value->Count;
            if ($count == 0) {
                
                $data['partnerbyid'] = $this->partner->partnerbyid($partid); 
                $data['product'] = $this->ergold->product();
                $data['view'] = "add/cost";
                $this->load->view('actionindex', $data);

            }else{
                $data['partner'] = $this->partner->partnerbyid($partid); 
                $data['productbyid'] = $this->ergold->productcostbyid($partid);
                $data['product'] = $this->ergold->product();
                $data['view'] = "add/costpro";
                $this->load->view('actionindex', $data);
            }
        }
        
    }

    public function addcost()
    {
        $partid = $this->input->post('partid');
        $prodid = $this->input->post('prodid');
        // echo $partid."<br>";
        // print_r($prodid);
        foreach($prodid as $pd){
            $data = array(
                'Prod_Id' => $pd,
                'Part_Id' => $partid
            );
            $checkcost = $this->partner->count_cost_check($partid,$pd);
            if($checkcost == 0){
                $this->partner->insertcost($partid,$pd);
            }
        }

    }

    public function existcost()
    {
        $partid = $this->input->post('partid');
        $prodid = $this->input->post('prodid');
        $this->partner->deletecost($partid);
        foreach($prodid as $pd){
            $data = array(
                'Prod_Id' => $pd,
                'Part_Id' => $partid
            );
            $checkcost = $this->partner->count_cost_check($partid,$pd);
            if($checkcost == 0){
                $this->partner->insertcost($partid,$pd);
            }
        }

    }
}

?>