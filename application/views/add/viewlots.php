<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ล็อต</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>



</head>

<body>
    <form action="<?php echo site_url('ordercon/ordinsert') ?>" method="post">
        <?php foreach ($viewlots as $v) { ?>
            <div class="card boder-0 ">
                <div class="card-body">
                    <div style="margin-left: 20px">
                        <div class="row justify-content-center">
                            <div class="col-3 ">
                                <label>เลขที่ล็อต :</label>
                                <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $v->Lot_Id; ?>" readonly>
                            </div>
                            <div class="col-3">
                                <label>วันที่รับล็อต :</label>
                                <input class="form-control" type="text" name="date" id="date" value="<?php echo $v->Lot_Date; ?>" readonly>
                            </div>
                            <div class="col-3">
                                <label>ราคารวม :</label>
                                <input class="form-control" type="text" name="part" id="part" value="<?php echo $v->Lot_Cost; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="card boder-0 ">
                <div class="card-body col-12">
                    <div class="table-responsive">
                        <table class="display table table-bordered" id="product" style="width: 100%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="align-middle" style="text-align: center;">เลขที่ใบรับ</th>
                                    <th class="align-middle" style="text-align: center;">สินค้า</th>
                                    <th class="align-middle" style="text-align: center;">จำนวน</th>
                                    <th class="align-middle" style="text-align: center;">ราคา</th>
                                    <th class="align-middle" style="text-align: center;">รวม</th>
                                </tr>
                            </thead>
                            <?php foreach ($viewsublots as $sl) { ?>
                                <tbody class="shows">

                                    <td class="align-middle" style="text-align: center;"><?php echo $sl->Rec_Id; ?></td>
                                    <td class="align-middle" style="text-align: center;"><?php echo $sl->Prod_Name; ?></td>
                                    <td><input class="price form-control" type="text" value="<?php echo $sl->Amount; ?>" readonly></td>
                                    <td><input class="orderinput form-control" type="number" value="<?php echo number_format($sl->Price_Per,2); ?>" readonly></td>

                                    <td><input class="orderTotal form-control" id="total" name="total" value="<?php echo number_format($sl->All_per,2); ?>" readonly></td>

                                </tbody>
                            <?php } ?>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <th>
                                        ราคารวม
                                    </th>
                                    <th>
                                        <input class="alltotal form-control" type="text" name="alltotal" id="alltotal" value="<?php echo number_format($v->Lot_Cost,2); ?>" readonly>
                                    </th>
                                    <Th></Th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>
            <br>

            <!-- <div style="margin-left: 20px"> -->
            <div class="row justify-content-center">
                <div style="margin-bottom: 15px;">

                    <!-- <button type="submit" class="btn btn-info">เพิ่มข้อมูลการสั่งซื้อ</button> -->
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/lots') ?>">ยกเลิก</a>

                </div>
            </div>
        <?php } ?>
    </form>
</body>





