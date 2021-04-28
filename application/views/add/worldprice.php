<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ราคากลาง</title>
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<center>
    <h2>แก้ไขราคากลาง</h2>
</center>

<body>

    <form action="<?php echo site_url('sell/updateworldprice') ?>" method="post">


        <div class="row justify-content-center">
            <?php foreach ($world as $w) { ?>
                <?php if ($w->Id == 1) { ?>
                    <div class="col-5">
                        <label>ราคาขายออก :</label>
                        <input class="form-control" type=text name="sell" id="sell" value="<?php echo $w->World_Price; ?>" onkeypress="return numberonly(event)" required>
                    </div>
        </div>

    <?php } else { ?>

        <div class="row justify-content-center">
            <div class="col-5">
                <label>ราคารับซื้อ :</label>
                <input class="form-control" type=text name="buy" id="buy" value="<?php echo $w->World_Price; ?>" onkeypress="return numberonly(event)" required>
            </div>
        </div>

    <?php } ?>
    <br>
<?php } ?>
<div class="row justify-content-center">
    <div class="col-5">
        <button type="submit" class="btn btn-info">แก้ไขข้อมูลราคากลาง</button>
        <a class="btn btn-danger" href="<?php echo site_url('Welcome/protype') ?>">ยกเลิก</a>

    </div>
</div>
<br>
    </form>
</body>
<script>
    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>