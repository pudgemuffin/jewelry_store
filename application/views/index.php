<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gold - Store</title>
    <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #820115;">
        <a class="navbar-brand" href="index.php">ห้างทองทองดีเยาวราช</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
        <!-- Navbar-->
        
        <!-- <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown input-group-append">
                <i class="fas fa-user fa-fw" style="vertical-align: middle; font-size: 20px;"></i><?php echo $pos;?>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                   
                    <a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">ออกจากระบบ</a>
                </div>
                
            </li>
        </ul> -->

        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown input-group-append">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw" style="color:black; font-size: 20px;"></i><?php echo $pos;?></a>
                <div class="dropdown-menu dropdown-menu-right" style="background-color: #820115;" aria-labelledby="userDropdown">
                    <a class="dropdown-item" style="background-color: #CD3838;" href="<?php echo site_url('auth/logout'); ?>">ออกจากระบบ</a>
                </div>
            </li>
        </ul>
        
    </nav>
    <?php $per = $this->session->userdata('Permit'); ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="background-color: #820115;">
                    <div class="nav">
                        <!-- <div class="sb-sidenav-menu-heading">Core</div> 
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a> -->
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"<?php if ($per[0] != 1 && $per[1] != 1 && $per[2] != 1 && $per[3] != 1 && $per[4] != 1 && $per[6] != 1){  
                                  echo "hidden";  }?>>

                            <p style="color:#ffffff;font-size:18px;">ข้อมูล</p>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="font-size:18px;color:#ffffff;"></i></div>
                        </a>
                       
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion" style="background-color: #CD3838;">
                            <nav class="sb-sidenav-menu-nested nav">
                                <!-- <a class="nav-link" href="<?php echo site_url('Welcome/lay'); ?>">Static Navigation</a> -->
                                <a class="nav-link" href="<?php echo site_url('Welcome/employee'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[0] != 1){  
                                  echo "hidden";  }?>>พนักงาน</a>
                               
                                <a class="nav-link" href="<?php echo site_url('Welcome/viewcust'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[1] != 1){  
                                    echo "hidden";}?>>ลูกค้า</a>
                                   
                                <a class="nav-link" href="<?php echo site_url('Welcome/partner'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[2] != 1){  
                                    echo "hidden";}?>>บริษัทคู่ค้า</a>
                                <a class="nav-link" href="<?php echo site_url('Welcome/viewposition'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[3] != 1){  
                                    echo "hidden";}?>>ตำแหน่ง</a>
                                <a class="nav-link" href="<?php echo site_url('Welcome/product'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[4] != 1){  
                                    echo "hidden";}?>>สินค้า</a>
                                <a class="nav-link" href="<?php echo site_url('Welcome/cost'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[6] != 1){  
                                    echo "hidden";}?>>ราคาทุน</a>
                                <a class="nav-link" href="<?php echo site_url('Welcome/promotion'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[4] != 1){  
                                    echo "hidden";}?>>โปรโมชั่น</a>

                                <?//ต้องส่งไปcontroller แล้วเรียกview?>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsegoldtype" aria-expanded="false" aria-controls="collapseLayouts"<?php if ($per[5] != 1 && $per[7] != 1){  
                                    echo "hidden";}?>>
                            <p style="color:#ffffff;font-size:18px;">กลุ่มสินค้า</p>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="font-size:18px;color:#ffffff;"></i></div>
                        </a>
                        <div class="collapse" id="collapsegoldtype" aria-labelledby="headingOne" data-parent="#sidenavAccordion" style="background-color: #CD3838;">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo site_url('Welcome/protype'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[5] != 1){  
                                    echo "hidden";}?>>ประเภททองคำ</a>
                                <a class="nav-link" href="<?php echo site_url('Welcome/index'); ?>" style="background-color: #CD3838;font-size:16px;color:#ffffff;"<?php if ($per[7] != 1){  
                                    echo "hidden";}?>>ทองคำหลุดจำนำ</a>
                            </nav>
                        </div>
                                               
                        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.php">Login</a>

                                        <a class="nav-link" href="password.php">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.php">401 Page</a>
                                        <a class="nav-link" href="404.php">404 Page</a>
                                        <a class="nav-link" href="500.php">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> -->
                        <a class="nav-link" href="<?php echo site_url('Welcome/index'); ?>" style="font-size:16px;color:#ffffff;"<?php if ($per[7] != 1){  
                                    echo "hidden";}?>>การจำนำ<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right" style="font-size:18px;color:#ffffff;"></i></div></a>
                        <a class="nav-link" href="<?php echo site_url('Welcome/index'); ?>" style="font-size:16px;color:#ffffff;"<?php if ($per[9] != 1){  
                                    echo "hidden";}?>>สั่งซื้อสินค้า<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right" style="font-size:18px;color:#ffffff;"></i></div></a>
                        <a class="nav-link" href="<?php echo site_url('Welcome/index'); ?>" style="font-size:16px;color:#ffffff;"<?php if ($per[8] != 1){  
                                    echo "hidden";}?>>ขายสินค้า<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right" style="font-size:18px;color:#ffffff;"></i></div></a>
                        <a class="nav-link" href="<?php echo site_url('Welcome/index'); ?>" style="font-size:16px;color:#ffffff;"<?php if ($per[10] != 1){  
                                    echo "hidden";}?>>ออกรายงาน<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right" style="font-size:18px;color:#ffffff;"></i></div></a>
                    </div>
                </div>
                <div class="sb-sidenav-footer" style="background-color: #820115;">
                <?php  ?>
                    <div class="small">ลงชื่อเข้าใช้โดย : <?php echo $fname.' - '.$sname.$per[0].$per[1].$per[2].$per[3].$per[4].$per[5].$per[6].$per[7].$per[8].$per[9].$per[10]; ?></div>
                    <br>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">ยินดีต้อนรับ</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->

                    <form id="search_form">
                    <?php $search = $this->input->post('semp'); 
                          $search = $this->input->post('scus');
                          $search = $this->input->post('spart');
                          $search = $this->input->post('spos'); 
                          $search = $this->input->post('stype');
                          $search = $this->input->post('spartcost');
                          $search = $this->input->post('spromo');?>
                    <!-- <div id="search_form"> -->
                        <div class="card mb-4">
                            <input type="hidden" name="hidesearch" id="hidesearch" value="<?php if ($search != "")
                                                                            echo $search; ?>">
                            <div id="all" class="content">
                                <?php $this->load->view($view); ?>
                            </div>
                        </div>
                    <!-- </div> -->
                    </form>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>

            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('assets/demo/datatables-demo.js') ?>"></script>


    <!-- <div class="modal fade" id="Addprotype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Add protype</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php// $this->load->view('registers'); ?>
                    </div>
                </div>
            </div>
        </div> -->



</body>

</html>
<script>

    // function add() {


    // $.ajax({
    //     type: "POST",
    //     url: window.open("<?php echo site_url('Regis/add') ?>"),
    //     data: datas,
    // }).done(function(data) {

    //     $('#viewmodal').html(data);
    //     // console.log(data);
    //     document.getElementById('id01').style.display = 'block'

    // });
    // }
</script>