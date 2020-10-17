<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>โปรโมชั่น</title>
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
    <form action="<?php echo site_url('product/insertpromotion') ?>" method="post">
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อโปรโมชั่น :</label>
                    <input class="form-control" type=text name="pmname" id="pmname" required oninvalid="this.setCustomValidity('กรุณากรอกชื่อโปรโมชั่น')" oninput="setCustomValidity('')">
                </div>
            </div>
        </div>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class = "col-2 ">
                <label>วันเริ่มโปรโมชั่น :</label>
                    <input class="form-control" type=date name="sdate" id="sdate">
                </div>
                <div class = "col-3">
                    <label>วันสิ้นสุดโปรโมชั่น :</label>
                    <input class="form-control" type=date name="edate" id="edate">
                </div>
            </div>
        </div>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <table id="promo">
                        <tr>
                            <label>สินค้า :</label>
                            <td><select class="form-control" id="prodid[]" name="prodid[]" required oninvalid="this.setCustomValidity('กรุณาเลือกสินค้า')" oninput="setCustomValidity('')">
                                    <option value="">กรุณาเลือกสินค้า</option>
                                    <?php foreach ($product as $pr) { ?>
                                        <option value="<?php echo $pr->Prod_Id; ?>">
                                            <?php echo $pr->Prod_Name; ?>
                                        </option>
                                    <?php } ?>
                                </select></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
            <div class="col-2">
                    <label>ส่วนลด % :</label>
                    <input class="form-control" type=text name="dis" id="dis" maxlength="3" required onkeypress="return numberonly(event)" oninvalid="this.setCustomValidity('กรุณากรอกส่วนลด')" oninput="setCustomValidity('')">
                </div>
            
            <div class = "col-3">
                <input class="form-control" type="text" hidden>
            </div>
            </div>
        </div>
        <br>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5" style="margin-bottom: 15px;">

                    <button type="submit" class="btn btn-info">เพิ่มข้อมูลโปรโมชั่น</button>
                    <a class="btn btn-danger" href="<?php echo site_url('') ?>">ยกเลิก</a>

                </div>
            </div>
        </div>
    </form>
</body>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            var prod = '<tr id="promo' + i + '"><td><select class="form-control" id="prodid[]" name="prodid[]" required "><option value="">กรุณาเลือกสินค้า</option><?php foreach ($product as $pr) { ?><option value="<?php echo $pr->Prod_Id; ?>"><?php echo $pr->Prod_Name; ?></option><?php } ?></select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(prod);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#promo' + button_id + '').remove();
        });
    });
    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>