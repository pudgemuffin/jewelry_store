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

<body>
<a class="btn btn-primary" target="_blank" href="<?php echo site_url('Regis/insert');?>">Add Employee</a>
<br>
    <center>
        <div>
            <div class="table-responsive">

                <table id="user_data" border="1" style="background-color: white;" class="table table-striped table  table-hover">
                    <thead>
                   
                        <tr>
                            <th class="tableFixHead">Id</th>
                            <th class="tableFixHead">Idcard</th>
                            <th class="tableFixHead">Nametitle</th>
                            <th class="tableFixHead">Firstname</th>
                            <th class="tableFixHead">Surname </th>
                            <th class="tableFixHead">Gender</th>
                            <th class="tableFixHead">Email</th>
                            <th class="tableFixHead">Religion</th>
                            <th class="tableFixHead">BDate</th>
                            <th class="tableFixHead">Edit</th>
                            <th class="tableFixHead">Delete</th>
                            <!-- <th class="tableFixHead">Excel</th>
                            <th class="tableFixHead">PDF</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($result as $r) { ?>

                            <tr nowrap>
                                <td nowrap> <?php echo $r->Id; ?></td>
                                <td nowrap> <?php echo $r->Idcard; ?></td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Nametitle); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Firstname); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Surname); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Gender); ?></td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Email); ?> </td>
                                <td nowrap> <?php echo iconv('utf-8//ignore', 'utf-8//ignore', $r->Religion); ?> </td>
                                <td nowrap> <?php echo$r->empdate; ?> </td>

                                <td>
                                    <!-- <button type="button" class="btn btn-warning btn-sm " name="edit"data-toggle="modal" data-target="#edit" onclick="edit1(id='<?php echo $r->Id ?>')"><i class="fa fa-user"></i></button> -->
                                    <a class="btn btn-warning" href="<?php echo site_url('Regis/edit/').$r->Id?>"><i class="fa fa-cog"></i></a>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <button type="button" class="btn btn-danger btn-sm " name="delete" onclick="delete1(id='<?php echo $r->Idcard ?>')"><i class="fa fa-trash"></i></button>

                                </td>
                                <!-- <td>
                                <form action="<?php echo site_url('Regis/delete') ?>?id=<?php echo $r->Idcard; ?>" method="POST">
                                    <button type="submit" class="btn btn-danger " name="delete" id="delete" onclick="return confirm('ต้องการลบข้อมูลนี้ใช่ไหม');"><i class="fa fa-trash"></i></button>
                                </form>
                                </td> -->
                                <!-- <td nowrap style="text-align:center; vertical-align: middle;">
                                    <a class="btn btn-outline-success btn-sm" type="submit" href="<?php echo site_url('Welcome/excel1?AutoIDEmp=') . iconv('TIS-620', 'UTF-8', $r->Id); ?>"><button type="button" class="btn btn-success btn-sm" name="excel1"><i class="fa fa-file-excel-o"></i></button>
                                </td>
                                <td nowrap style="text-align:center; vertical-align: middle;">
                                    <a class="btn btn-outline-danger btn-sm" type="submit" target="_blank" href="<?php echo site_url('Welcome/pdf1?AutoIDEmp=') . iconv('TIS-620', 'UTF-8', $r->Id); ?>"><button type="button" class="btn btn-danger btn-sm" name="pdf1"><i class="fa fa-file-pdf-o"></i></button>
                                </td> -->

                            <?php } ?>
                            
                </table>
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
    function delete1(idcard) {
        var datas = "idcard=" + idcard;
        if (confirm("คุณต้องการลบข้อมูลนี้ หรือไม่")){
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