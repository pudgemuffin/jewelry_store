<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class sell extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('selldb');
        $this->load->database();
    }

    public function sellview()
    {
        $data['customer'] = $this->selldb->custselect();
        $data['world'] = $this->selldb->selectworldprice();
        // $ordid = $this->ordergenid();
        // $data['partner'] = $this->partner->partnerdetail();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['id'] = $this->session->userdata('id');
        // $data['result'] = $this->ordermod->Part();
        $data['view'] = "add/sellproduct";

        $this->load->view('actionindex', $data);
    }

    public function ajaxsell()
    {
        $type = $this->input->post('type');

        if ($type == "1") {
            // echo "normal";
            $data['result'] = $this->selldb->sellpro($type);
            echo '<table id="aaaa" class="display">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>รูป</th>';
            echo '<th nowrap>ประเภทสินค้า</th>';
            echo '<th>ชื่อสินค้า</th>';
            echo '<th>น้ำหนัก</th>';
            echo '<th>กำเหน็จ</th>';
            echo '<th>ไซส์</th>';
            echo '<th>จำนวน</th>';
            echo '<th>เพิ่มสินค้า</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="show_part">';
            foreach ($data['result'] as $r) {

                echo '<tr>';
                // echo '<td><img src="("/img/EMP/""'. $r->Prod_Img .'")">'  '</td>';
                // echo '<td>'. $r->Prod_Img .'</td>';
                // echo '<td><img src = "base_url(/img/product/'.$r->Prod_Img.')"></td>';
                echo '<td><img style = "width: 100px; height:100px;" src = "http://localhost/ER_GOLDV1/img/product/' . $r->Prod_Img . '"></td>';
                echo '<td>' . $r->Lot_Id . '</td>';
                echo '<td>' . $r->Prod_Name . ' </td>';
                echo '<td>' . $r->Weight_Name . '</td>';
                echo '<td>' . number_format($r->Fee,2) . '</td>';
                echo '<td>' . $r->Size . '</td>';
                echo '<td>' . $r->Amount . '</td>';
                echo '<td><button type="button" class="prodid" id="prodid" name="prodid" value="' . $r->Prod_Id.''.$r->Lot_Id . '">เพิ่ม</button></td>';
                echo '</tr>';
            }
        } else {
            // echo $type;
        }
    }
    public function addpro()
    {
        $prodid = $this->input->post('prod');
        $lotid = $this->input->post('lot');
        $row = $this->input->post('row');

        $data['result'] = $this->selldb->selectpro($prodid,$lotid);
        foreach ($data['result'] as $r) {
            echo  '<tr id = "order' . $row . '">';
            echo  '<td><img style = "width: 100px; height:100px;" src = "http://localhost/ER_GOLDV1/img/product/' . $r->Prod_Img . '"></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class = "form-control" type = "text" id = "lot" name = "lot[]" value = "'.$r->Lot_Id.'" readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="form-control" type="text" id="product" name="product[]" value="' . $r->Prod_Name . '" readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap>' . $r->Weight_Name . '</td>';
            echo  '<input class="form-control" type="hidden" id="idproduct" name="idproduct[]" value="' . $r->Prod_Id . '" >';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="form-control" type="text" value="' . number_format($r->Fee,2) . '"readonly><input class="Fee form-control" type="hidden" id="Fee" name="Fee[]" value="' . $r->Fee . '"readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap>' . $r->Size . '</td>';
            echo  '<input type = "hidden" value = "' . $r->Amount . '">';
            echo  '<input class = "weight" type = "hidden" value = "' . $r->Weight_Cal .'"><input class = "discount" type = "hidden" id = "discount" name = "discount[]" value = "' .$r->Prom_Discount. '">';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="sellinput form-control" type = "number" id="piece" name="piece[]" required value="0"  min = "0" max = "' . $r->Amount . '"  onkeypress="return numberonly(event)" required></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="priced form-control" type = "text" id="price" name="price[]" readonly></td>';
            if($r->Prom_Discount != null){
                echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="discount form-control" type = "text" id="discount" name="discount[]" value = "'.$r->Prom_Discount.'%" readonly></td>';
            } else{
                echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="discount form-control" type = "text" id="discount" name="discount[]" value = "0%" readonly></td>';
            }
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="sellTotal1 form-control"  readonly value="0"></td><input class="sellTotal" id="total" name="total[]" type = "hidden" value = "0">';
            
            // echo  '<td><button type="button" class="prodid" id="prodid" name="prodid" value="'. $r->Prod_Id . "" . $r->Part_Id.'">sdasd</button></td> </td>';
            echo '<td class="align-middle" style="text-align: center; "  width="6%">  <a href="#"class="btn btn-danger remove" style="border-radius: 5px; width: 60px; "> <i class="fas fa-minus-circle"></i></a> </td>';
            echo  '</tr>';
        }
    }

    public function sellpro()
    {
        $prodid = $this->input->post();
        $amount = $this->input->post();
    }
}
