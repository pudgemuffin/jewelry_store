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
		$data['result'] = $this->detail->empdata();
		$data['view'] = "Detail/emp";
		$this->load->view('index',$data);
	}

	public function viewcust()
	{
		$this->load->model('customer');
		$data['result'] = $this->customer->allcust();
		$data['view'] = "Detail/cust";
		$this->load->view('index',$data);
	}

	public function viewposition()
    {
		$this->load->model('detail');
        $data['position'] = $this->detail->position();
        $data['view'] = "detail/position";
        $this->load->view('index',$data);
    }

	public function lay()
	{
		$this->load->view('layout-static');
	}
}
