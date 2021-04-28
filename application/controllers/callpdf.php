<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class callpdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('selldb');
        $this->load->database();
    }

    public function testpdf()
    {
       
        $mpdf = new \Mpdf\Mpdf();
        
        $receipt = $this->load->view('Detail/receipt','',true);
        $mpdf->WriteHTML($receipt);

       
        $mpdf->Output();
        
    }

    public function printreceipt($repid)
    {
       
       $data['head'] = $this->selldb->receipthead($repid); 
       $data['receipt'] = $this->selldb->receiptdetailv2($repid);
       $view = $this->load->view('Detail/receipt',$data,true);
       $mpdf = new \Mpdf\Mpdf([
           'format' => [130,200]
       ]);
       
       $mpdf->WriteHTML($view);
       $mpdf->Output();
    }

    public function printpledge($plid)
    {
        $this->load->model('pledgedb');
        $data['pledge'] = $this->pledgedb->selecetpledgereceipt($plid);
        

        $view = $this->load->view('Detail/pledgereceipt',$data,true);
       $mpdf = new \Mpdf\Mpdf([
           'format' => [130,200]
       ]);
       
       $mpdf->WriteHTML($view);
       $mpdf->Output();

    }

    public function orderpdf($ordid)
    {
        $this->load->model('ordermod');
        $data['vieworder'] = $this->ordermod->vieworder($ordid);
        $data['suborder'] = $this->ordermod->viewsuborder($ordid); 

        $view = $this->load->view('Detail/printorder',$data,true);

        $mpdf = new \Mpdf\Mpdf;

        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function receivepdf($recid)
    {
        $this->load->model('ordermod');
        $data['viewreceive'] = $this->ordermod->viewreceive($recid);
        $data['viewsubreceive'] = $this->ordermod->viewsubreceive($recid);
        $view = $this->load->view('Detail/printreceive',$data,true);

        $mpdf = new \Mpdf\Mpdf;

        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}

?>
