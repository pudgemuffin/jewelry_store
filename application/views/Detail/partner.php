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
                <a class="btn btn-primary" target="_blank" href="<?php echo site_url('company/addpartner');?>">เพิ่มบริษัทคู่ค้า</a>
        </div>

    </div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <th class="tableFixHead">Name</th>
                            <th class="tableFixHead">Email</th>
                            <th class="tableFixHead">Telephone</th>
                            <th class="tableFixHead">Address</th>
                            <th class="tableFixHead">Edit</th>
                            <th class="tableFixHead">Delete</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($partner as $p) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $p->Part_Name); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $p->Part_Email); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $p->Part_Tel); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $p->Part_Address); ?> </td>
                                <td>
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php echo $p->Cus_Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" name ="editpart" id="editpart"href="<?php echo site_url('company/editpart/').$p->Part_Id?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="deletepartner(id='<?php echo $p->Part_Id ?>')"><i class="fa fa-trash"></i></button>

                                </td>
                                <!-- <td>
                                <form action="<?php echo site_url('Regis/delete') ?>?id=<?php echo $p->Part_Id; ?>" method="POST">
                                    <button type="submit" class="btn btn-danger " name="delete" id="delete" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่ไหม');"><i class="fa fa-trash"></i></button>
                                </form>
                                </td> -->
                                <!-- <td nowrap style="text-align:center; vertical-align: middle;">
                                    <a class="btn btn-outline-success btn-sm" type="submit" href="<?php echo site_url('Welcome/excel1?AutoIDEmp=') . iconv('TIS-620', 'UTF-8', $p->Cus_Id); ?>"><button type="button" class="btn btn-success btn-sm" name="excel1"><i class="fa fa-file-excel-o"></i></button>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <a class="btn btn-outline-danger btn-sm" type="submit" target="_blank" href="<?php echo site_url('Welcome/pdf1?AutoIDEmp=') . iconv('TIS-620', 'UTF-8', $r->Cus_Id); ?>"><button type="button" class="btn btn-danger btn-sm" name="pdf1"><i class="fa fa-file-pdf-o"></i></button>
                                </td> -->

                            <?php } ?>
                            
                </table>
            </div>
        
<script>

    function deletepartner(partid) {
            var datas = "Part_Id=" + partid;
            if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('company/deletepartner') ?>",
            data: datas,
            }).done(function(data) {
            $('#user_data').html(data);
            });
        }
    }

</script>        
    