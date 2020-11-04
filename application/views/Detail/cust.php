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
                    ข้อมูลลูกค้า
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="scus" id="scus" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchcus()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary"  href="<?php echo site_url('customercon/register'); ?>">เพิ่มลูกค้า</a>
        </div>
        <p style="text-align: right;">ข้อมูลลูกค้าทั้งหมด <?php echo $count_all; ?> คน</p>
    </div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <th class="tableFixHead">รหัสลูกค้า</th>
                            <th class="tableFixHead">ชื่อ -
                            นามสุกล</th>
                            <th class="tableFixHead">เพศ</th>
                            <th class="tableFixHead">อีเมล</th>
                            <th class="tableFixHead">รายละเอียด</th>
                            <th class="tableFixHead">แก้ไข</th>
                            <th class="tableFixHead">ลบ</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($count_all > 0){?>
                        <?php foreach ($result as $r) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Id); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_fname); ?> 
                                <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_lname); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Gender); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Email); ?></td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Address); ?> </td>

                                <td>
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php echo $r->Cus_Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" href="<?php echo site_url('customercon/editcust/').$r->Cus_Id?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <!-- <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="deletecust(id='<?php echo $r->Cus_Id ?>')"><i class="fa fa-trash"></i></button> -->
                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลนี้ หรือไม่ ?');" href="<?php echo site_url('customercon/deletecust/') . $r->Cus_Id ?>"><i class="fa fa-trash"></i></a>

                                </td>
                                <!-- <td>
                                <form action="<?php echo site_url('Regis/delete') ?>?id=<?php echo $r->Cus_Id; ?>" method="POST">
                                    <button type="submit" class="btn btn-danger " name="delete" id="delete" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่ไหม');"><i class="fa fa-trash"></i></button>
                                </form>
                                </td> -->
                                <!-- <td nowrap style="text-align:center; vertical-align: middle;">
                                    <a class="btn btn-outline-success btn-sm" type="submit" href="<?php echo site_url('Welcome/excel1?AutoIDEmp=') . iconv('TIS-620', 'UTF-8', $r->Cus_Id); ?>"><button type="button" class="btn btn-success btn-sm" name="excel1"><i class="fa fa-file-excel-o"></i></button>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <a class="btn btn-outline-danger btn-sm" type="submit" target="_blank" href="<?php echo site_url('Welcome/pdf1?AutoIDEmp=') . iconv('TIS-620', 'UTF-8', $r->Cus_Id); ?>"><button type="button" class="btn btn-danger btn-sm" name="pdf1"><i class="fa fa-file-pdf-o"></i></button>
                                </td> -->

                                <?php } ?>
                        <tr>   

                        </tr>                    
                        <?php }else{?>
                    <tr>
                        <td colspan="8">ไม่พบรายการข้อมูล</td>
                    </tr>
                    <?php }?>
                            
                </table>
                <div style="width: 100%;" class="text-center">
            <?php
            $total_record = $count_all;
            $total_page =  ceil($total_record / $pageend); ?>
            <!-- สูตรคำนวนหาจำนวนหน้า -->

            <p class="card-description"> เลือกหน้า
                <select id="pageing_cus" oninput="pageing123_cus()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        </div>
            </div>
        
<script>

function pageing123_cus() {
        var num_page = document.getElementById('pageing_cus').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_cus?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

function searchcus() {
        
        // var datas = "scus=" + document.getElementById('scus').value
        //  alert(datas);
        var txtsearch = document.getElementById('scus').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_cus') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }

function deletecust(cusid) {
        var datas = "Cus_Id=" + cusid;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customercon/deletecust') ?>",
            data: datas,
        }).done(function(data) {
            $('#user_data').html(data);
        });
    }
    }

</script>        
    