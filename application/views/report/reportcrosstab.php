<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>รายงานยอดขายสินค้า</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
</head>

<body>
<br>
    <form action="<?php echo site_url('callreport/inputdate') ?>" method="post">
        <div class="row justify-content-center">
            <div class="col-3">
                วันเริ่มต้น : <input class="form-control" type="date" id="dates" name="dates">
            </div>
            <div class="col-3">
                วันสิ้นสุด : <input class="form-control" type="date" id="daten" name="daten">
            </div>
            <button type="submit" class="btn btn-info">ค้นหา</button>
        </div>


    </form>
    <br>
    <div class="row">

        <div class="col">
            <div id="piechart"></div>
            <div class="card boder-0 ">
                <table id="aaaa" class="table table-bordered table-striped">
                    <thead>
                        <th>
                            สินค้า
                        </th>
                        <th>
                            จำนวนชิ้น
                        </th>


                    </thead>
                    <tbody>
                        <?php foreach ($cross as $cr) { ?>
                            <tr>
                                <td><?php echo $cr->Prod_Name; ?> </td>
                                <td><?php echo $cr->Jan; ?></td>
                                <td><?php echo $cr->Feb; ?></td>
                                <td><?php echo $cr->Mar; ?></td>
                                <td><?php echo $cr->Apr; ?></td>
                                <td><?php echo $cr->May; ?></td>
                                <td><?php echo $cr->Jun; ?></td>
                                <td><?php echo $cr->Jul; ?></td>
                                <td><?php echo $cr->Aug; ?></td>
                                <td><?php echo $cr->Sep; ?></td>
                                <td><?php echo $cr->Oct; ?></td>
                                <td><?php echo $cr->Nov; ?></td>
                                <td><?php echo $cr->Dec; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>

<script>

    $(document).ready(function() {
        $('#aaaa').DataTable({
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, "All Data"]
            ],
            language: {
                "emptyTable": "ไม่พบข้อมูลสินค้า"
            }
        });
    });

</script>