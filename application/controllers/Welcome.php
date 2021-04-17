<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
set_time_limit(0);
ini_set('memory_limit', '-1');

class Welcome extends CI_Controller
{

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
        $id = $this->session->userdata('id');
        if (!$id) {
            echo "<script> 
            window.alert('กรุณาลงชื่อเข้าใช้งาน');
            window.location.href='/ER_GOLDV1/index.php/auth/loginform';
            </script>";
        }
        $this->load->helper('url', 'form', 'html');   //เรียกมาใช้ 
        $this->load->library('session', 'upload');
        $this->load->model('ergold');
        $this->load->model('detail');
        $this->load->database();
    }

    public function index()
    {
        // $per = $this->session->userdata('Permit');
        $data['fname'] = $this->session->userdata('Firstname');
        $data['sname'] = $this->session->userdata('Surname');
        $data['pos'] = $this->session->userdata('Pos');
        $data['view'] = "Firstpage";
        $this->load->view('index', $data);
        // if($per[0] == '1'){
        //     echo "hello";
        // }else{
        //     echo "ez";
        // }
        // $this->load->model('detail');
        // $start = 0;
        // $pageend = 3;
        // $data['numpage'] = 1;
        // $data['pageend'] = $pageend;
        // $search = "and e.Id like '%%'";

        // $count_all = $this->detail->count_all_emp($search);
        // foreach ($count_all as $value) {
        //     $data['count_all'] = $value->Count;
        // }

        // $data['result'] = $this->detail->empdata($start, $pageend,  $search);
        // $data['view'] = "Detail/emp";
        // $this->load->view('index', $data);
    }

    public function employee()
    {
        $per = $this->session->userdata('Permit');
        if ($per[0] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('detail');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;

            $search = "";

            $count_all = $this->detail->count_all_emp($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->detail->empdata($start, $pageend,  $search);
            $data['view'] = "Detail/emp";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_emp()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');
        // echo '<script>alert("'.$txtsearch.'");</script>';

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




        // $txtsearch = $this->input->post('semp');
        if ($txtsearch != '') {
            $txtsearch = "and e.Id like'%$txtsearch%' or e.Firstname like'%$txtsearch%'or e.Surname like '%$txtsearch%' or e.Email like'%$txtsearch%'or e.Religion like'%$txtsearch%' or j.Pos_Name like '%$txtsearch%'
            or e.Gender like '%$txtsearch%'";
            //or et.emp_tel like '%$txtsearch%'
        } else {
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
        $per = $this->session->userdata('Permit');
        if ($per[1] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
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
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_cus()
    {
        $this->load->model('customer');
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('scus');
        if ($txtsearch != '') {
            $txtsearch = "and Cus_Id like '%$txtsearch%' or Cus_fname like '%$txtsearch%' or Cus_lname like '%$txtsearch%' or Cus_Gender like '%$txtsearch%' or Cus_Email like '%$txtsearch%' or Cus_Address like '%$txtsearch%'";
        } else {
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
        $per = $this->session->userdata('Permit');
        if ($per[3] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
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
            $data['view'] = "Detail/position";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_pos()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');
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


        // $txtsearch = $this->input->post('semp');
        if ($txtsearch != '') {
            $txtsearch = "and Pos_Id like '%$txtsearch%' or Pos_Name like '%$txtsearch%'";
        } else {
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
        $per = $this->session->userdata('Permit');
        if ($per[2] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('partner');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = "";

            $count_all = $this->partner->count_partner($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->partner->allpartner($start, $pageend,  $search);
            $data['view'] = "Detail/partner";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_part()
    {
        $this->load->model('partner');
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('spart');
        if ($txtsearch != '') {
            $txtsearch = "and p.Part_Id like '%$txtsearch%' or p.Part_Name like '%$txtsearch%' or p.Part_Email like '%$txtsearch%' or pt.Part_tel like '%$txtsearch%' or p.Part_Address like '%$txtsearch%'";
        } else {
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
        $per = $this->session->userdata('Permit');
        if ($per[5] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
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
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_type()
    {
        $this->load->model('ergold');
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('stype');
        if ($txtsearch != '') {
            $txtsearch = "and  Prot_Id like '%$txtsearch%' or Prot_Name like '%$txtsearch%'";
        } else {
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
        $per = $this->session->userdata('Permit');
        if ($per[4] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
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
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_product()
    {
        $this->load->model('ergold');
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('spro');
        if ($txtsearch != '') {
            $txtsearch = "and  p.Prod_Id LIKE '%$txtsearch%' or p.Prod_Name LIKE '%$txtsearch%' or p.Prod_Gram LIKE '%$txtsearch%' or t.Prot_Name LIKE '%$txtsearch%' or w.Weight_Name like '%$txtsearch%' or Fee like '%$txtsearch%' ";
        } else {
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

    public function cost()
    {
        $per = $this->session->userdata('Permit');
        if ($per[6] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('partner');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->partner->count_cost($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->partner->allcost($start, $pageend,  $search);
            $data['view'] = "Detail/cost";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_cost()
    {
        $this->load->model('partner');
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('spart');
        if ($txtsearch != '') {
            $txtsearch = "and p.Part_Id like '%$txtsearch%' or p.Part_Name like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->partner->count_partner($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->partner->allpartner($start, $pageend,  $search);
        $this->load->view('Detail/cost', $data);
    }


    public function promotion()
    {
        $per = $this->session->userdata('Permit');
        if ($per[4] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('ergold');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->ergold->count_promotion($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->ergold->allpromotion($start, $pageend,  $search);
            $data['view'] = "Detail/promotion";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_promo()
    {
        $this->load->model('ergold');
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('spart');
        if ($txtsearch != '') {
            $txtsearch = "and Promotion_Id like '%$txtsearch%' or Prom_Name like '%$txtsearch%' or Prom_Discount like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->ergold->count_promotion($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->ergold->allpromotion($start, $pageend,  $search);
        $this->load->view('Detail/promotion', $data);
    }

    public function order()
    {
        $per = $this->session->userdata('Permit');
        if ($per[4] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('ergold');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->detail->count_orders($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->detail->ordersdata($start, $pageend,  $search);
            $data['view'] = "Detail/orderdata";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }        

    }

    public function pagingmain_orders()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        // $txtsearch = $this->input->post('spart');
        if ($txtsearch != '') {
            $txtsearch = "and Ord_Id like '%$txtsearch%' or Ord_Date like '%$txtsearch%' or partner.Part_Name like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->detail->count_orders($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->detail->ordersdata($start, $pageend,  $search);
        $this->load->view('Detail/orderdata', $data);
    }

    public function receives()
    {
        $per = $this->session->userdata('Permit');
        if ($per[4] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('ergold');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->detail->count_receive($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->detail->receivedata($start, $pageend,  $search);
            $data['view'] = "Detail/receivedata";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }        
    }

    public function pagingmain_receives()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        
        if ($txtsearch != '') {
            $txtsearch = "and Rec_Id like '%$txtsearch%' or Rec_Date like '%$txtsearch%' or Firstname like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->detail->count_receive($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->detail->receivedata($start, $pageend,  $search);
        $this->load->view('Detail/receivedata', $data);
    }
    
    public function lots()
    {
        $per = $this->session->userdata('Permit');
        if ($per[4] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('ergold');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->detail->count_lots($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->detail->lots($start, $pageend,  $search);
            $data['view'] = "Detail/lots";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_lots()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');

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


        
        if ($txtsearch != '') {
            $txtsearch = "and Lot_Id like '%$txtsearch%' or Lot_Date like '%$txtsearch%' or Lot_Cost like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->detail->count_lots($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->detail->lots($start, $pageend,  $search);
        $this->load->view('Detail/lots', $data);
    }

    public function allpledge()
    {
        $per = $this->session->userdata('Permit');
        if ($per[7] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('pledgedb');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->pledgedb->count_allpledge($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->COUNT;
            }

            $data['result'] = $this->pledgedb->allpledge($start, $pageend,  $search);
            $data['view'] = "Detail/pledgedetail";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_pledge()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');
        $this->load->model('pledgedb');

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


        
        if ($txtsearch != '') {
            $txtsearch = "and Pledge_Id like '%$txtsearch%' or Pledge_Price like '%$txtsearch%' or Pledge_Debt like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->pledgedb->count_allpledge($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->COUNT;
        }

        $data['result'] = $this->pledgedb->allpledge($start, $pageend,  $search);
        $this->load->view('Detail/pledgedetail', $data);
    }

    public function allreceipt()
    {
        $per = $this->session->userdata('Permit');
        if ($per[7] != 1) {
            echo "<script> 
            window.alert('คุณไม่มีสิทธิ์ในการใช้งาน');
            window.history.back();
            </script>";
        } else {
            $this->load->model('selldb');
            $start = 0;
            $pageend = 3;
            $data['numpage'] = 1;
            $data['pageend'] = $pageend;
            $search = '';

            $count_all = $this->selldb->count_receipt($search);
            foreach ($count_all as $value) {
                $data['count_all'] = $value->Count;
            }

            $data['result'] = $this->selldb->receiptview($start, $pageend,  $search);
            $data['view'] = "Detail/receiptview";
            $data['fname'] = $this->session->userdata('Firstname');
            $data['sname'] = $this->session->userdata('Surname');
            $data['pos'] = $this->session->userdata('Pos');
            $this->load->view('index', $data);
        }
    }

    public function pagingmain_receipt()
    {
        $page = $this->input->get('num_page');
        $txtsearch = $this->input->post('hidesearch');
        $this->load->model('selldb');

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


        
        if ($txtsearch != '') {
            $txtsearch = "and receipt.Receipt_Id like '%$txtsearch%' or receipt.Receipt_Total like '%$txtsearch%' or employee.Firstname like '%$txtsearch%'";
        } else {
            $txtsearch = '';
        }
        $search = $txtsearch;


        $count_all = $this->selldb->count_receipt($search);
        foreach ($count_all as $value) {
            $data['count_all'] = $value->Count;
        }

        $data['result'] = $this->selldb->receiptview($start, $pageend,  $search);
        $this->load->view('Detail/receiptview', $data);
    }

    public function lay()
    {
        $this->load->view('layout-static');
    }
}
