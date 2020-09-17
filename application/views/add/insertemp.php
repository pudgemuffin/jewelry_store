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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
</head>
<!-- <style>
body{
    background-color: #f1f1f1;
}
</style> -->

<center>
    <h2 style="margin-top: 5px;">เพิ่มข้อมูลพนักงาน</h2><Br>
</center>


<body>
    <form action="<?php echo site_url('Regis/addemp') ?>" method="post" enctype="multipart/form-data">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                <img id = "preimage" width="150px" height="150px">
                    <label>รูปภาพพนักงาน</label>
                    <input type="file" name="empim" id="empim"accept="image/*" onchange="loadimg(event)" required oninvalid="this.setCustomValidity('กรุณาเลือกรูป')" oninput="setCustomValidity('')">
                    
                </div>
                
            </div>

            <Br>
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>รหัสบัตรประชาชน :</label>
                    <input class="form-control" type=text name="idcard" id="idcard" maxlength="13" minlength="13" onkeypress="return numberonly(event)" required oninvalid="this.setCustomValidity('กรุณากรอกให้ครบ13หลัก')" oninput="setCustomValidity('')">
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-5">
                    <label>คำนำหน้าชื่อ : </label>
                    <select class="form-control" name="nametitle" id="nametitle">
                        <option value="นาย">นาย</option>
                        <option value="นางสาว">นางสาว</option>
                        <option value="นาง">นาง</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อ :</label>
                    <input class="form-control" type="text" name="fname" id="fname" size="40" required oninvalid="this.setCustomValidity('กรุณากรอกชื่อ')" oninput="setCustomValidity('')">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>นามสุกล :</label>
                    <input class="form-control" type="text" name="lname" id="lname" size="40" required oninvalid="this.setCustomValidity('กรุณากรอกนามสุกล')" oninput="setCustomValidity('')">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>เพศ :</label>
                    <input type="radio" name="gender" id="gender" value="ชาย" <?php echo "checked"?>> ชาย
                    <input type="radio" name="gender" id="gender" value="หญิง"> หญิง<br>
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
                    <label>สัญชาติ :</label>
                    <input class="form-control" type="text" name="national" id="national" required oninvalid="this.setCustomValidity('กรุณากรอกสัญชาติ')" oninput="setCustomValidity('')">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ว/ด/ป เกิด:</label>
                    <input class="form-control" type="date" name="empdate" id="empdate" required oninvalid="this.setCustomValidity('กรุณาใส่ ว/ด/ป เกิด')" oninput="setCustomValidity('')">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>Email :</label>
                    <input class="form-control" type="email" name="email" id="email" size="40" required oninvalid="this.setCustomValidity('กรุณากรอกอีเมลให้ถูกต้อง')" oninput="setCustomValidity('')">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <table id="tel">
                        <tr>
                            <label>เบอร์โทร :</label>
                            <td><input class="form-control" type="text"  name="emp_tel[]" id="emp_tel" minlength="10" maxlength="10" onkeypress="return numberonly(event)" required oninvalid="this.setCustomValidity('กรุณากรอกเบอร์โทรให้ครบ 10 หลัก')" oninput="setCustomValidity('')"></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ว/ด/ป เริ่มทำงาน:</label>
                    <input class="form-control" type="date" name="empsdate" id="empsdate" required oninvalid="this.setCustomValidity('กรุณาใส่วันเข้าทำงาน')" oninput="setCustomValidity('')">
                </div>
            </div>
                    
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>เงินเดือน :</label>
                    <input class="form-control" type="text" name="salary" id="salary">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ตำแหน่ง :</label>
                    <select class="form-control" id="pos" name="pos" required oninvalid="this.setCustomValidity('กรุณาเลือกตำแหน่ง')" oninput="setCustomValidity('')">
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
                    <select class="form-control" id="province" name="province" onchange="am()" required oninvalid="this.setCustomValidity('กรุณาเลือกจังหวัด')" oninput="setCustomValidity('')">
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
                    <select class="form-control" id="amphur" name="amphur" onchange="dis()" required oninvalid="this.setCustomValidity('กรุณาเลือก เขต/อำเภอ')" oninput="setCustomValidity('')">
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
                    <select class="form-control" id="district" name="district" onchange="posc()" required oninvalid="this.setCustomValidity('กรุณาเลือก แขวง/ตำบล')" oninput="setCustomValidity('')">
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
                    <select class="form-control" id="postcode" name="postcode"required oninvalid="this.setCustomValidity('กรุณาใส่รหัสไปรษณีย์')" oninput="setCustomValidity('')">
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
                    <label>รายละเอียด :</label>
                    <textarea class="form-control" name="det" id="det">

                    </textarea>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-5" style="margin-bottom: 15px;">

                    <button type="submit"  class="btn btn-info">เพิ่มข้อมูลพนักงาน</button>
                    <a class="btn btn-danger"  href="<?php echo site_url('') ?>">ยกเลิก</a>

                </div>
            </div>

        </div>


    </form>
    </body>

    

</html>
<script>
    empdate.max = new Date().toISOString().split("T")[0];
    empsdate.max = new Date().toISOString().split("T")[0];

 

    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            var tel = '<tr id="newtel' + i + '"><td><input type="text" name="emp_tel[]" onkeypress="return numberonly(event)"  class="form-control" maxlength="10" minlength="10" required ></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(tel);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#newtel' + button_id + '').remove();
        });
    });

    function numberonly(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
    function loadimg(event){
        var output = document.getElementById('preimage');
        output.src = URL.createObjectURL(event.target.files[0]);
    }


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