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
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">เพิ่มข้อมูลลูกค้า</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo site_url('customercon/cusregis') ?>" method="post">
                                        <div class="form-group">
                                            <label>ชื่อ :</label>
                                            <input class="form-control py-4" id="cusfname" name="cusfname" type="text" required="" oninvalid="this.setCustomValidity('กรุณากรอกชื่อ')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group">
                                            <label>นามสกุล :</label>
                                            <input class="form-control py-4" id="cuslname" name="cuslname" type="text" required="" oninvalid="this.setCustomValidity('กรุณากรอกนามสกุล')" oninput="setCustomValidity('')" />
                                        </div>
                                        <div class="form-group">
                                            <label>เพศ :</label>
                                            <input type="radio" name="cusgender" id="cusgender" value="ชาย" <?php echo "checked" ?>> ชาย
                                            <input type="radio" name="cusgender" id="cusgender" value="หญิง"> หญิง<br>
                                        </div>

                                        <div class="form-group">
                                            <label>ว/ด/ป เกิด :</label>
                                            <input class="form-control py-4" type="date" name="cusbdate" id="cusbdate" required oninvalid="this.setCustomValidity('กรุณาใส่ ว/ด/ป เกิด')" oninput="setCustomValidity('')">
                                        </div>


                                        <div class="form-group">
                                            <label>อีเมล :</label>
                                            <input class="form-control py-4" id="cusemail" name="cusemail" type="email" aria-describedby="emailHelp" required oninvalid="this.setCustomValidity('กรุณากรอกอีเมลให้ถูกต้อง')" oninput="setCustomValidity('')" />
                                        </div>
                                        <div class="form-group">
                                            <table id="tel">
                                                <tr>
                                                    <label>เบอร์โทร :</label>
                                                    <td><input class="form-control" type="text" name="cus_tel[]" id="cus_tel" size="40" minlength="10" maxlength="10" onkeypress="return numberonly(event)" required oninvalid="this.setCustomValidity('กรุณากรอกเบอร์โทรให้ครบ 10 หลัก')" oninput="setCustomValidity('')"></td>
                                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                </tr>
                                            </table>
                                            <label>จังหวัด :</label>
                                            <select class="form-control" id="province" name="province" onchange="am()">
                                                <option value="">จังหวัด</option>
                                                <?php foreach ($province as $p) { ?>
                                                    <option value="<?php echo $p->PROVINCE_ID; ?>">
                                                        <?php echo $p->PROVINCE_NAME; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <label>เขต :</label>
                                            <select class="form-control" id="amphur" name="amphur" onchange="dis()">
                                                <option value="">เขต</option>
                                                <?php foreach ($amphur as $a) { ?>
                                                    <option value="<?php echo $a->AMPHUR_ID; ?>">
                                                        <?php echo $a->AMPHUR_NAME; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <label>แขวง :</label>
                                            <select class="form-control" id="district" name="district" onchange="posc()">
                                                <option value="">แขวง</option>
                                                <?php foreach ($district as $d) { ?>
                                                    <option value="<?php echo $d->DISTRICT_ID; ?>">
                                                        <?php echo $d->DISTRICT_NAME; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                            <label>รหัสไปรษณีย์ :</label>
                                            <select class="form-control" id="postcode" name="postcode">
                                                <option value="">รหัสไปรษณีย์</option>
                                                <?php foreach ($district as $posc) { ?>
                                                    <option value="<?php echo $posc->POSTCODE; ?>">
                                                        <?php echo $posc->POSTCODE; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                            <label>รายละเอียด :</label>
                                            <textarea class="form-control" name="cusaddress" id="cusaddress">
                                        </textarea>
                                            <br>
                                            <div class="row justify-content-center">
                                                <div class="col-5" style="margin-bottom: 15px;">

                                                    <button type="submit" class="btn btn-info">เพิ่มข้อมูลลูกค้า</button>
                                                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/viewcust') ?>">ยกเลิก</a>

                                                </div>
                                            </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

</body>

</html>

<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            var tel = '<tr id="newtel' + i + '"><td><input type="text" name="cus_tel[]"  class="form-control" onkeypress="return numberonly(event)" maxlength="10" minlength="10" required/></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
            $('table').append(tel);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#newtel' + button_id + '').remove();
        });

        $(function() {
            $("input[name='cus_tel[]']").on('input', function(e) {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        });
    });

    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
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
</script>