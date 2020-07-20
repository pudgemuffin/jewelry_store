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
                                <?php foreach ($editcust as $e){?>
                                    <form action="<?php echo site_url('Regis/updatecust') ?>" method="post">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control py-4" id="cususer" name="cususer" type="text" placeholder="Enter Username" value="<?php echo $e->Cus_User?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control py-4" id="cuspass" name="cuspass" type="password" placeholder="Enter password" value="<?php echo $e->Cus_Pass?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control py-4" id="cusfname" name="cusfname" type="text" placeholder="Enter first name" value="<?php echo $e->Cus_fname ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control py-4" id="cuslname" name="cuslname" type="text" placeholder="Enter last name" value="<?php echo $e->Cus_lname ?>" />
                                        </div>
                                        <div class ="form-group">
                                        <label>เพศ :</label>
                                            <input type="radio" name="cusgender" id="cusgender" value="M"<?php if($e->Cus_Gender == "M"){ echo "checked";}?>> ชาย
                                            <input type="radio" name="cusgender" id="cusgender" value="F"<?php if($e->Cus_Gender =="F"){ echo "checked";}?>> หญิง<br>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control py-4" id="cusemail" name="cusemail" type="email" aria-describedby="emailHelp" placeholder="Enter email address" value="<?php echo $e->Cus_Email ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input class="form-control py-4" id="custel" name="custel" type="text" placeholder="Telephone" value="<?php echo $e->Cus_Tel ?>"/>
                                        </div>
                                        <label>จังหวัด :</label>
                                        <select class="form-control" id="province" name="province" onchange="am()">
                                            <option value="">จังหวัด</option>
                                            <?php foreach ($province as $p) { ?>
                                                <option value="<?php echo $p->PROVINCE_ID; ?>"<?php if($e->Cus_Province == $p->PROVINCE_ID){
                                                    echo "selected";
                                                }?>>
                                                    <?php echo $p->PROVINCE_NAME; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label>เขต :</label>
                                        <select class="form-control" id="amphur" name="amphur" onchange="dis()">
                                            <option value="">เขต</option>
                                            <?php foreach ($amphur as $a) { ?>
                                                <option value="<?php echo $a->AMPHUR_ID; ?>"<?php if($e->Cus_Amphur == $a->AMPHUR_ID){
                                                    echo "selected";
                                                    }?>>
                                                    <?php echo $a->AMPHUR_NAME; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <label>แขวง :</label>
                                        <select class="form-control" id="district" name="district" onchange="posc()">
                                            <option value="">แขวง</option>
                                            <?php foreach ($district as $d) { ?>
                                                <option value="<?php echo $d->DISTRICT_ID; ?>"<?php if($e->Cus_District == $d->DISTRICT_ID){
                                                    echo "selected";
                                                }?>>
                                                    <?php echo $d->DISTRICT_NAME; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <label>รหัสไปรษณีย์ :</label>
                                        <select class="form-control" id="postcode" name="postcode">
                                            <option value="">รหัสไปรษณีย์</option>
                                            <?php foreach ($district as $posc) { ?>
                                                <option value="<?php echo $posc->POSTCODE; ?>"<?php if($e->Cus_Postcode == $posc->POSTCODE){
                                                    echo "selected";
                                                }?>>
                                                    <?php echo $posc->POSTCODE; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <label>ลายละเอียด :</label>
                                        <textarea class="form-control" name="cusaddress" id="cusaddress" >
                                        <?php echo $e->Cus_Address?>
                                        </textarea>
                                        <div class="form-group mt-4 mb-0">
                                                
                                        <button type="submit" class="btn btn-primary btn-block" value="<?php echo $e->Cus_Id;?>" name="Updateacc">Update Account</button>
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