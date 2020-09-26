
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

                        <input type="text" name="spro" id="spro" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchpro()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary" target="_blank" href="<?php echo site_url('product/addproduct'); ?>">เพิ่มสินค้า</a>
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
                            <th class="tableFixHead">รหัสสินค้า</th>
                            <th class="tableFixHead">ประเภทสินค้า</th>
                            <th class="tableFixHead">ชื่อสินค้า</th>
                            <th class="tableFixHead">น้ำหนัก</th>
                            <th class="tableFixHead">น้ำหนักสินค้า</th>
                            <th class="tableFixHead">ค่ากำเหน็จ</th>
                            <th class="tableFixHead">แก้ไข</th>
                            <th class="tableFixHead">ลบ</th>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($count_all > 0){?>
                        <?php foreach ($result as $r) { ?>

                            <tr nowrap>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <img style="width: 100px; height:100px;" src="<?php echo base_url('/img/product/'.$r->Prod_Img);?>"></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo $r->Prod_Id; ?></td>
                           
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Type); ?> 
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Prod_Name); ?></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Weight); ?></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Prod_Gram); ?> </td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo $r->Fee; ?> </td>

                                <td  style="text-align:center; vertical-align: middle;">
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php echo $r->Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" href="<?php echo site_url('Regis/edit/') . $r->Prod_Id ?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="delete1(id='<?php echo $r->Prod_Id ?>')"><i class="fa fa-trash"></i></button>

                                </td>
                                

                                <?php } ?>
                        <tr>   

                        </tr>                    
                        <?php }else{?>
                    <tr>
                        <td colspan="9">ไม่พบรายการข้อมูล</td>
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
                <select id="pageing_prod" oninput="pageing123_prod()">
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

function searchpro() {
        
        var datas = "spro=" + document.getElementById('spro').value
            // alert(datas);
       
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_product') ?>",
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