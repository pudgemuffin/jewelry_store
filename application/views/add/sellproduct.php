<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ขายสินค้า</title>

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
    <form action="<?php echo site_url('sell/sellpro') ?>" method="post">
        <div class="card boder-0 ">
            <div class="card-body">
                <div style="margin-left: 20px">
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <label>ชื่อพนักงาน :</label>
                            <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $fname; ?>" readonly>
                            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="col-4">
                            <label>วันที่สั่งซื้อสินค้า :</label>
                            <input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <label>ลูกค้า :</label>
                            <select class="form-control" type="select" name="cust" id="cust" required>
                                <option value="" disabled selected>กรุณาเลือกลูกค้า</option>
                                <?php foreach ($customer as $c) { ?>
                                    <option value="<?php echo $c->Cus_Id; ?>">
                                        <?php echo $c->Name; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-4">
                            <label>หมวดหมู่ :</label>
                            <select class="form-control" type="select" name="type" id="type">
                                <option value="0">หมวดหมู่</option>
                                <option value="1">
                                    ทองคำทั่วไป
                                </option>
                                <option value="2">
                                    ทองคำหลุดจำนำ
                                </option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="card boder-0 ">
            <div class="card-body col-12">
                <div class="col-2">
                    <label> ราคากลาง :</label>
                    <?php foreach ($world as $w) { ?>
                        <input class="form-control" type="text" value="<?php echo number_format($w->World_Price, 2)  ?>" readonly>
                        <input class="world form-control" type="text" value="<?php echo $w->World_Price  ?>" hidden>
                    <?php } ?>
                </div>
                <div class="table-responsive">
                    <table class="display table table-bordered" id="product" style="width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="align-middle" style="text-align: center;">รูป</th>
                                <th class="align-middle" style="text-align: center;" nowrap>ล็อตสินค้า</th>
                                <th class="align-middle" style="text-align: center;">ชื่อสินค้า</th>
                                <th class="align-middle" style="text-align: center;">น้ำหนัก</th>
                                <th class="align-middle" style="text-align: center;">กำเหน็จ</th>
                                <th class="align-middle" style="text-align: center;">ไซส์</th>
                                <th class="align-middle" style="text-align: center;">จำนวน</th>
                                <th class="align-middle" style="text-align: center;">ราคาต่อหน่วย</th>
                                <th class="align-middle" style="text-align: center;">ส่วนลด %</th>
                                <th class="align-middle" style="text-align: center;">รวม</th>
                                <th class="align-middle" style="text-align: center;">ลบ</th>
                            </tr>
                        </thead>
                        <tbody class="shows">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="8"></th>
                                <th>
                                    ราคารวม
                                </th>
                                <th>
                                    <input class="alltotal1 form-control" type="text" readonly>
                                    <input type="hidden" class="alltotal form-control" type="text" id="alltotal" name="alltotal">
                                </th>
                                <th></th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button type="button" id="add" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" disabled>เพิ่มสินค้า</button>
                    </div>
                    <div class="col-8"></div>
                    <div class="col-2">
                        <input type="radio" id="payt" name="payt" value="cash">
                        <label for="cash">เงินสด</label>
                        <input type="radio" id="payt" name="payt" value="credit">
                        <label for="credit">เครดิต</label>
                    </div>
                </div>
            </div>

        </div>
        <br>

        <!-- <div style="margin-left: 20px"> -->
        <div class="row justify-content-center">
            <div style="margin-bottom: 15px;">

                <button type="submit" class="btn btn-info">เพิ่มข้อมูลการขาย</button>
                <a class="btn btn-danger" href="<?php echo site_url('Welcome/order') ?>">ยกเลิก</a>

            </div>
        </div>

    </form>
</body>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">สินค้า</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="ajax">
                <table id="aaaa" class=" display table table-bordered fetchtable">
                    <thead>
                        <tr>
                            <th>รูป</th>
                            <th>ประเภทสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>น้ำหนัก</th>
                            <th>กำเหน็จ</th>
                            <th>ไซส์</th>
                            <th>เพิ่ม</th>
                        </tr>
                    </thead>
                    <tbody class="show_part">

                    </tbody>
                </table>
            </div>
            <!-- Modal footer
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>



<script>
    // document.getElementById('datePicker').valueAsDate = new Date();

    // setInterval(ajaxCall, 300000);

    $("#type").change(function() {

        type = $(this).val()
        if (type == 0) {
            $('#add').prop("disabled", true);
        } else {
            $('#add').prop("disabled", false);
            // console.log(type);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('sell/ajaxsell') ?>",
                data: {
                    type: type
                },
                success: function(data) {
                    // alert(data);
                    $('#ajax').html(data);
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

                    // $('.shows').html('');
                }
            })
        }


    })




    $(document).on('click', '.prodid', function() {
        prodid = $(this).val()
        prodids = prodid.substr(0, 9);
        lotid = prodid.substr(9);
        var idTr = $('.shows tr:last-child').attr('id');
        // alert(prodids);
        // alert(lotid);
        // alert(partner);

        if (idTr == null) {
            var rowsd = 1;
        } else {
            idTr = idTr.substr(5);
            var rowsd = parseInt(idTr) + 1;
        }

        var count_body = $('#product tbody tr').length;
        if (count_body == 0) {
            add();
        } else {
            var repeat = false;
            $('#product tbody tr').each(function() {
                sellpro = $(this).find('input[name="idproduct[]"]').val();
                lotpro = $(this).find('input[name = "Lotid[]"]').val();
                // console.log(sellpro);
                // console.log(lotpro);
                if (sellpro == prodids && lotpro == lotid) {
                    repeat = true;
                    return false;
                }
                /* else if (orderpro != prodids) {
                                   return;
                               } */
            });

            if (repeat == false) {
                add();
            }
        }

        function add() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('sell/addpro') ?>",
                data: {
                    prod: prodids,
                    lot: lotid,
                    row: rowsd
                },
                success: function(data) {
                    $('.shows').append(data);
                    // console.log(data);
                    // alert(datas);
                }
            });
        }


    });

    $(document).on('click', '.prodidexp', function() {
        prodid = $(this).val()
        // console.log(prodid);
        var idTr = $('.shows tr:last-child').attr('id');

        if (idTr == null) {
            var rowsd = 1;
        } else {
            idTr = idTr.substr(5);
            var rowsd = parseInt(idTr) + 1;
        }
        var count_body = $('#product tbody tr').length;
        if (count_body == 0) {
            addexp();
        } else {
            var repeat = false;
            $('#product tbody tr').each(function() {
                sellpro = $(this).find('input[name="Expid[]"]').val();


                if (sellpro == prodid) {
                    repeat = true;
                    return false;
                }

            });

            if (repeat == false) {
                addexp();
            }
        }

        function addexp() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('sell/addproexp') ?>",
                data: {
                    prod: prodid,
                    row: rowsd
                },
                success: function(data) {
                    $('.shows').append(data);



                    // alert(datas);
                }
            });
        }


    });


    $(document).on('change ', '.sellinput', function() {


        id = $(this).parents('tr').attr('id');
        total = 0;
        test = $('#' + id + ' .hello ').val();
        testsub = test.substr(0, 3);
        value = parseFloat($('#' + id + ' .sellinput ').val());
        fee = parseFloat($('#' + id + ' .Fee').val());
        world = parseFloat($(' .world ').val());
        weight = parseFloat($('#' + id + ' .weight').val());
        discount = parseFloat($('#' + id + ' .discount').val());
        pergram = (world * 0.0656);

        total1 = 0;
        totalcom = 0;
        totalcom1 = 0;
        priced = 0;
        // console.log(testsub);
        if (testsub == "LOT") {
            amount = parseInt($('#' + id + ' .amount').val());
            left = amount - value;
            $('#' + id + ' .left').val(left);
            percent = (world * weight * discount) / 100;
            price = world * weight;


            if (percent == null) {

                total = ((world * weight) * value) + (fee * value);
            } else {
                total = (((world * weight) - percent) * value) + (fee * value);
            }


            totalcom = total
            totalcom = totalcom.toLocaleString();
            priced = price
            priced = priced.toLocaleString();

            $('#' + id + ' .price').val(price);
            $('#' + id + ' .priced').val(priced);
            $('#' + id + ' .sellTotal').val(total);
            $('#' + id + ' .sellTotal1').val(totalcom);

        } else {
            result = (weight * pergram) * 1
            result = parseInt(result)
            result1 = result.toLocaleString();

            $('#' + id + ' .priceple').val(result);
            $('#' + id + ' .sellTotal').val(result);
            $('#' + id + ' .sellTotal1').val(result1);
            $('#' + id + ' .pricedple').val(result1);
        }




        $(' .sellTotal').each(function() {
            total1 += parseFloat($(this).val());

        });
        totalcom1 = total1
        totalcom1 = totalcom1.toLocaleString();

        $(' .alltotal').val(total1);
        $(' .alltotal1').val(totalcom1);



    });


    $(document).on('click', '.remove', function() {
        $(this).parent().parent().remove();

    });

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





    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>