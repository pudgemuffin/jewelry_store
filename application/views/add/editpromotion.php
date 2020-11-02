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
<?php foreach($editprom as $ep){?>
    <form action="<?php echo site_url('product/updateprom') ?>" method="post">
    
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อโปรโมชั่น :</label>
                    <input type="text" name="pmid" id="pmid" value="<?php echo $ep->Promotion_Id; ?>"hidden>
                    <input class="form-control" type=text name="pmname" id="pmname" required value="<?php echo $ep->Prom_Name; ?>" oninvalid="this.setCustomValidity('กรุณากรอกชื่อโปรโมชั่น')" oninput="setCustomValidity('')">
                </div>
            </div>
        </div>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class = "col-2 ">
                <label>วันเริ่มโปรโมชั่น :</label>
                    <input class="form-control" type=date name="sdate" id="sdate" value="<?php echo $ep->Prom_Sdate; ?>">
                </div>
                <div class = "col-3">
                    <label>วันสิ้นสุดโปรโมชั่น :</label>
                    <input class="form-control" type=date name="edate" id="edate" value="<?php echo $ep->Prom_Ndate; ?>">
                </div>
            </div>
        </div>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <table id="promo">
                        
                            <label>สินค้า :</label>
                            <?php $i = 1; ?>
                            <?php foreach($subprom as $sp){ ?>
                            <tr id="newprom<?php echo $i; ?>">
                            <td><select class="form-control" id="prodid[]" name="prodid[]" required oninvalid="this.setCustomValidity('กรุณาเลือกสินค้า')" oninput="setCustomValidity('')">
                                    <option value="">กรุณาเลือกสินค้า</option>
                                    <?php foreach ($product as $pr) { ?>
                                        <option value="<?php echo $pr->Prod_Id; ?>"<?php if ($sp->Prod_Id == $pr->Prod_Id) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                            <?php echo $pr->Prod_Name; ?>
                                        </option>
                                    <?php } ?>
                                </select></td>
                            <td><?php if ($i == 1) { ?><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                <?php } else { ?>
                                    <button type="button" name="remove" id="<?php echo $i; ?>" class="btn btn-danger btn_remove">X</button>
                                <?php } ?></td>
                        </tr>
                    <?php
                                        $i++;
                                    } ?>
                    </table>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
            <div class="col-2">
                    <label>ส่วนลด % :</label>
                    <input class="form-control" type=text name="dis" id="dis" maxlength="3" required value="<?php echo $ep->Prom_Discount; ?>" onkeypress="return numberonly(event)" oninvalid="this.setCustomValidity('กรุณากรอกส่วนลด')" oninput="setCustomValidity('')">
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

                    <button type="submit" class="btn btn-warning">แก้ไขข้อมูลโปรโมชั่น</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/promotion') ?>">ยกเลิก</a>

                </div>
            </div>
        </div>
                                    
    </form>
    <?php } ?>
</body>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            var promo = '<tr id="newprom' + i + '"><td><select class="form-control" id="prodid[]" name="prodid[]" required "><option value="">กรุณาเลือกสินค้า</option><?php foreach ($product as $pr) { ?><option value="<?php echo $pr->Prod_Id; ?>"><?php echo $pr->Prod_Name; ?></option><?php } ?></select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(promo);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#newprom' + button_id + '').remove();
        });
    });
    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>