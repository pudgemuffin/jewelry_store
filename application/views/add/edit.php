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
    <h2>Edit</h2>
</center>

<body>

    <?php foreach ($edit as $r) { ?>

        <form action="<?php echo site_url('Regis/update') ?>" method="post">


            <div style="margin-left: 20px">
                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>รหัสบัตรประชาชน</label>
                        <input class="form-control" type=text name="idcard" id="idcard" value="<?php echo $r->Idcard; ?>">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>คำนำหน้าชื่อ : </label>
                        <select class="form-control" name="nametitle" id="nametitle">
                            <option value="<?php echo $r->Nametitle ?>" selected><?php echo $r->Nametitle ?></option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="นาง">นาง</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>ชื่อ :</label>
                        <input class="form-control" type="text" name="fname" id="fname" size="40" value="<?php echo $r->Firstname; ?>">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>นามสุกล :</label>
                        <input class="form-control" type="text" name="lname" id="lname" size="40" value="<?php echo $r->Surname; ?>">
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>เพศ :</label>
                        <input type="radio" name="gender" id="gender" value="M" <?php if ($r->Gender == "ชาย") {
                                                                                    echo "checked";
                                                                                } ?>> ชาย
                        <input type="radio" name="gender" id="gender" value="F" <?php if ($r->Gender == "หญิง") {
                                                                                    echo "checked";
                                                                                } ?>> หญิง<br>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label> ศาสนา:</label>
                        <select class="form-control" name="religion" id="religion">
                            <option value="พุทธ" <?php if ($r->Religion == "พุทธ") {
                                                        echo "selected";
                                                    } ?>>พุทธ</option>
                            <option value="อิสลาม" <?php if ($r->Religion == "อิสลาม") {
                                                        echo "selected";
                                                    } ?>>อิสลาม</option>
                            <option value="คริสต์" <?php if ($r->Religion == "คริสต์") {
                                                        echo "selected";
                                                    } ?>>คริสต์</option>
                            <option value="อื่นๆ" <?php if ($r->Religion == "อื่นๆ") {
                                                        echo "selected";
                                                    } ?>>อื่นๆ</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>กรุ๊ปเลือด :</label>
                        <select class="form-control" name="blood" id="blood">
                            <option value="A" <?php if ($r->Blood == "A") {
                                                    echo "selected";
                                                } ?>>A</option>
                            <option value="B" <?php if ($r->Blood == "B") {
                                                    echo "selected";
                                                } ?>>B</option>
                            <option value="O" <?php if ($r->Blood == "O") {
                                                    echo "selected";
                                                } ?>>O</option>
                            <option value="AB" <?php if ($r->Blood == "AB") {
                                                    echo "selected";
                                                } ?>>AB</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>ว/ด/ป เกิด:</label>
                        <input class="form-control" type="date" name="empdate" id="empdate" value="<?php echo $r->empdate; ?>">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>Email :</label>
                        <input class="form-control" type="email" name="email" id="email" size="40" value="<?php echo $r->Email; ?>" required>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <table id="tel">
                            <?php
                            $i = 1;
                            foreach ($edittel as $et) { ?>
                                <tr id="newtel<?php echo $i; ?>">
                                    <label>เบอร์โทร :</label>
                                    <td>
                                        <input class="form-control" type="text" name="emp_tel[]" id="emp_tel" size="40" maxlength="11" value="<?php echo $et->emp_tel; ?>">
                                    </td>
                                    <td>
                                        <?php if ($i == 1) { ?><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        <?php } else { ?>
                                            <button type="button" name="remove" id="<?php echo $i; ?>" class="btn btn-danger btn_remove">X</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            } ?>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>ว/ด/ป เริ่มทำงาน:</label>
                        <input class="form-control" type="date" name="empsdate" id="empsdate" value="<?php echo $r->Startdate ?>">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>สถานะการทำงาน:</label>
                        <input type="radio" name="status" id="status" value="1" <?php if ($r->Status == "1") {
                                                                                    echo "checked";
                                                                                } ?>> ทำงาน
                        <input type="radio" name="status" id="status" value="0" <?php if ($r->Status == "0") {
                                                                                    echo "checked";
                                                                                } ?>> ลาออก<br>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>เงินเดือน :</label>
                        <input class="form-control" type="text" name="salary" id="salary" value="<?php echo $r->Salary ?>">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>ตำแหน่ง :</label>
                        <select class="form-control" id="pos" name="pos">
                            <option value="">ตำแหน่ง</option>
                            <?php foreach ($position as $p) { ?>
                                <option value="<?php echo $p->Job_Id; ?>" <?php if ($r->Jobs == $p->Job_Id) {
                                                                                echo "selected";
                                                                            } ?>>
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
                                <option value="<?php echo $p->PROVINCE_ID; ?>" <?php if ($r->Provinces == $p->PROVINCE_ID) {
                                                                                    echo "selected";
                                                                                } ?>>
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
                                <option value="<?php echo $a->AMPHUR_ID; ?>" <?php if ($r->Countys == $a->AMPHUR_ID) {
                                                                                    echo "selected";
                                                                                } ?>>
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
                                <option value="<?php echo $d->DISTRICT_ID; ?>" <?php if ($r->Districts == $d->DISTRICT_ID) {
                                                                                    echo "selected";
                                                                                } ?>>
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
                                <option value="<?php echo $posc->POSTCODE; ?>" <?php if ($r->Postcodes == $posc->POSTCODE) {
                                                                                    echo "selected";
                                                                                } ?>>
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
                    <?php echo $r->Address; ?>
                    </textarea>
                    </div>
                </div><br>


                <div class="row justify-content-center">
                    <div class="col-5">

                        <button type="submit" class="btn btn-info" value="<?php echo $r->Id; ?>" name="updateId">Update</button>
                        <a class="btn btn-danger" href="<?php echo site_url('') ?>">Cancel</a>

                    </div>
                </div>
            </div>
        </form>
    <?php } ?>
</body>

</html>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            var tel = '<tr id="newtel' + i + '"><td><input type="text" name="emp_tel[]"  class="form-control" maxlength="10" minlength="10"/></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(tel);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#newtel' + button_id + '').remove();
        });
        $(function(){
          $("input[name='emp_tel[]']").on('input',function(e){
              $(this).val($(this).val().replace(/[^0-9]/g,''));
          });
      });
    });
    // $('.btn-remove').on('click',function(){
    //     var button_id = $(this).attr("id");
    //     $('#newtel' + button_id).remove();
    // });
</script>