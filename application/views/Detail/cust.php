<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Report</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>



    <!-- 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css"> -->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <th class="tableFixHead">รหัสลูกค้า</th>
                            <th class="tableFixHead">ชื่อ</th>
                            <th class="tableFixHead">นามสุกล</th>
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
                        <?php foreach ($result as $r) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Id); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_fname); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_lname); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Gender); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Email); ?></td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Cus_Address); ?> </td>

                                <td>
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php echo $r->Cus_Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" href="<?php echo site_url('Regis/editcust/').$r->Cus_Id?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="deletecust(id='<?php echo $r->Cus_Id ?>')"><i class="fa fa-trash"></i></button>

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
                            
                </table>
            </div>
        
<script>

function deletecust(cusid) {
        var datas = "Cus_Id=" + cusid;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Regis/deletecust') ?>",
            data: datas,
        }).done(function(data) {
            $('#user_data').html(data);
        });
    }
    }

</script>        
    