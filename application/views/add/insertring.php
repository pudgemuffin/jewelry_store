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

<body>

    <center>
        <h2 style="margin-top: 5px;">เพิ่มข้อมูลสินค้า</h2><Br>
    </center>
    <form action="<?php echo site_url('product/insertring') ?>" method="post" enctype="multipart/form-data">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <img id="preimage" width="150px" height="150px">
                    <label>รูปภาพสินค้า</label>
                    <input type="file" name="prodim" id="prodim" accept="image/*" onchange="loadimg(event)" required oninvalid="this.setCustomValidity('กรุณาเลือกรูป')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ประเภทสินค้า :</label>
                    <select class="form-control" name="prodtype" id="prodtype" required oninvalid="this.setCustomValidity('กรุณาเลือกประเภท')" oninput="setCustomValidity('')">
                        <option value="" disabled selected>ประเภท</option>
                        <?php foreach ($protype as $pt) { ?>
                            <option value="<?php echo $pt->Prot_Id; ?>">
                                <?php echo $pt->Prot_Name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อสินค้า :</label>
                    <input class="form-control" type=text name="prodname" id="prodname" required oninvalid="this.setCustomValidity('กรุณากรอกชื่อสินค้า')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>หน่วยน้ำหนัก : </label>
                    <select class="form-control" name="prodweight" id="prodweight" onchange="weight()">
                        <option value="" disabled selected>หน่วย</option>
                        <?php foreach ($weight as $w) { ?>
                            <option value="<?php echo $w->Weight_Id; ?>">
                                <?php echo $w->Weight_Name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-3">
                    <label>น้ำหนักสินค้า : กรัม</label>
                    <input class="form-control" type=text name="prodgram" id="prodgram" readonly>
                </div>
                <div class = "col-2">
                <label>ขนาดแหวน : </label>
                    <select class="form-control" name="size" id="size">
                        <option value="" disabled selected>โปรดเลือกขนาด</option>
                        <?php foreach ($size as $s) { ?>
                            <option value="<?php echo $s->Id; ?>">
                                <?php echo $s->Size; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                
            </div>
            <div class="row justify-content-center">
            <div class="col-5">
                    <label>ค่ากำเหน็จ :</label>
                    <input class="form-control" type=text name="fee" id="fee" required onkeypress="return numberonly(event)" oninvalid="this.setCustomValidity('กรุณาใส่กำเหน็จ')" oninput="setCustomValidity('')">
                </div>
                </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-5" style="margin-bottom: 15px;">

                    <button type="submit"  class="btn btn-info">เพิ่มข้อมูลสินค้า</button>
                    <a class="btn btn-danger"  href="<?php echo site_url('') ?>">ยกเลิก</a>

                </div>
            </div>
           
            
</body>

<script>



    // $(document).ready(function(){
        
    //     $("#prodtype").change(function () {
    //         var type = document.getElementById('prodtype').value;
    //         var name = $('#'+type).hasClass();
           
    //         // var type =  this.options[this.selectedIndex];
    //         // var type = $(this).parents().attr("id");
    //         console.log(name);
    //         if (name == 'แหวน') {
    //             $("#size").prop("disabled",false);
    //         } else {
    //             $("#size").prop("disabled", true);
    //             $("#size").append("<p style = 'color:red'>เฉพาะแหวน</p>")
    //         }
    //     });
    // }); 
 

    function weight() {
        var datas = "prodweight=" + document.getElementById('prodweight').value;

        //  alert(datas);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('product/grams') ?>",
            data: datas,
        }).done(function(data) {
            console.log(data);
            $('#prodgram').val(data);
        });
    }

    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    function loadimg(event) {
        var output = document.getElementById('preimage');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>