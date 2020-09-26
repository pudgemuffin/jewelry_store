<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
		$this->load->model('ergold');
		$this->load->model('detail');
        $this->load->database();
	}
	
	public function index()
	{
		$this->load->model('detail');
        $start = 0;
        $pageend = 4;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = "and e.Id like '%%'";

        $count_all = $this->detail->count_all_emp($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

		$data['result'] = $this->detail->empdata($start, $pageend,  $search);
		$data['view'] = "Detail/emp";
		$this->load->view('index',$data);
	}

	public function pagingmain_emp()
    {
		$page = $this->input->get('num_page');
		
        $pageend1 = 4;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
		}		
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
		$data['pageend'] = $pageend1;
		

        $txtsearch = $this->input->post('semp');
        if($txtsearch != ''){
            $txtsearch = "and e.Id like'%$txtsearch%' or e.Firstname like'%$txtsearch%'or e.Surname like '%$txtsearch%' or e.Email like'%$txtsearch%'or e.Religion like'%$txtsearch%'";
        }else{
            $txtsearch = '';
        }
		$search = $txtsearch;


        $count_all = $this->detail->count_all_emp($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
		}
        $data['result'] = $this->detail->empdata($start, $pageend, $search);
		
        $this->load->view('Detail/emp', $data);
    }

	public function viewcust()
	{
		$this->load->model('customer');
		$start = 0;
        $pageend = 3;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = '';

        $count_all = $this->customer->count_all_customer($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

		$data['result'] = $this->customer->allcust($start, $pageend,  $search);

		$data['view'] = "Detail/cust";
		$this->load->view('index',$data);
	}

	public function pagingmain_cus()
    {
		$this->load->model('customer');
		$page = $this->input->get('num_page');
		
        $pageend1 = 3;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
		}		
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
		$data['pageend'] = $pageend1;
		

        $txtsearch = $this->input->post('scus');
        if($txtsearch != ''){
            $txtsearch = "and Cus_Id like '%$txtsearch%' or Cus_fname like '%$txtsearch%' or Cus_lname like '%$txtsearch%' or Cus_Gender like '%$txtsearch%' or Cus_Email like '%$txtsearch%' or Cus_Address like '%$txtsearch%'";
        }else{
            $txtsearch = '';
        }
		$search = $txtsearch;


        $count_all = $this->customer->count_all_customer($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

		$data['result'] = $this->customer->allcust($start, $pageend,  $search);
        $this->load->view('Detail/cust', $data);
    }

	public function viewposition()
    {
        
		$this->load->model('detail');
        $start = 0;
        $pageend = 4;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = '';

        $count_all = $this->detail->count_all_position($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

		$data['position'] = $this->detail->Position($start, $pageend,  $search);
        $data['view'] = "detail/position";
        $this->load->view('index',$data);
    }

    public function pagingmain_pos()
    {
        $page = $this->input->get('num_page');
		
        $pageend1 = 4;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
		}		
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
		$data['pageend'] = $pageend1;
		

        $txtsearch = $this->input->post('semp');
        if($txtsearch != ''){
            $txtsearch = "and Job_Id like '%$txtsearch%' or job like '%$txtsearch%'";
        }else{
            $txtsearch = '';
        }
		$search = $txtsearch;


        $count_all = $this->detail->count_all_position($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
		}
        $data['position'] = $this->detail->Position($start, $pageend, $search);
		
        $this->load->view('Detail/position', $data);
    }
    
    public function partner()
    {
        $this->load->model('partner');
        $start = 0;
        $pageend = 4;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = "";

        $count_all = $this->partner->count_partner($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->partner->allpartner($start, $pageend,  $search);
        $data['view'] = "Detail/partner";
        $this->load->view('index',$data);
    }

    public function pagingmain_part()
    {
		$this->load->model('partner');
		$page = $this->input->get('num_page');
		
        $pageend1 = 4;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
		}		
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
		$data['pageend'] = $pageend1;
		

        $txtsearch = $this->input->post('spart');
        if($txtsearch != ''){
            $txtsearch = "and p.Part_Id like '%$txtsearch%' or p.Part_Name like '%$txtsearch%' or p.Part_Email like '%$txtsearch%' or pt.Part_tel like '%$txtsearch%' or p.Part_Address like '%$txtsearch%'";
        }else{
            $txtsearch = '';
        }
		$search = $txtsearch;


        $count_all = $this->partner->count_partner($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->partner->allpartner($start, $pageend,  $search);
        $this->load->view('Detail/partner', $data);
    }
    public function protype()
    {
        $this->load->model('ergold');
        $start = 0;
        $pageend = 3;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = '';

        $count_all = $this->ergold->count_protype($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

		$data['result'] = $this->ergold->allprotype($start, $pageend,  $search);
        $data['view'] = "Detail/protype";
        $this->load->view('index',$data);
    }

    public function pagingmain_type()
    {
		$this->load->model('ergold');
		$page = $this->input->get('num_page');
		
        $pageend1 = 3;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
		}		
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
		$data['pageend'] = $pageend1;
		

        $txtsearch = $this->input->post('stype');
        if($txtsearch != ''){
            $txtsearch = "and  Prot_Id like '%$txtsearch%' or Prot_Name like '%$txtsearch%'";
        }else{
            $txtsearch = '';
        }
		$search = $txtsearch;


        $count_all = $this->ergold->count_protype($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->ergold->allprotype($start, $pageend,  $search);
        $this->load->view('Detail/protype', $data);
    }


    public function product()
    {
        $this->load->model('ergold');
        $start = 0;
        $pageend = 3;
        $data['numpage'] = 1;
        $data['pageend'] = $pageend;
        $search = '';

        $count_all = $this->ergold->count_product($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

		$data['result'] = $this->ergold->allproduct($start, $pageend,  $search);
        $data['view'] = "Detail/product";
        $this->load->view('index',$data);
    }

    public function pagingmain_product()
    {
		$this->load->model('ergold');
		$page = $this->input->get('num_page');
		
        $pageend1 = 3;
        if ($page != '') {
            $page = $page;
        } else {
            $page = 1;
		}		
        $start = ($page - 1) * $pageend1;
        $pageend = $page * $pageend1;
        $data['numpage'] = $page;
		$data['pageend'] = $pageend1;
		

        $txtsearch = $this->input->post('spro');
        if($txtsearch != ''){
            $txtsearch = "and  p.Prod_Id LIKE '%$txtsearch%' or p.Prod_Name LIKE '%$txtsearch%' or p.Prod_Gram LIKE '%$txtsearch%' or t.Prot_Name LIKE '%$txtsearch%' or w.Weight_Name like '%$txtsearch%' or Fee like '%$txtsearch%' ";
        }else{
            $txtsearch = '';
        }
		$search = $txtsearch;


        $count_all = $this->ergold->count_product($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->ergold->allproduct($start, $pageend,  $search);
        $this->load->view('Detail/product', $data);
    }

	public function lay()
	{
		$this->load->view('layout-static');
	}
}
