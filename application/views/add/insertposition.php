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
    <h2>เพิ่มตำแหน่ง</h2>
</center>

<body>

    <form action="<?php echo site_url('positioncon/addposi') ?>" method="POST">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อตำแหน่ง</label>
                    <input class="form-control" type=text name="posi" id="posi" required oninvalid="this.setCustomValidity('กรุณากรอกชื่อตำแหน่ง')" oninput="setCustomValidity('')"> 
                    <!-- <div class = "error"></div> -->
                </div>
            </div><br>
            <div class="row justify-content-center">
                <label>ชื่อตำแหน่ง</label>
                <div class="col-2">
                    <div class="checkbox">
                        <input type="hidden" name="box1" id="box1" value="0">
                        <label><input type="checkbox" name="box1" id="box1" value="1" >การจัดการข้อมูลพนักงาน</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box2" id="box2" value="0" >
                        <label><input type="checkbox" name="box2" id="box2" value="1" >การจัดการข้อมูลลูกค้า</label>
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
                        <label><input type="checkbox" name="box6" id="box6" value="1" >การจัดการข้อมูลประเภทสินค้า</label>
                    </div>
                <div class="checkbox">
                <input type="hidden" name="box7" id="box7" value="0" >
                        <label><input type="checkbox" name="box7" id="box7" value="1" >การจัดการราคาทุน</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box8" id="box8" value="0" >
                        <label><input type="checkbox" name="box8" id="box8" value="1" >การจำนำ</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box9" id="box9" value="0" >
                        <label><input type="checkbox" name="box9" id="box9" value="1" >การขายสินค้า</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box10" id="box10" value="0" >
                        <label><input type="checkbox" name="box10" id="box10" value="1" >การสั่งซื้อสินค้า</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="box11" id="box11" value="0" >
                        <label><input type="checkbox" name="box11" id="box11" value="1" >การออกรายงาน</label>
                    </div>
                    
                </div>
            </div><br>

            <div class="row justify-content-center">
                <div class="col-5">

                    <button type="submit" id="insert" class="btn btn-info">เพิ่มตำแหน่ง</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/viewposition') ?>">ยกเลิก</a>

                </div>
            </div>
            <br>
        </div>
    </form>
</body>
<script>
// $(document).ready(function() {
//   $('#insert').click(function() {
//     if (!$('#posi').val()) {
//       $('.error').css('color','red');
//       $('.error').html('ไอ้สัสแตม');
//       return false;
//     }
//   })
// });

$('#box10').click(function() {
    var checked = $(this).is(':checked');
    console.log(checked);
    if (checked == true) {
        $('#box1').prop('checked', true);
        alert("1"); 
       

    } else {
        $('#box1').attr('checked', false);
        $('#box2').attr('checked', false);
        $('#box3').attr('checked', false);
        $('#box4').attr('checked', false);
        $('#box5').attr('checked', false);
        $('#box6').attr('checked', false);
        $('#box7').attr('checked', false);
        $('#box8').attr('checked', false);
        $('#box9').attr('checked', false);
    }
});
</script>