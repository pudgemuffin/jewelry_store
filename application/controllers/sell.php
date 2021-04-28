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
       
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['id'] = $this->session->userdata('id');

        $data['view'] = "add/sellproduct";

        $this->load->view('actionindex', $data);
    }

    public function ajaxsell()
    {
        $type = $this->input->post('type');

        if ($type == "1") {
            // echo "normal";
            $data['result'] = $this->selldb->sellpro();
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
                echo '<td>' . number_format($r->Fee, 2) . '</td>';
                echo '<td>' . $r->Size . '</td>';
                echo '<td>' . $r->Amount . '</td>';
                echo '<td><button type="button" class="prodid" id="prodid" name="prodid" value="' . $r->Prod_Id . '' . $r->Lot_Id . '">เพิ่ม</button></td>';
                echo '</tr>';
            }
        } else {
            // $data['expresult'] = $this->selldb->selectexp();
            // print_r($data['expresult']);
            // echo $type;
            $data['expresult'] = $this->selldb->selectexp();
            echo '<table id="aaaa" class="display">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>รหัสสินค้า</th>';
            echo '<th>ชื่อสินค้า</th>';
            echo '<th>น้ำหนัก</th>';
            echo '<th>ราคาทุน</th>';
            // echo '<th>จำนวน</th>';
            echo '<th>เพิ่มสินค้า</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="show_part">';
            foreach ($data['expresult'] as $p) {
                echo '<tr>';
                echo '<td>' . $p->ProdPL_Id . '</td>';
                echo '<td>' . $p->ProdPL_Name . '</td>';
                echo '<td>' . $p->ProdPL_Weight_Per . '</td>';
                echo '<td>' . number_format($p->ProdPL_Cost, 2) . '</td>';
                // echo
                echo '<td><button type="button" class="prodidexp" id="prodidexp" name="prodidexp" value="' . $p->ProdPL_Id . '">เพิ่ม</button></td>';
                echo '</tr>';
            }
        }
    }
    public function addpro()
    {
        $prodid = $this->input->post('prod');
        $lotid = $this->input->post('lot');
        $row = $this->input->post('row');

        $data['result'] = $this->selldb->selectpro($prodid, $lotid);
        foreach ($data['result'] as $r) {
            echo  '<tr id = "order' . $row . '">';
            echo  '<td><img style = "width: 100px; height:100px;" src = "http://localhost/ER_GOLDV1/img/product/' . $r->Prod_Img . '"></td>';
            echo  '<input type ="hidden" id="cat" name = "cat[]" value = "1">';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class = "hello form-control" type = "text" id = "Lotid" name = "Lotid[]" value = "' . $r->Lot_Id . '" readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="form-control" type="text" id="product" name="product[]" value="' . $r->Prod_Name . '" readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap>' . $r->Weight_Name . '</td>';
            echo  '<input class="form-control" type="hidden" id="idproduct" name="idproduct[]" value="' . $r->Prod_Id . '" ><input class="form-control" type="hidden" id="type" name="type[]" value="1" >';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="form-control" type="text" value="' . number_format($r->Fee, 2) . '"readonly><input class="Fee form-control" type="hidden" id="Fee" name="Fee[]" value="' . $r->Fee . '"readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap>' . $r->Size . '</td>';
            echo  '<input type = "hidden"  class = "amount"  value = "' . $r->Amount . '"><input type = "hidden" class = "left" id = "left" name = "left" value = "0">';
            echo  '<input class = "weight" type = "hidden" value = "' . $r->Weight_Cal . '">';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="sellinput form-control" type = "number" id="piece" name="piece[]" required value="0"  min = "0" max = "' . $r->Amount . '"  onkeypress="return numberonly(event)" required></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="priced form-control" type = "text" readonly><input class="price form-control" type = "hidden" id="price" name="price[]" value = "0" readonly></td>';
            if ($r->Prom_Discount != null) {
                echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="discount form-control" type = "text"  value = "' . $r->Prom_Discount . '%" readonly><input class = "discount" type = "hidden" id = "discount" name = "discount[]" value = "' . $r->Prom_Discount . '"></td>';
            } else {
                echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="discount form-control" type = "text"  value = "0%" readonly><input class = "discount" type = "hidden" id = "discount" name = "discount[]" value = "0"></td>';
            }
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="sellTotal1 form-control"  readonly value="0"></td><input class="sellTotal" id="total" name="total[]" type = "hidden" value = "0">';

            // echo  '<td><button type="button" class="prodid" id="prodid" name="prodid" value="'. $r->Prod_Id . "" . $r->Part_Id.'">sdasd</button></td> </td>';
            echo '<td class="align-middle" style="text-align: center; "  width="6%">  <a href="#"class="btn btn-danger remove" style="border-radius: 5px; width: 60px; "> <i class="fas fa-minus-circle"></i></a> </td>';
            echo  '</tr>';
        }
    }

    public function addproexp()
    {
        $prodid = $this->input->post('prod');
        $row = $this->input->post('row');
        $data['result'] = $this->selldb->addexp($prodid);
        foreach ($data['result'] as $r) {
            echo  '<tr id = "order' . $row . '">';
            echo  '<td></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class = "hello form-control" type = "text" id = "Expid" name = "Expid[]" value = "' . $r->ProdPL_Id . '" readonly></td>';
            echo  '<input type ="hidden" id="cat" name = "cat[]" value = "2">';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="form-control" type="text" id="product" name="product[]" value="' . $r->ProdPL_Name . '" readonly><input class="form-control" type="hidden" id="type" name="type[]" value="0" ></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="weight form-control" type="text" id="weight" name="weight[]" value="' . $r->ProdPL_Weight_Per . '" readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="form-control" type="text" value="' . number_format($r->ProdPL_Cost, 2) . '"readonly><input class="Cost form-control" type="hidden" id="Cost" name="Cost[]" value="' . $r->ProdPL_Cost . '"readonly></td>';
            echo  '<td></td>';
            echo  '<input class="form-control" type="hidden" id="idproduct" name="idproduct[]" value="' . $r->ProdPL_Id . '" >';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="sellinput form-control" type = "number" id="piece" name="piece[]" required value="0"  min = "1" max = "1"   required></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="pricedple form-control" type = "text"  readonly><input class="priceple form-control" type = "hidden" id="price" name="price[]" value = "0" readonly></td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="discount form-control" type = "text" value = "0%" readonly><input type = "hidden" id ="discount" name="discount[]" value = "0"</td>';
            echo  '<td class="align-middle" style="text-align: center; "nowrap><input class="sellTotal1 form-control"  readonly value="0"></td><input class="sellTotal" id="total" name="total[]" type = "hidden" value = "0">';

            // echo  '<td><button type="button" class="prodid" id="prodid" name="prodid" value="'. $r->Prod_Id . "" . $r->Part_Id.'">sdasd</button></td> </td>';
            echo '<td class="align-middle" style="text-align: center; "  width="6%">  <a href="#"class="btn btn-danger remove" style="border-radius: 5px; width: 60px; "> <i class="fas fa-minus-circle"></i></a> </td>';
            echo  '</tr>';
        }
    }

    public function genidrep()
    {
        $ye = date('ym');
        $max = $this->selldb->maxrep();
        if ($max == '') {
            $repid = 'REP' . $ye . '0001';
            return $repid;
            // echo $repid;
        } else {
            $yeId = substr($max, 3, 4);
            if ($yeId != $ye) {

                return $repid = 'REP' . $ye . '0001';
                // echo $repid;
            } else {
                $repid = substr($max, 7);
                $repid += 1;
                while (strlen($repid) < 4) {
                    $repid = '0' . $repid;
                }
                $repid = 'REP' . $yeId . $repid;
                return $repid;
                // echo $repid;

            }
        }
    }

    public function sellpro()
    {
        $empid = $this->input->post('id');
        $cusid = $this->input->post('cust');
        $repid = $this->genidrep();
        $date = $this->input->post('date');
        $payment = $this->input->post('payt');
        $alltotal = $this->input->post('alltotal');
        $age = $this->selldb->age($cusid);
        // echo $age;


        $lotid = $this->input->post('Lotid');
        $type = $this->input->post('type');
        $amount = $this->input->post('piece');
        $prodid = $this->input->post('idproduct');



        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre><br>';

        $dis = $this->input->post('discount');
        $priceper = $this->input->post('price');
        $totalper = $this->input->post('total');
        $left = $this->input->post('left');

        $this->selldb->receipt($repid, $payment, $date, $age, $alltotal, $empid, $cusid);
        // echo $payment.'<br>';
        // echo $alltotal.'<br>';
        $cat = $this->input->post('cat');
        $count = count($cat);

        for ($i = 0; $i < $count; $i++) {
            $this->selldb->receipt_list($i + 1, $type[$i], $amount[$i], $dis[$i], $priceper[$i], $totalper[$i], $repid);
            // echo $dis[$i].'<br>';
            if ($cat[$i] == '1') {

                // echo $prodid[$i] . '<br>';
                // echo $lotid[$i] . '<br>';
                $this->selldb->receipt_list_product($repid, $i + 1, $lotid[$i], $prodid[$i]);
                $this->selldb->updateproduct($lotid[$i], $prodid[$i], $amount[$i]);
                // echo "1";
            } else {


                // echo $prodid[$i] . '<br>';
                $this->selldb->receipt_list_pledge($repid, $i + 1, $prodid[$i]);
                $this->selldb->updatepledgestock($prodid[$i]);
                // echo "2";
            }
        }
        // echo "DONE";
        echo "<script> alert('เพิ่มข้อมูลการขายสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/allreceipt';
							 </script>";
    }

    public function viewreceiptlist($repid)
    {
        $data['receipt'] = $this->selldb->receipthead($repid);
        $data['subreceiptpro'] = $this->selldb->receiptdetailv2($repid);
              

        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/receiptdetail";
        $this->load->view('actionindex', $data);
    }

    public function cancelsell($repid)
    {
        $this->selldb->changestatrep($repid);
        // echo $repid;
        $data['amount'] = $this->selldb->getamountpro($repid);
        // print_r($data['amount']);
        foreach ($data['amount'] as $a) {

            if ($a->Receipt_Type == '1') {
                $this->selldb->updateprostock($a->Receipt_Amount, $a->Prod_Id, $a->Lot_Id);
            } else {

                $this->selldb->updateplestock($a->ProdPL_Id);
            }
        }

        echo "<script> alert('ยกเลิกการขายสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/allreceipt';
							 </script>";
    }

    public function worldprice()
    {
        $data['world'] = $this->selldb->worldprice();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/worldprice";
        $this->load->view('actionindex', $data);
    }

    public function updateworldprice()
    {
        $sell = $this->input->post('sell');
        $buy = $this->input->post('buy');

        $this->selldb->updateworldsell($sell);
        $this->selldb->updateworldbuy($buy);

        echo "<script> alert('แก้ไขราคากลางสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome';
							 </script>";
    }
    
}
