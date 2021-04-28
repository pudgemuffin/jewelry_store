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
                ข้อมูลใบรับสินค้า
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="receives" id="receives" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchreceives()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary" href="<?php echo site_url('ordercon/receiveorder');?>">เพิ่มใบรับสินค้า</a>
        </div>
        <p style="text-align: right;">ข้อมูลใบรับสินค้าทั้งหมด <?php echo $count_all; ?> ใบรับสินค้า</p>

    </div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <!-- <th class="tableFixHead">รหัสบริษัท</th> -->
                            <th class="tableFixHead">เลขที่ใบรับสินค้า</th>
                            <th class="tableFixHead">วันที่รับสินค้า</th>
                            <th class="tableFixHead">พนักงาน</th>
                            <th class="tableFixHead">ข้อมูลใบรับสินค้า</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($count_all > 0){?>
                        <?php foreach ($result as $p) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo $p->Rec_Id; ?> </td>
                                <td nowrap> <?php echo $p->Rec_Date; ?> </td>
                                <td nowrap> <?php echo $p->Firstname; ?> </td>
                                <td>
                                    <a class="btn btn-success" name ="viewreceive" id="viewreceive"href="<?php echo site_url('ordercon/viewreceive/').$p->Rec_Id?>"><i class="fas fa-book-open"></i></a>
                                    <a class="btn btn-primary" name ="print" id="print"href="<?php echo site_url('callpdf/receivepdf/').$p->Rec_Id;?>"><i class="fa fa-clone"></i></a>
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
                <div style="width: 100%;" class="text-center">
            <?php
            $total_record = $count_all;
            $total_page =  ceil($total_record / $pageend); ?>
            <!-- สูตรคำนวนหาจำนวนหน้า -->

            <p class="card-description"> เลือกหน้า
                <select id="pageing123_receives" oninput="pageing_receives()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        </div>
        
<script>

    
    function pageing_receives() {
        var num_page = document.getElementById('pageing123_receives').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_receives?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

function searchreceives() {
        
        var txtsearch = document.getElementById('receives').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_receives') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }      
</script>