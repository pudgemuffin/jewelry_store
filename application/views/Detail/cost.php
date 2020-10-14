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
                ข้อมูลบริษัทคู่ค้า
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="spartcost" id="spartcost" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchpartcost()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary" href="<?php echo site_url('company/cost');?>">เพิ่มราคาทุน</a>
        </div>
        <p style="text-align: right;">ข้อมูลบริษัทคู่ค้าทั้งหมด <?php echo $count_all; ?> บริษัท</p>

    </div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <!-- <th class="tableFixHead">รหัสบริษัท</th> -->
                            <th class="tableFixHead">ชื่อบริษัท</th>
                            <th class="tableFixHead">สินค้า</th>
                            <th class="tableFixHead">เพิ่มสินค้า</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($count_all > 0){?>
                        <?php foreach ($result as $p) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo $p->Part_Id; ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $p->Part_Name); ?> </td>
                                <!-- <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $p->tel); ?> </td> -->
                                <td>
                                    <a class="btn btn-success" name ="addcost" id="addcost"href="<?php echo site_url('company/cost/').$p->Part_Id?>"><i class="fa fa-plus-circle"></i></a>
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
                <select id="pageing_partcost" oninput="pageing123_partcost()">
                    <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                ทั้งหมด <?php echo $i - 1; ?> หน้า </p>
        </div>
        </div>
        
<script>

function pageing123_partcost() {
        var num_page = document.getElementById('pageing_partcost').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_cost?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            // console.log(data);
            $('#all').html(data);

        });
    }

function searchpartcost() {
        
        var txtsearch = document.getElementById('spartcost').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_cost') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }                    
</script>