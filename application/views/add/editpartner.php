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
    <h2>แก้ไขข้อมูลบริษัท</h2>
</center>

<body>
    <?php foreach ($partner as $p) { ?>
        <form action="<?php echo site_url('company/updatepart') ?>" method="post">
            <?php echo validation_errors(); ?>
            <div style="margin-left: 20px">
                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>รหัสพนักงาน</label>
                        <input class="form-control" style="color: red;" type=text value="<?php echo $p->Part_Id; ?>" disabled>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px">
                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>ชื่อบริษัท</label>
                        <input class="form-control" type=text name="partname" id="partname" value="<?php echo $p->Part_Name; ?>" required>
                    </div>
                </div>               

                <div class="row justify-content-center">
                    <div class="col-5">
                        <label>Email :</label>
                        <input class="form-control" type="email" name="partemail" id="partemail" size="40" value="<?php echo $p->Part_Email; ?>" required>
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
                                        <input class="form-control" type="text" name="part_tel[]" onkeypress="return numberonly(event)" id="part_tel" size="40" maxlength="10" required oninvalid="this.setCustomValidity('กรุณากรอกเบอร์โทรให้ครบ 10 หลัก')" oninput="setCustomValidity('')" value="<?php echo $et->Part_tel; ?>">
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
                        <label>จังหวัด :</label>
                        <select class="form-control" id="province" name="province" onchange="am()">
                            <option value="">จังหวัด</option>
                            <?php foreach ($province as $pr) { ?>
                                <option value="<?php echo $pr->PROVINCE_ID; ?>" <?php if ($p->Part_Province == $pr->PROVINCE_ID) {
                                                                                    echo "selected";
                                                                                } ?>>
                                    <?php echo $pr->PROVINCE_NAME; ?>
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
                                <option value="<?php echo $a->AMPHUR_ID; ?>" <?php if ($p->Part_Amphur == $a->AMPHUR_ID) {
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
                                <option value="<?php echo $d->DISTRICT_ID; ?>" <?php if ($p->Part_District == $d->DISTRICT_ID) {
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
                                <option value="<?php echo $posc->POSTCODE; ?>" <?php if ($p->Part_Postcode == $posc->POSTCODE) {
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
                        <textarea class="form-control" name="partaddress" id="partaddress">
                    <?php echo $p->Part_Address; ?>
                    </textarea>
                    </div>
                </div><br>
                <div class="row justify-content-center">
                    <div class="col-5">

                        <button type="submit" class="btn btn-info" value="<?php echo $p->Part_Id; ?>" name="updatepart">แก้ไขข้อมูลบริษัท</button>
                        <a class="btn btn-danger" href="<?php echo site_url('') ?>">ยกเลิก</a>

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
            var tel = '<tr id="newtel' + i + '"><td><input type="text" name="part_tel[]" onkeypress="return numberonly(event)"  class="form-control" maxlength="10" minlength="10" required ></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(tel);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#newtel' + button_id + '').remove();
        });
    });

    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    function dept() {

        var datas = "depts=" + document.getElementById('depts').value;

        //alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Regis/dept') ?>",
            data: datas,
        }).done(function(data) {
            console.log(data);
            $('#pos').html(data);
        });
    }


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