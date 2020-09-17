<style>
body{
    background-color: #f1f1f1;
}
</style>
<center>
    <h2>เพิ่มข้อมูลบริษัทคู่ค้า</h2>
</center>

<body>

    <form action="<?php echo site_url('company/insertpart') ?>" method="post">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อบริษัท</label>
                    <input class="form-control" type=text name="partname" id="partname" required>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-5">
                    <label>Email :</label>
                    <input class="form-control" type="email" name="partemail" id="partemail" size="40" required>
                </div>
            </div>
           
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>เบอร์โทร :</label>
                    <input class="form-control" type="text" name="parttel" id="parttel" size="40" maxlength="11" required>
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
                    <label>รายละเอียด :</label>
                    <textarea class="form-control" name="partaddress" id="partaddress">
                    
                    </textarea>
                </div>
            </div><br>

            <div class="row justify-content-center">
                <div class="col-5" style="margin-bottom: 15px;">

                    <button type="submit" class="btn btn-info">Insert</button>
                    <a class="btn btn-danger" href="<?php echo site_url('company/partner') ?>">Cancel</a>

                </div>
            </div>

        </div>


    </form>

</body>


</html>
<script>
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