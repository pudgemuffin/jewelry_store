<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class ordercon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('ordermod');
        $this->load->database();
    }

    public function ordergenid()
    {
        $ye = date('ym');
        $max = $this->ordermod->maxid();
        if($max == ''){
            $ordid = 'ORD' . $ye . '001';
            return $ordid;
            // echo $ordid;
        }else{
            $yeId = substr($max, 3, 4);
            if($yeId != $ye){

                return $ordid = 'ORD' . $ye . '001';
                // echo $ordid;
            }else{
                $ordid = substr($max, 7);
                $ordid += 1;
                while(strlen($ordid) < 3){
                    $ordid = '0' . $ordid;
                }
                $ordid = 'ORD' . $yeId . $ordid;
                return $ordid;
                // echo $ordid;
                
            }
        }
    }

    public function addorder()
    {
        $this->load->model('partner');
        $this->load->model('ergold');
        $ordid = $this->ordergenid();
        $data['partner'] = $this->partner->partnerdetail();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['id'] = $this->session->userdata('id');
        $data['result'] = $this->ordermod->Part();
        $data['view'] = "add/order";

        $this->load->view('actionindex', $data);
    }
    public function partnerord()
    {
        $this->load->model('ergold');
        $prodid = $this->input->post('hello');
        $partner = $this->input->post('part');
        $row = $this->input->post('row');
    //    echo $prodid;

        if ($prodid != '') {
            $prodid = "and cost.Prod_Id = '$prodid'";
        } else {
            $prodid = '';
        }
        if ($partner != ''){
            $partner = "and partner.Part_Id = '$partner'";
        }else{
            $partner = '';
        }

        $search = $prodid.$partner;
        
        $data['result'] = $this->ordermod->Partneror($search);
        foreach ($data['result'] as $r){
        echo '<tr id = "order'.$row.'">';
        echo '<td><input class="form-control" type="text" id="partname[]" name="partname[]" value="'. $r->Part_Name.'" readonly></td>';
        echo  '<input class="form-control" type="hidden" id="partid[]" name="partid[]" value="'. $r->Part_Id.'" >';
        echo  '<td><input class="form-control" type="text" id="product[]" name="product[]" value="'. $r->Prod_Name.'" readonly></td>';
        echo  '<input class="form-control" type="hidden" id="idproduct[]" name="idproduct[]" value="'. $r->Prod_Id.'" >';
        echo  '<td><input class="price form-control" type="text" id="price[]" name="price[]" value="'. $r->Cost_Price.'"readonly></td>';
        echo  '<td><input class="orderinput form-control" type = "number" id="piece[]" name="piece[]" required value="0" min="0"  onkeypress="return numberonly(event)"></td>';
        echo  '<td><input class="orderTotal form-control" id="total" name="total[]" readonly value="0"></td>'; 
        // echo  '<td><button type="button" class="prodid" id="prodid" name="prodid" value="'. $r->Prod_Id . "" . $r->Part_Id.'">sdasd</button></td> </td>';
        echo '<td  width="6%">  <a href="#"class="btn btn-danger remove" style="border-radius: 5px; width: 60px; "> <i class="fas fa-minus-circle"></i></a> </td>';
        echo  '</tr>';
        }
        
    }

    public function ajxpart()
    {
        $partner = $this->input->post('part');
        if ($partner != ''){
            $partner = "and partner.Part_Id = '$partner'";
        }else{
            $partner = '';
        }

        $data['result'] = $this->ordermod->Partajx($partner);
        echo '<table id="aaaa" class="display">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ชื่อบริษัท</th>';
        echo '<th>ชื่อสินค้า</th>';
        echo '<th>ราคาทุน</th>';
        echo '<th>ไซส์</th>';
        echo '<th>เพิ่มสินค้า</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody class="show_part">';
        foreach ($data['result'] as $r){
            echo '<tr>';
            echo '<td>'.  $r->Part_Name  .'</td>';
            echo '<td>'. $r->Prod_Name .' </td>';
            echo '<td>'.  $r->Cost_Price .'</td>';
            echo '<td>'.  $r->Size .'</td>';
            echo '<td><button type="button" class="prodid" id="prodid" name="prodid" value="'. $r->Prod_Id . "" . $r->Part_Id.'">เพิ่ม</button></td>';
            echo '</tr>';

        }

    }

    public function ordinsert()
    {
        $ordid = $this->ordergenid();
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $idproduct = $this->input->post('idproduct');
        $price = $this->input->post('price');
        $piece = $this->input->post('piece');
        $partid = $this->input->post('partid');
        $total = $this->input->post('alltotal');
        $total_piece = $this->input->post('total');
        $ordstat = 1;
        
        // echo $date;

        foreach($partid as $pid){
            $part = $pid;
        }
        // echo $total;
        // echo $ordstat;
        // echo $ordid;
        $count =  count($idproduct);
        
        $data['insert'] = $this->ordermod->insertor($ordid,$date,$total,$ordstat,$part,$id);

        
         for($i=0; $i<$count; $i++){ 
                $this->ordermod->insertord($price[$i],$piece[$i],$ordid,$idproduct[$i],$total_piece[$i]);     
            }
         
         echo "<script> alert('เพิ่มข้อมูลใบสั่งซื้อสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome';
							 </script>";
    }

    public function viewdata($ordid)
    {
        $data['vieworder'] = $this->ordermod->vieworder($ordid);
        $data['suborder'] = $this->ordermod->viewsuborder($ordid);     
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/vieworder";
        $this->load->view('actionindex', $data);
        // $this->load->view('add/vieworder',$data);
        // echo $ordid;
        // print_r ($data['vieworder']);
    }

    public function receiveorder()
    {
        $data['order'] = $this->ordermod->receive();
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['id'] = $this->session->userdata('id');
        $data['view'] = "add/receive";

        $this->load->view('actionindex', $data);
    }

    public function ajaxreceive()
    {
        $ord = $this->input->post('ord');
        
        $data['result'] = $this->ordermod->ordajax($ord);
        
        
        $i = 0;
        foreach ($data['result'] as $r){
            
            echo '<tr id="rec'.$i.'">';
            echo '<td>'.  $r->Part_Name  .'</td>';
            echo '<td>'. $r->Prod_Name .' <input class ="prodid" id = "prodid" name = "prodid[]" type = "hidden" value ="'.$r->Prod_Id.'"></td>';
            echo '<td><input class="remaining form-control" value = "'.  $r->Remaining .'" readonly><input id = "ordid" name = "ordid[]" type = "hidden" value ="'.$r->Ord_Id.'"><input class ="ordprice" id = "ordprice" name = "ordprice[]" type = "hidden" value = "'.$r->Ord_Price.'"></td>';
            echo '<td><input class="recinput form-control" type = "number" id="rec" name="rec[]" required value="0" min="1" max = "'. $r->Remaining .'" onkeypress="return numberonly(event)"></td>';
            echo '<input class = "price" id = "priceper" name = "priceper[]" type ="hidden" value = "'.$r->Priceper.'">';
            echo '<input class="orderTotal" id = "pertoltal" name = "pertoltal[]" type="hidden" value = "0">';            
            echo '<td><input class="remain form-control" type = "number" id="remain" name="remain[]" required value="0" min="0" readonly></td>';
            echo '<td  width="6%">  <a href="#"class="btn btn-danger remove" style="border-radius: 5px; width: 60px; "> <i class="fas fa-minus-circle"></i></a> </td>';
            echo '</tr>';
            $i++;
        }
        echo '<input class = "alltotal" id = "alltotal" name = "alltotal" type="hidden" value = "0">';

    }

    public function genreceive()
    {
        $ye = date('ym');
        $max = $this->ordermod->maxrec();
        if($max == ''){
            $recid = 'REC' . $ye . '001';
            return $recid;
            // echo $recid;
        }else{
            $yeId = substr($max, 3, 4);
            if($yeId != $ye){

                return $recid = 'REC' . $ye . '001';
                // echo $recid;
            }else{
                $recid = substr($max, 7);
                $recid += 1;
                while(strlen($recid) < 3){
                    $recid = '0' . $recid;
                }
                $recid = 'REC' . $yeId . $recid;
                return $recid;
                // echo $recid;
                
            }
        }
    }

    public function genlot()
    {
        $ye = date('ym');
        $max = $this->ordermod->maxlot();
        if($max == ''){
            $lotid = 'LOT' . $ye . '001';
            return $lotid;
            // echo $lotid;
        }else{
            $yeId = substr($max, 3, 4);
            if($yeId != $ye){

                return $lotid = 'LOT' . $ye . '001';
                // echo $lotid;
            }else{
                $lotid = substr($max, 7);
                $lotid += 1;
                while(strlen($lotid) < 3){
                    $lotid = '0' . $lotid;
                }
                $lotid = 'LOT' . $yeId . $lotid;
                return $lotid;
                // echo $lotid;
                // echo $yeId;
                
            }
        }
    }

    public function receive()
    {
        $recid = $this->genreceive();
        $prodid = $this->input->post('prodid');
        $rec = $this->input->post('rec');
        $ordid = $this->input->post('ordid');
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $remain = $this->input->post('remain');
        $lotid = $this->genlot();
        // $ordprice = $this->input->post('alltotal');
        $per = $this->input->post('priceper');
        $ordper = $this->input->post('pertoltal');
        $ordprice = $this->input->post('alltotal');
        // echo $recid;
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // foreach($ordprice as $op){
        //     $price = $op;
        // }

        $count =  count($prodid);

        $data['insert'] = $this->ordermod->insertrec($recid,$date,$id);
        $data['insertlot'] = $this->ordermod->insertlot($lotid,$date,$ordprice);

        for($i=0; $i<$count; $i++){

            $this->ordermod->insertsubrec($recid,$ordid[$i],$prodid[$i],$rec[$i]);
            $this->ordermod->updatesubord($remain[$i],$ordid[$i],$prodid[$i]);
            $this->ordermod->insertsublot($lotid,$recid,$rec[$i],$prodid[$i],$per[$i],$ordper[$i]);

        }
        foreach($ordid as $oid){
            $ord = $oid;
        }
        $check = $this->ordermod->checkremainorder($ord);
        echo $check;
        if($check == 0){
            $this->ordermod->updateorder($ord);
        }

        echo "<script> alert('เพิ่มข้อมูลใบรับสินค้าสำเร็จ');
		 					window.location.href='/ER_GOLDV1/index.php/Welcome/receives';
							 </script>";

    }

    public function viewreceive($recid)
    {
        $data['viewreceive'] = $this->ordermod->viewreceive($recid);
        $data['viewsubreceive'] = $this->ordermod->viewsubreceive($recid);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/viewreceive";
        $this->load->view('actionindex', $data);
        // print_r ($data['viewreceive']);
    }

    public function viewlots($lot)
    {
        $data['viewlots'] = $this->ordermod->viewlots($lot);
        $data['viewsublots'] = $this->ordermod->viewsublots($lot);
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname']= $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "add/viewlots";
        $this->load->view('actionindex', $data);
    }
}

?>