
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
                ข้อมูลสินค้า
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
                <a class="btn btn-primary" href="<?php echo site_url('product/addproduct'); ?>">เพิ่มสินค้า</a>
                <a class="btn btn-info" href="<?php echo site_url('product/addring'); ?>">เพิ่มสินค้าแหวน</a>
        </div>
        <p style="text-align: right;">ข้อมูลสินค้าทั้งหมด <?php echo $count_all; ?> ชิ้น </p>
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
                            <th class="tableFixHead">จำนวน</th>
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
                           
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Prot_Name); ?> 
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Prod_Name); ?></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Weight_Name); ?></td>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Weight_Grams); ?> </td>
                                <?php if ($r->Amount < 5){
                                    echo '<td nowrap style="text-align:center;  vertical-align: middle;  color: red;">'.$r->Amount.'</td>';
                                }else{
                                    echo '<td nowrap style="text-align:center;  vertical-align: middle; color:green;">'.$r->Amount.'</td>';
                                } ?>
                                <td nowrap style="text-align:center; vertical-align: middle;"> <?php echo number_format($r->Fee,2) ; ?> </td>

                                <td  style="text-align:center; vertical-align: middle;">
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php $r->Prod_Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" href="<?php echo site_url('product/editbutton/') . $r->Prod_Id ?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <!-- <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="delete1(id='<?php echo $r->Prod_Id ?>')"><i class="fa fa-trash"></i></button> -->
                                    <a class="btn btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลนี้ หรือไม่ ?');" href="<?php echo site_url('product/delete/') . $r->Prod_Id ?>"><i class="fa fa-trash"></i></a>

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
                    <h3 class="modal-title" id="ex">Product</h3>
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

function pageing123_prod() {
        var num_page = document.getElementById('pageing_prod').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_product?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

function searchpro() {
        
        // var datas = "spro=" + document.getElementById('spro').value
        // alert(datas);
        var txtsearch = document.getElementById('spro').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_product') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }

    function delete1(Prod_Id) {
        var datas = "Prod_Id=" + Prod_Id;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('product/delete') ?>",
                data: datas,
            }).done(function(data) {
                $('#user_data').html(data);
            });
        }
    }

    function edit1(Prod_Id) {
        var datas = "Prod_Id=" + Prod_Id;
        alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('product/editbutton') ?>",
            data: datas,
        }).done(function(data) {
            // console.log(data);
            $('#edit1').html(data);
        });
    }
</script>