<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>โปรโมชั่น</title>

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
        <div class="card boder-0 ">
            <div class="card-body">
                <div style="margin-left: 20px">
                    <div class="row justify-content-center">
                        <div class="col-3 ">
                            <label>ชื่อพนักงาน :</label>
                            <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $fname; ?>" readonly>
                            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="col-3">
                            <label>วันที่สั่งซื้อสินค้า :</label>
                            <input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </div>
                        <div class="col-3">
                            <label>บริษัทคู่ค้า :</label>
                            <select class="form-control" type="select" name="partner" id="partner">
                                <option value="">บริษัท</option>
                                <?php foreach ($partner as $p) { ?>
                                    <option value="<?php echo $p->Part_Id; ?>">
                                        <?php echo $p->Part_Name; ?>
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
                                <th class="align-middle" style="text-align: center;">ราคา</th>
                                <th class="align-middle" style="text-align: center;">จำนวน</th>
                                <th class="align-middle" style="text-align: center;">รวม</th>
                                <th class="align-middle" style="text-align: center;">ลบ</th>
                            </tr>
                        </thead>
                        <tbody class="shows">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    <input class="alltotal form-control" type="text" name="alltotal" id="alltotal" readonly>
                                </th>
                                <Th></Th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">เพิ่มสินค้า</button>
            </div>

        </div>
        <br>

        <!-- <div style="margin-left: 20px"> -->
        <div class="row justify-content-center">
            <div style="margin-bottom: 15px;">

                <button type="submit" class="btn btn-info">เพิ่มข้อมูลการสั่งซื้อ</button>
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
                            <th>ชื่อบริษัท</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาทุน</th>
                            <th>ไซส์</th>
                            <th>เพิ่มสินค้า</th>
                        </tr>
                    </thead>
                    <tbody class="show_part">
                        <?php foreach ($result as $r) { ?>

                            <tr>
                                <td><?php echo $r->Part_Name;  ?></td>
                                <td><?php echo $r->Prod_Name;  ?></td>
                                <td><?php echo $r->Cost_Price;  ?></td>
                                <td><?php echo $r->Size;  ?></td>
                                <td><button type="button" class="prodid" id="prodid" name="prodid" value="<?php echo $r->Prod_Id . "" . $r->Part_Id; ?>">เพิ่ม</button></td>
                            </tr>
                        <?php } ?>
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
    


    $("#partner").change(function() {
        partner = $(this).val()

        console.log(partner);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ordercon/ajxpart') ?>",
            data: {
                part: partner
            },
            success: function(data) {
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
    })



    $(document).on('click', '.prodid', function() {
        prodid = $(this).val()
        prodids = prodid.substr(0, 9);
        partner = prodid.substr(9);
        var idTr = $('.shows tr:last-child').attr('id');
        // alert(idTr);

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
                orderpro = $(this).find('input[name="idproduct[]"]').val();

                if (orderpro == prodids) {
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
                url: "<?php echo site_url('ordercon/partnerord') ?>",
                data: {
                    hello: prodids,
                    part: partner,
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


    $(document).on('change ', '.orderinput', function() {
        id = $(this).parents('tr').attr('id');
        total = 0;
        value = parseFloat($('#' + id + ' .orderinput ').val());
        price = parseFloat($('#' + id + ' .price').val());
        total1 = 0;


        total = value * price;


        $('#' + id + ' .orderTotal').val(total);


        $(' .orderTotal').each(function() {
            total1 += parseFloat($(this).val());
        });
        $('#alltotal').val(total1);
        // $('#lotTotal').val(total1);
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