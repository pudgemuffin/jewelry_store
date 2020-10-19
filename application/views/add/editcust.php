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
                                    <h3 class="text-center font-weight-light my-4">Edit Account</h3>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($editcust as $e) { ?>
                                        <form action="<?php echo site_url('customercon/updatecust') ?>" method="post">
                                            <div class="form-group">
                                                <label>ชื่อ :</label>
                                                <input class="form-control py-4" id="cusfname" name="cusfname" type="text" placeholder="Enter first name" value="<?php echo $e->Cus_fname ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>นามสกุล :</label>
                                                <input class="form-control py-4" id="cuslname" name="cuslname" type="text" placeholder="Enter last name" value="<?php echo $e->Cus_lname ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>เพศ :</label>
                                                <input type="radio" name="cusgender" id="cusgender" value="ชาย" <?php if ($e->Cus_Gender == "ชาย") {
                                                                                                                    echo "checked";
                                                                                                                } ?>> ชาย
                                                <input type="radio" name="cusgender" id="cusgender" value="หญิง" <?php if ($e->Cus_Gender == "หญิง") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>> หญิง<br>
                                            </div>
                                            <div class="form-group">
                                                <label>อีเมล :</label>
                                                <input class="form-control py-4" id="cusemail" name="cusemail" type="email" aria-describedby="emailHelp" placeholder="Enter email address" value="<?php echo $e->Cus_Email ?>" />
                                            </div>
                                            <div class="form-group">
                                                <table id="tel">
                                                    <label>เบอร์โทร :</label>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($edittel as $et) { ?>
                                                        <tr id="newtel<?php echo $i; ?>">

                                                            <td>
                                                                <input class="form-control" type="text" name="cus_tel[]" onkeypress="return numberonly(event)" id="cus_tel" maxlength="11" value="<?php echo $et->cus_tel; ?>">
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
                                            <label>จังหวัด :</label>
                                            <select class="form-control" id="province" name="province" onchange="am()">
                                                <option value="">จังหวัด</option>
                                                <?php foreach ($province as $p) { ?>
                                                    <option value="<?php echo $p->PROVINCE_ID; ?>" <?php if ($e->Cus_Province == $p->PROVINCE_ID) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                        <?php echo $p->PROVINCE_NAME; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <label>เขต :</label>
                                            <select class="form-control" id="amphur" name="amphur" onchange="dis()">
                                                <option value="">เขต</option>
                                                <?php foreach ($amphur as $a) { ?>
                                                    <option value="<?php echo $a->AMPHUR_ID; ?>" <?php if ($e->Cus_Amphur == $a->AMPHUR_ID) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                        <?php echo $a->AMPHUR_NAME; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <label>แขวง :</label>
                                            <select class="form-control" id="district" name="district" onchange="posc()">
                                                <option value="">แขวง</option>
                                                <?php foreach ($district as $d) { ?>
                                                    <option value="<?php echo $d->DISTRICT_ID; ?>" <?php if ($e->Cus_District == $d->DISTRICT_ID) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                        <?php echo $d->DISTRICT_NAME; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                            <label>รหัสไปรษณีย์ :</label>
                                            <select class="form-control" id="postcode" name="postcode">
                                                <option value="">รหัสไปรษณีย์</option>
                                                <?php foreach ($district as $posc) { ?>
                                                    <option value="<?php echo $posc->POSTCODE; ?>" <?php if ($e->Cus_Postcode == $posc->POSTCODE) {
                                                                                                        echo "selected";
                                                                                                    } ?>>
                                                        <?php echo $posc->POSTCODE; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

                                            <label>รายละเอียด :</label>
                                            <textarea class="form-control" name="cusaddress" id="cusaddress">
                                        <?php echo $e->Cus_Address ?>
                                        </textarea>
                                        <br>
                                            <div class="row justify-content-center">
                                                <div class="col-5" style="margin-bottom: 15px;">

                                                    <button type="submit" class="btn btn-warning">แก้ไขข้อมูลลูกค้า</button>
                                                    <a class="btn btn-danger" href="<?php echo site_url('') ?>">ยกเลิก</a>

                                                </div>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
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
            var tel = '<tr id="newtel' + i + '"><td><input type="text" name="cus_tel[]" onkeypress="return numberonly(event)" class="form-control" maxlength="10" minlength="10"/></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>'
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