<!DOCTYPE html>
<html lang="en">

<head>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ราคาทุน</title>
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>



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
<div class="card">
        <div class="card-body">
            <h1 style="text-align: center;">
                ข้อมูลตำแหน่ง
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="spos" id="spos" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchposi()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary"  href="<?php echo site_url('positioncon/insertviewposi');?>">เพิ่มตำแหน่ง</a>
        </div>
        <p style="text-align: right;">ข้อมูลตำแหน่งทั้งหมด <?php echo $count_all; ?> ตำแหน่ง</p>
    </div>
<body>
    <center>
        <div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <th class="tableFixHead">รหัสตำแหน่ง</th>
                            <th class="tableFixHead">ชื่อตำแหน่ง</th>
                            <th class="tableFixHead">แก้ไข</th>
                            <th class="tableFixHead">ลบ</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($count_all > 0){?>
                        <?php foreach ($position as $r) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo $r->Pos_Id; ?></td>
                                <td nowrap> <?php echo $r->Pos_Name; ?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?php echo site_url('positioncon/editjob/').$r->Pos_Id?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <!-- <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="deletejob(id='<?php echo $r->Pos_Id ?>')"><i class="fa fa-trash"></i></button> -->
                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลนี้ หรือไม่ ?');" href="<?php echo site_url('positioncon/deletejob/') . $r->Pos_Id ?>"><i class="fa fa-trash"></i></a>
                        </td>
                        <?php } ?>
                        <tr>   

                        </tr>                    
                        <?php }else{?>
                    <tr>
                        <td colspan="4">ไม่พบรายการข้อมูล</td>
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
                <select id="pageing_pos" oninput="pageing123_pos()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        </div>
        
    </center>
</body>

</html>
<script>

function pageing123_pos() {
        var num_page = document.getElementById('pageing_pos').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_pos?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

function searchposi() {
        
        // var datas = "spos=" + document.getElementById('spos').value
        // alert(datas);
        var txtsearch = document.getElementById('spos').value;
        document.getElementById('hidesearch').value = txtsearch;
       
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_pos') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }                     

    function deletejob(Pos_Id) {
        var datas = "Pos_Id=" + Pos_Id;
        if (confirm("คุณต้องการลบตำแหน่งนี้ หรือไม่")){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('positioncon/deletejob') ?>",
            data: datas,
        }).done(function(data) {
            $('#user_data').html(data);
        });
    }
    }

    // function edit1(id) {
    //     var datas = "id=" + id;
    //     alert(datas);

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Regis/edit') ?>",
    //         data: datas,
    //     }).done(function(data) {
            
    //     });
    // }

    

</script>