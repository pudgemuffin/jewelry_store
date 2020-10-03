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
                    ข้อมูลประเภทสินค้า
            </h1>
                    <div class="row" style="padding-bottom: 1px;padding-left:5px;">
                    <div class="col-3">

                        <input type="text" name="stype" id="stype" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="searchtype()" class = "btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>


                </div><br>
                <a class="btn btn-primary" target="_blank" href="<?php echo site_url('product/insertprotype'); ?>">เพิ่มประเภท</a>
        </div>

    </div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <th class="tableFixHead">รหัสประเภทสินค้า</th>
                            <th class="tableFixHead">ประเภทสินค้า</th>
                            <th class="tableFixHead">แก้ไข</th>
                            <th class="tableFixHead">ลบ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($count_all > 0){?>
                        <?php foreach ($result as $r) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Prot_Id); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Prot_Name); ?> 


                                <td>
                                    <a class="btn btn-warning" href="<?php echo site_url('product/editprotype/').$r->Prot_Id?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="deletetype(id='<?php echo $r->Prot_Id ?>')"><i class="fa fa-trash"></i></button>

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
                <select id="pageing_type" oninput="pageing123_type()">
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

function pageing123_type() {
        var num_page = document.getElementById('pageing_type').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_type?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

function searchtype() {
        
        // var datas = "stype=" + document.getElementById('stype').value
        //  alert(datas);
        var txtsearch = document.getElementById('stype').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_type') ?>",
            data: {hidesearch : txtsearch},
        }).done(function(data) {
             $('#all').html(data);        
        });
        

    }

function deletetype(protid) {
        var datas = "Prot_Id=" + protid;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('product/deletetype') ?>",
            data: datas,
        }).done(function(data) {
            $('#user_data').html(data);
        });
    }
    }

</script>        
    