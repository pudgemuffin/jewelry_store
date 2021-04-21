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
}

?>
