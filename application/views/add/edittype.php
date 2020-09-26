<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<center>
    <h2>แก้ไขประเภทสินค้า</h2>
</center>

<body>

    <form action="<?php echo site_url('product/updatetype') ?>" method="post">
        <?php echo validation_errors(); ?>
        <?php foreach($edittype as $et){ ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อประเภท :</label>
                    <input class="form-control" type=text name="ptype" id="ptype" value="<?php echo $et->Prot_Name; ?>" required >
                </div>
            </div><br>
            <div class="row justify-content-center">
                <div class="col-5">

                    <button type="submit" class="btn btn-info" value="<?php echo $et->Prot_Id; ?>" name="updatetype">แก้ไขประเภทสินค้า</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/protype') ?>">ยกเลิก</a>

                </div>
            </div>
        </div>
        <?php } ?>
    </form>
</body>