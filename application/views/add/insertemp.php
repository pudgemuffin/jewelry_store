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
    <h2>Insert</h2>
</center>

<body>

    <form action="<?php echo site_url('Regis/addemp') ?>" method="post">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>รหัสบัตรประชาชน</label>
                    <input class="form-control" type=text name="idcard" id="idcard" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>คำนำหน้าชื่อ : </label>
                    <select class="form-control" name="nametitle" id="nametitle">
                        <option value="1">นาย</option>
                        <option value="2">นางสาว</option>
                        <option value="3">นาง</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อ :</label>
                    <input class="form-control" type="text" name="fname" id="fname" size="40" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>นามสุกล :</label>
                    <input class="form-control" type="text" name="lname" id="lname" size="40" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>เพศ :</label>
                    <input type="radio" name="gender" id="gender" value="M"> ชาย
                    <input type="radio" name="gender" id="gender" value="F"> หญิง<br>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label> ศาสนา:</label>
                    <select class="form-control" name="religion" id="religion">
                        <option value="พุทธ">พุทธ</option>
                        <option value="อิสลาม">อิสลาม</option>
                        <option value="คริสต์">คริสต์</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-5">
                    <label>กรุ๊ปเลือด :</label>
                    <select class="form-control" name="blood" id="blood">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="O">O</option>
                        <option value="AB">AB</option>
                    </select>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ว/ด/ป :</label>
                    <input class="form-control" type="date" name="empdate" id="empdate">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>เบอร์โทร :</label>
                    <input class="form-control" type="text" name="pnum" id="pnum" size="40" maxlength="11" required>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-5">
                    <label>Email :</label>
                    <input class="form-control" type="email" name="email" id="email" size="40" required>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-5">
                    <label>แผนก :</label>
                    <select class="form-control" id="depts" name="depts" onchange="dept()">
                        <option value="">แผนก</option>
                        <?php foreach ($depts as $d) { ?>
                            <option value="<?php echo $d->Dep_Id; ?>">
                                <?php echo $d->dept; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ตำแหน่ง :</label>
                    <select class="form-control" id="pos" name="pos">
                        <option value="">ตำแหน่ง</option>
                        <?php foreach ($pos as $p) { ?>
                            <option value="<?php echo $p->Job_Id; ?>">
                                <?php echo $p->job; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>จังหวัด :</label>
                    <select class="form-control" id="province" name="province" onchange="am()">
                        <option value="">จังหวัด</option>
                        <?php foreach ($province as $p) { ?>
                            <option value="<?php echo $p->PROVINCE_ID; ?>">
                                <?php echo $p->PROVINCE_NAME; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>เขต :</label>
                    <select class="form-control" id="amphur" name="amphur" onchange="dis()">
                        <option value="">เขต</option>
                        <?php foreach ($amphur as $a) { ?>
                            <option value="<?php echo $a->AMPHUR_ID; ?>">
                                <?php echo $a->AMPHUR_NAME; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>แขวง :</label>
                    <select class="form-control" id="district" name="district" onchange="posc()">
                        <option value="">แขวง</option>
                        <?php foreach ($district as $d) { ?>
                            <option value="<?php echo $d->DISTRICT_ID; ?>">
                                <?php echo $d->DISTRICT_NAME; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>รหัสไปรษณีย์ :</label>
                    <select class="form-control" id="postcode" name="postcode">
                        <option value="">รหัสไปรษณีย์</option>
                        <?php foreach ($district as $posc) { ?>
                            <option value="<?php echo $posc->POSTCODE; ?>">
                                <?php echo $posc->POSTCODE; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ลายละเอียด :</label>
                    <textarea class="form-control" name="det" id="det">
                    
                    </textarea>
                </div>
            </div><br>

            <div class="row justify-content-center">
                <div class="col-5">

                    <button type="submit" class="btn btn-info">Insert</button>
                    <a class="btn btn-danger" href="<?php echo site_url('') ?>">Cancel</a>

                </div>
            </div>

        </div>


    </form>

</body>


</html>
<script>
    // $(document).ready(function() {
    //     var elements = document.getElementsByName("idemp");
    //     for (var i = 0; i < elements.length; i++) {
    //         elements[i].oninvalid = function(e) {
    //             e.target.setCustomValidity("");
    //             if (!e.target.validity.valid) {
    //                 e.target.setCustomValidity("กรุณากรอกรหัสพนักงาน");
    //             }
    //         }
    //         elements[i].oninput = function(e) {
    //             e.target.setCustomValidity("");
    //         }
    //     }
    // });

    // $(document).ready(function() {
    //     var elements = document.getElementsByName("code");
    //     for (var i = 0; i < elements.length; i++) {
    //         elements[i].oninvalid = function(e) {
    //             e.target.setCustomValidity("");
    //             if (!e.target.validity.valid) {
    //                 e.target.setCustomValidity("กรุณากรอกรCode");
    //             }
    //         }
    //         elements[i].oninput = function(e) {
    //             e.target.setCustomValidity("");
    //         }
    //     }
    // });

    // $(document).ready(function() {
    //     var elements = document.getElementsByName("nameemp");
    //     for (var i = 0; i < elements.length; i++) {
    //         elements[i].oninvalid = function(e) {
    //             e.target.setCustomValidity("");
    //             if (!e.target.validity.valid) {
    //                 e.target.setCustomValidity("กรุณากรอกชื่อ");
    //             }
    //         }
    //         elements[i].oninput = function(e) {
    //             e.target.setCustomValidity("");
    //         }
    //     }
    // });

    // $(document).ready(function() {
    //     var elements = document.getElementsByName("pass");
    //     for (var i = 0; i < elements.length; i++) {
    //         elements[i].oninvalid = function(e) {
    //             e.target.setCustomValidity("");
    //             if (!e.target.validity.valid) {
    //                 e.target.setCustomValidity("กรุณากรอกรหัสผ่าน");
    //             }
    //         }
    //         elements[i].oninput = function(e) {
    //             e.target.setCustomValidity("");
    //         }
    //     }
    // });

    // $(document).ready(function() {
    //     var elements = document.getElementsByName("tel");
    //     for (var i = 0; i < elements.length; i++) {
    //         elements[i].oninvalid = function(e) {
    //             e.target.setCustomValidity("");
    //             if (!e.target.validity.valid) {
    //                 e.target.setCustomValidity("กรุณากรอกเบอร์โทรศัพท์");
    //             }
    //         }
    //         elements[i].oninput = function(e) {
    //             e.target.setCustomValidity("");
    //         }
    //     }
    // });


    // $(document).ready(function(){
    // 			var elements = document.getElementsByName("level");
    // 			for(var i = 0; i < elements.length; i++){
    // 				elements[i].oninvalid = function(e){
    // 					e.target.setCustomValidity("");
    // 					if(!e.target.validity.valid){
    // 						e.target.setCustomValidity("กรุณากรอกLevel");
    // 					}
    // 				}
    // 				elements[i].oninput = function(e){
    // 					e.target.setCustomValidity("");
    // 				}
    // 			}
    // 		});



    // $(document).ready(function() {
    //     var elements = document.getElementsByName("comcode");
    //     for (var i = 0; i < elements.length; i++) {
    //         elements[i].oninvalid = function(e) {
    //             e.target.setCustomValidity("");
    //             if (!e.target.validity.valid) {
    //                 e.target.setCustomValidity("กรุณากรอกรหัสบริษัท");
    //             }
    //         }
    //         elements[i].oninput = function(e) {
    //             e.target.setCustomValidity("");
    //         }
    //     }
    // });

    // function dept() {

    //     var datas = "depts=" + document.getElementById('depts').value;

    //     //alert(datas);

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Regis/dept') ?>",
    //         data: datas,
    //     }).done(function(data) {
    //         console.log(data);
    //         $('#pos').html(data);
    //     });
    // }


    function am() {
        var datas = "province=" + document.getElementById('province').value;

      //  alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Regis/amphur') ?>",
            data: datas,
        }).done(function(data) {
            console.log(data);
            $('#amphur').html(data);
        });
    }


    function dis() {

        var datas = "amphur=" + document.getElementById('amphur').value;

        //alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Regis/district') ?>",
            data: datas,
        }).done(function(data) {
            console.log(data);
            $('#district').html(data);
        });
    }

    function posc() {

        var datas = "district=" + document.getElementById('district').value;

       // alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Regis/postcode') ?>",
            data: datas,
        }).done(function(data) {
            console.log(data);
            $('#postcode').html(data);
        });
    }


    // $(document).ready(function() {
    //     $('#province').change(function() {

    //         var datas = "province=" + document.getElementById('province').value;

    //         alert(datas);

    //         $.ajax({
    //             type: "POST",
    //             url: "<?php echo site_url('Regis/amphur') ?>",
    //             data: datas,
    //         }).done(function(data) {
    //             console.log(data);
    //             $('#amphur').html(data);
    //         });

    //     })
    // });
</script>