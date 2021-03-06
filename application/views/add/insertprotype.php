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
    <h2>เพิ่มประเภทสินค้า</h2>
</center>

<body>

    <form action="<?php echo site_url('product/addprotype') ?>" method="post">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อประเภท :</label>
                    <input class="form-control" type=text name="ptype" id="ptype" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5">
                <label>หมวดหมู่ :</label>
                    <input type="radio" name="cat" id="cat" value="0" <?php echo "checked"?>> ทั่วไป
                    <input type="radio" name="cat" id="cat" value="1"> แหวน<br>
                </div>
            </div><br>
            <div class="row justify-content-center">
                <div class="col-5">
                    <button type="submit" class="btn btn-info">เพิ่มประเภทสินค้า</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/protype') ?>">ยกเลิก</a>

                </div>
            </div>
            <br>
        </div>
    </form>
</body>