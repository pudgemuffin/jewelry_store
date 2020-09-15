<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Report</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>



    <!-- 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css"> -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 900px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        td,
        tr,
        th {
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: red;
        }

        .tableFixHead {
            overflow-y: auto;
        }
        td{
            text-align:center;
            vertical-align: middle;
        }
        .tableFixHead {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-body">
            <h1 style="text-align: center;">
                ข้อมูลพนักงาน
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="semp" id="semp" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="search()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary" target="_blank" href="<?php echo site_url('Regis/insert'); ?>">เพิ่มพนักงาน</a>
        </div>
        <p style="text-align: right;">ข้อมูลพนักงานทั้งหมด <?php echo $count_all; ?> คน</p>
    </div>

    <center>
    
        <div>
        
            <div class="table-responsive">
            
                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>

                        <tr>
                            <th class="tableFixHead">รูปภาพ</th>
                            <th class="tableFixHead">รหัสพนักงาน</th>
                            <th class="tableFixHead">ชื่อ - 
                            นามสุกล </th>
                            <th class="tableFixHead">เพศ</th>
                            <th class="tableFixHead">อีเมล</th>
                            <th class="tableFixHead">ศาสนา</th>
                            <th class="tableFixHead">วันเกิด</th>
                            <th class="tableFixHead">แก้ไข</th>
                            <th class="tableFixHead">ลบ</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($count_all > 0){?>
                        <?php foreach ($result as $r) { ?>

                            <tr nowrap>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <img style="width: 100px; height:100px;" src="<?php echo base_url('/img/'.$r->Image);?>"></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo $r->Id; ?></td>
                           
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Firstname); ?> 
                                <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Surname); ?> </td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Gender); ?></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Email); ?> </td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Religion); ?> </td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo $r->empdate; ?> </td>

                                <td  style="text-align:center; vertical-align: middle;">
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php echo $r->Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" href="<?php echo site_url('Regis/edit/') . $r->Id ?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="delete1(id='<?php echo $r->Id ?>')"><i class="fa fa-trash"></i></button>

                                </td>
                                

                                <?php } ?>
                        <tr>   

                        </tr>                    
                        <?php }else{?>
                    <tr>
                        <td colspan="10">ไม่พบรายการข้อมูล</td>
                    </tr>
                    <?php }?>

                </table>
            </div>
            <div style="width: 100%;" class="text-center">
            <?php
            $total_record = $count_all;
            $total_page =  ceil($total_record / $pageend); ?>
            <!-- สูตรคำนวนหาจำนวนหน้า -->

            <p class="card-description"> เลือกหน้า
                <select id="pageing_emp" oninput="pageing123_emp()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        </div>

    </center>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ex">Employee</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit1">

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>

function search() {
        
        var datas = "semp=" + document.getElementById('semp').value
            // alert(datas);
       
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_emp') ?>",
            data: datas,
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }

    function delete1(Id) {
        var datas = "idcard=" + Id;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Regis/delete') ?>",
                data: datas,
            }).done(function(data) {
                $('#user_data').html(data);
            });
        }
    }

    function edit1(id) {
        var datas = "id=" + id;
        alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Regis/edit') ?>",
            data: datas,
        }).done(function(data) {
            // console.log(data);
            $('#edit1').html(data);
        });
    }
</script>