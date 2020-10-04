<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ราคาทุน</title>
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<center>
    <h2>ราคาทุน</h2>
</center>
<?php foreach ($partner as $p) { ?>
    
        <form action="<?php echo site_url('company/existcost') ?>" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>บริษัทคู่ค้า :</label>
                    <input class="form-control" style="color: red;" type=text value="<?php echo $p->Part_Name; ?>" disabled>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <table id="prod">
                        <?php $i = 1; ?>
                        <tr id="newprod<?php echo $i; ?>">
                            <label>สินค้า :</label>
                            <td><select class="form-control" id="prodid[]" name="prodid[]" required oninvalid="this.setCustomValidity('กรุณาเลือกสินค้า')" oninput="setCustomValidity('')">
                                    <option value="">กรุณาเลือกสินค้า</option>
                                    <?php foreach ($productbyid as $pdi) { ?>
                                    <?php foreach ($product as $pr) { ?>
                                        <option value="<?php echo $pr->Prod_Id; ?>" <?php if ($pdi->Prod_Id == $pr->Prod_Id) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                            <?php echo $pr->Prod_Name; ?>
                                        </option>
                                        <?php } ?>
                                </select></td>
                            <td><?php if ($i == 1) { ?><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                <?php } else { ?>
                                    <button type="button" name="remove" id="<?php echo $i; ?>" class="btn btn-danger btn_remove">X</button>
                                <?php } ?></td>
                        </tr>
                    <?php
                                        $i++;
                                    } ?>
                    </table>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-5" style="margin-bottom: 15px;">

                    <button type="submit" class="btn btn-info">เพิ่มข้อมูลราคาทุน</button>
                    <a class="btn btn-danger" href="<?php echo site_url('') ?>">ยกเลิก</a>

                </div>
            </div>

        </form>
    
<?php } ?>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            var prod = '<tr id="newprod' + i + '"><td><select class="form-control" id="prodid[]" name="prodid[]" required "><option value="">กรุณาเลือกสินค้า</option><?php foreach ($product as $pr) { ?><option value="<?php echo $pr->Prod_Id; ?>"><?php echo $pr->Prod_Name; ?></option><?php } ?></select></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(prod);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#newprod' + button_id + '').remove();
        });
    });
</script>