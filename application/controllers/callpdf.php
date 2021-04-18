<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class callpdf extends CI_Controller
{
    public function testpdf()
    {
       
        $mpdf = new \Mpdf\Mpdf();

        $receipt = $this->load->view('Detail/receipt','',true);
        $mpdf->WriteHTML($receipt);

       
        $mpdf->Output();
        
    }
}

?>
