<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>รับสินค้า</title>

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
    <form action="<?php echo site_url('ordercon/receive') ?>" method="post">
        <div class="card boder-0 ">
            <div class="card-body">
            <div class="row justify-content-center">
                <h2>ใบรับสินค้า</h2>
            </div>
                <div style="margin-left: 20px">
                    <div class="row justify-content-center">
                        <div class="col-3 ">
                            <label>ชื่อพนักงาน :</label>
                            <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $fname; ?>" readonly>
                            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="col-3">
                            <label>วันที่รับสินค้า :</label>
                            <input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </div>
                        <div class="col-3">
                            <label>ใบสั่งซื้อสินค้า :</label>
                            <select class="form-control" type="select" name="ord" id="ord">
                                <option value="">ใบสั่งซื้อสินค้า</option>
                                <?php foreach ($order as $o) { ?>
                                    <option value="<?php echo $o->Ord_Id; ?>">
                                        <?php echo $o->Ord_Id; ?>
                                    </option>
                                <?php } ?>
                            </select>
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
                                <th class="align-middle" style="text-align: center;">ชื่อบริษัท</th>
                                <th class="align-middle" style="text-align: center;">สินค้า</th>
                                <th class="align-middle" style="text-align: center;">จำนวนสั่งซื้อ</th>
                                <th class="align-middle" style="text-align: center;">จำนวนรับ</th>
                                <th class="align-middle" style="text-align: center;">เหลือ</th>
                                <th class="align-middle" style="text-align: center;">ราคารวม</th>
                                <th class="align-middle" style="text-align: center;">ลบ</th>
                            </tr>
                        </thead>
                        <tbody class="shows" id="ajax">
                                
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th colspan="4"></th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    <input class="alltotal form-control" type="text" name="alltotal" id="alltotal" readonly>
                                </th>
                                <Th></Th>

                            </tr>
                        </tfoot> -->
                    </table>
                </div>
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">เพิ่มสินค้า</button> -->
            </div>

        </div>
        <br>

        <!-- <div style="margin-left: 20px"> -->
        <div class="row justify-content-center">
            <div style="margin-bottom: 15px;">

                <button type="submit" class="btn btn-info">เพิ่มข้อมูลการรับสินค้า</button>
                <a class="btn btn-danger" href="<?php echo site_url('Welcome/order') ?>">ยกเลิก</a>

            </div>
        </div>

    </form>
</body>



<script>
    // document.getElementById('datePicker').valueAsDate = new Date();
    


    $("#ord").change(function() {
        ord = $(this).val()

        console.log(ord);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ordercon/ajaxreceive') ?>",
            data: {
                ord: ord
            },
            success: function(data) {
                $('#ajax').html(data);
                console.log(data)
            }
                
        })
    })



   

    $(document).on('change ', '.recinput', function() {
        id = $(this).parents('tr').attr('id');
        total = 0;
        value = parseFloat($('#' + id + ' .recinput ').val());
        remain = parseFloat($('#' + id + ' .remaining ').val());
        price = parseFloat($('#' + id + ' .price').val());
        total1 = 0;

        remain = remain - value;
        total = value * price;


        $('#' + id + ' .orderTotal').val(total);
        $('#' + id + ' .remain').val(remain);


        $(' .orderTotal').each(function() {
            total1 += parseFloat($(this).val());
        });
        $('.alltotal').val(total1);
        // $('#lotTotal').val(total1);
    });


    $(document).on('click', '.remove', function() {
        $(this).parent().parent().remove();

    });

    





    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>