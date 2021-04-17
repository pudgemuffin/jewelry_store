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
                ข้อมูลใบเสร็จ
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="hide" id="hide" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchreceipt()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary" href="<?php echo site_url('sell/sellview');?>">เพิ่มการขายสินค้า</a>
        </div>
        <p style="text-align: right;">ข้อมูลใบเสร็จทั้งหมด <?php echo $count_all; ?> ใบ</p>

    </div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <!-- <th class="tableFixHead">รหัสบริษัท</th> -->
                            <th class="tableFixHead">เลขที่ใบเสร็จ</th>
                            <th class="tableFixHead">วันที่ขายสินค้า</th>
                            <th class="tableFixHead">พนักงาน</th>
                            <th class="tableFixHead">มูลค่า</th>
                            <th class="tableFixHead">รายละเอียด</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($count_all > 0){?>
                        <?php foreach ($result as $p) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo $p->Receipt_Id; ?> </td>
                                <td nowrap> <?php echo $p->Receipt_Date; ?> </td>
                                <td nowrap> <?php echo $p->Firstname; ?> </td>
                                <td nowrap> <?php echo number_format($p->Receipt_Total,2);?></td>
                                <td>
                                    <a class="btn btn-success" name ="viewreceipt" id="viewreceipt"href="<?php echo site_url('sell/viewreceiptlist/').$p->Receipt_Id?>"><i class="fas fa-book-open"></i></a>
                                    <a class="btn btn-danger" name ="cancelsell" id="cancelsell"href="<?php echo site_url('sell/cancelsell/').$p->Receipt_Id?>"><i class="fas fa-times"></i></a>
                                </td>
                                <?php } ?>
                        <tr>   

                        </tr>                    
                        <?php }else{?>
                    <tr>
                        <td colspan="5">ไม่พบรายการข้อมูล</td>
                    </tr>
                    <?php }?>
                            
                </table>
                <div style="width: 100%;" class="text-center">
            <?php
            $total_record = $count_all;
            $total_page =  ceil($total_record / $pageend); ?>
            <!-- สูตรคำนวนหาจำนวนหน้า -->

            <p class="card-description"> เลือกหน้า
                <select id="pageing123_receipt" oninput="pageing_receipt()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        </div>
        
<script>

    
    function pageing_receipt() {
        var num_page = document.getElementById('pageing123_receipt').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_receipt?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

function searchreceipt() {
        
        var txtsearch = document.getElementById('hide').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_receipt') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }      
</script>