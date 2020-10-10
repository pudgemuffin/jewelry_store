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
    <h2>Edit Job</h2>
</center>

<body>
    <?php foreach ($editjob as $e){?>
    <form action="<?php echo site_url('positioncon/updatejob') ?>" method="post">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อตำแหน่ง</label>
                    <input class="form-control" type=text name="posi" id="posi" value = "<?php echo $e->Pos_Name;?>">
                </div>
            </div><br>
            <div class="row justify-content-center">
                <label>ชื่อตำแหน่ง</label>
                <div class="col-2">
                    <div class="checkbox">
                        <input type="hidden" name="box1" id="box1" value="0">
                        <label><input type="checkbox" name="box1" id="box1" value="1">การจัดการข้อมูลพนักงาน</label>      
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box2" id="box2" value="0" >
                        <label><input type="checkbox" name="box2" id="box2" value="1">การจัดการข้อมูลลูกค้า</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box3" id="box3" value="0" >
                        <label><input type="checkbox" name="box3" id="box3" value="1" >การจัดการข้อมูลบริษัทคู่ค้า</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box4" id="box4" value="0" >
                        <label><input type="checkbox" name="box4" id="box4" value="1" >การจัดการข้อมูลตำแหน่ง</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box5" id="box5" value="0" >
                        <label><input type="checkbox" name="box5" id="box5" value="1" >การจัดการข้อมูลสินค้า</label>
                    </div>
                    
                </div>
                <div class="col-3">
                    <div class="checkbox">
                        <input type="hidden" name="box6" id="box6" value="0" >
                        <label><input type="checkbox" name="box6" id="box6" value="1">การจำนำ</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box7" id="box7" value="0" >
                        <label><input type="checkbox" name="box7" id="box7" value="1">การขายสินค้า</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box8" id="box8" value="0" >
                        <label><input type="checkbox" name="box8" id="box8" value="1" >การสั่งซื้อสินค้า</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box9" id="box9" value="0" >
                        <label><input type="checkbox" name="box9" id="box9" value="1" >การออกรายงาน</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box10" id="box10" value="0" >
                        <label><input type="checkbox" name="box10" id="box10" value="1" >ทั้งหมด</label>
                    </div>
                </div>
            </div><br>
            <div class="row justify-content-center">
                <div class="col-5">

                    <button type="submit" class="btn btn-info" name="updatejob" value="<?php echo $e->Pos_Id;?>">แก้ไขตำแหน่ง</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/viewposition') ?>">ยกเลิก</a>

                </div>
            </div>
        </div>
    </form>
    <?php } ?>
</body>
