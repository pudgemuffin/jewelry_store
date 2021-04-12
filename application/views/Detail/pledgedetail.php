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
            ข้อมูลใบจำนำ
        </h1>
        <div class="row" style="padding-bottom: 1px;padding-left:5px;">
            <div class="col-3">

                <input type="text" name="ple" id="ple" class="form-control">
            </div>
            <div class="col-2">
                <button type="button" onclick="searchpl()" class="btn btn-secondary">
                    <i class="fa fa-search"></i>
                </button>
            </div>


        </div><br>
        <a class="btn btn-primary" href="<?php echo site_url('pledgecon/pledge'); ?>">เพิ่มใบจำนำ</a>
    </div>
    <p style="text-align: right;">ข้อมูลใบจำนำทั้งหมด <?php echo $count_all; ?> ใบ</p>
</div>
<div class="table-responsive">

    <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
        <thead>

            <tr>
                <th class="tableFixHead">รหัสใบจำนำ</th>
                <th class="tableFixHead">ชื่อ -
                    นามสุกล</th>
                <th class="tableFixHead">ราคาไถ่ออก</th>
                <th class="tableFixHead">เปอร์เซ็น</th>
                <th class="tableFixHead">วันเริ่ม</th>
                <th class="tableFixHead">จำนวนเดือน</th>
                <th class="tableFixHead">ค่าดอกเบี้ย</th>
                <th class="tableFixHead">รายละเอียด</th>
                <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
            </tr>
        </thead>
        <tbody>
            <?php if ($count_all > 0) { ?>
                <?php foreach ($result as $r) { ?>

                    <tr nowrap>
                        <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Pledge_Id); ?> </td>
                        <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Name); ?>
                        <td nowrap> <?php echo number_format($r->Pledge_Price,2); ?>
                        <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Pledge_Debt.' %'); ?>
                        <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Pledge_Sdate); ?> </td>
                        <td nowrap> <?php echo ($r->Pledge_Month)/30; ?> </td>
                        <td nowrap> <?php echo number_format($r->Pledge_Debt_Price,2); ?></td>

                        <td>
                            <a class="btn btn-warning" href="<?php echo site_url('pledgecon/selectpledge/') . $r->Pledge_Id ?>"><i class="fa fa-cog"></i></a>
                        </td>


                    <?php } ?>
                    <tr>

                    </tr>
                <?php } else { ?>
                    <tr>
                        <td colspan="9">ไม่พบรายการข้อมูล</td>
                    </tr>
                <?php } ?>

    </table>
    <div style="width: 100%;" class="text-center">
        <?php
        $total_record = $count_all;
        $total_page =  ceil($total_record / $pageend); ?>
        <!-- สูตรคำนวนหาจำนวนหน้า -->

        <p class="card-description"> เลือกหน้า
            <select id="pageing_pledge" oninput="pageing123_pledge()">
                <option style="display: none;" value="<?php echo $numpage; ?>"><?php echo $numpage; ?></option>
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            ทั้งหมด <?php echo $i - 1; ?> หน้า
        </p>
    </div>
</div>
</div>

<script>
    function pageing123_pledge() {
        var num_page = document.getElementById('pageing_pledge').value;
        var txtsearch = document.getElementById('hidesearch').value;
        //    alert(num_page);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_pledge?num_page=') ?>" + num_page,
            data: $("#search_form").serialize(),
        }).done(function(data) {
            console.log(data);
            $('#all').html(data);

        });
    }

    function searchpl() {

        // var datas = "scus=" + document.getElementById('scus').value
        //  alert(datas);
        var txtsearch = document.getElementById('ple').value;
        document.getElementById('hidesearch').value = txtsearch;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Welcome/pagingmain_pledge') ?>",
            data: {
                hidesearch: txtsearch
            },
        }).done(function(data) {
            $('#all').html(data);
        });


    }

    function deletecust(cusid) {
        var datas = "Cus_Id=" + cusid;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")) {
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