<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>จำนำ</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>



</head>

<body>
    <?php foreach ($pledge as $p) { ?>
        <form action="<?php echo site_url('pledgecon/contipledge') ?>" method="post">
            <div class="card boder-0 ">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <h2>ใบรับจำนำ</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-3 ">
                            <label>ชื่อพนักงาน :</label>
                            <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $p->Pledge_Emp; ?>" readonly>
                            <input type="hidden" name="pledgeid" id="pledgeid" value="<?php echo $p->Pledge_Id; ?>">
                        </div>
                        <div class="col-3">

                        </div>
                        <div class="col-3">
                            <label>ลูกค้า :</label>
                            <select class="form-control" type="select" name="cust" id="cust">
                                <option value="" disabled selected>กรุณาเลือกลูกค้า</option>
                                <?php foreach ($cus as $c) { ?>
                                    <option value="<?php echo $c->Cus_Id; ?>" <?php if ($p->Pledge_Cus == $c->Cus_Id) {
                                                                                    echo "selected";
                                                                                } ?>>
                                        <?php echo $c->Name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-3">
                            <label>รายละเอียด :</label>
                            <textarea class="form-control" name="det" id="det"><?php echo $p->Pledge_Detail ?>                           
                    </textarea>
                        </div>
                        <div class="col-3">
                        </div>
                        <div class="col-1">
                            <label>น้ำหนัก :</label>
                            <input type="text" class="weight form-control" id="weight" name="weight" value="<?php echo $p->Pledge_Weight; ?>" readonly>
                            
                        </div>
                        <div class="col-2">
                            <label>ยอดจำนำ :</label>
                            <input type="text" class="pledge form-control" id="price" name="price" value="<?php echo $p->Pledge_Price ?>" onkeypress="return numberonly(event)" required oninvalid="this.setCustomValidity(' กรุณากรอกยอดจำนำ')" oninput="setCustomValidity('')">
                            <input type="hidden" id="price1" name="price1" value="0">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-6">
                            <table class="pledge" id="pro">

                                <label>สินค้า :</label><label style="padding-left: 27%;">น้ำหนัก :</label>
                                <?php $i = 1;
                                foreach ($subpledge as $sp) { ?>
                                    <tr id="pro<?php echo $i; ?>">
                                        <td><input class="form-control" type="text" name="pled_pro[]" id="pled_pro" value="<?php echo $sp->Pledge_Pro; ?>" required></td>      
                                        <td><input class="weight_per form-control" id="weight_per" name="weight_per[]" required oninvalid="this.setCustomValidity('กรุณากรอกราคา')" oninput="setCustomValidity('')" value="<?php echo $sp->Pledge_Weight_Per; ?>"></td>
                                        <td><?php if ($i == 1) { ?><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                    <?php } else { ?>
                                        <button type="button" name="remove" id="<?php echo $i; ?>" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true" ></i></button>
                                    <?php } ?>
                                    </tr>
                                <?php
                                    $i++;
                                } ?>
                            </table>
                        </div>

                        <div class="col-2">
                            <label>ค่าดอก :</label>
                            <select class="debt form-control" id="debt" name="debt" required>
                                <option value="" disabled selected>กรุณาเลือกเปอร์เซ็น</option>
                                <option value="2" <?php if ($p->Pledge_Debt == "2") {
                                                        echo "selected";
                                                    } ?>>2 %</option>
                                <option value="3" <?php if ($p->Pledge_Debt == "3") {
                                                        echo "selected";
                                                    } ?>>3 %</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <label>ค่าต่อดอก :</label>
                            <input type="text" class="pay1 form-control" id="pay1" name="pay1" value="<?php echo number_format($p->Pledge_Debt_Price, 2) ?>" readonly>
                            <input type="hidden" class="pay form-control" id="pay" name="pay" value="<?php echo $p->Pledge_Debt_Price ?>">
                            
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-3">
                            <label>วันที่รับจำนำ :</label>
                            <input class="form-control" type="text" name="date" id="date" value="<?php echo $p->Pledge_Sdate ?>" readonly>
                            <input type="hidden"  id="pledgeenddate" name="pledgeenddate" value="<?php echo $p->Pledge_Ndate ?>">
                            <!-- <input type="hidden" name="pledgeid" id="pledgeid" value="<?php echo $p->Pledge_Id; ?>"> -->
                        </div>
                        <div class="col-3">
                            <label>ค่าดอก : *1เดือน=30วัน*</label>
                            <select class="month form-control" id="month" name="month" required>
                                <option value="" disabled selected>กรุณาเลือกจำนวนเดือน</option>
                                <option value="30" <?php if ($p->Pledge_Month == "30") {
                                                        echo "selected";
                                                    } ?>>1</option>
                                <option value="60" <?php if ($p->Pledge_Month == "60") {
                                                        echo "selected";
                                                    } ?>>2</option>
                                <option value="90" <?php if ($p->Pledge_Month == "90") {
                                                        echo "selected";
                                                    } ?>>3</option>
                            </select>
                            
                        </div>
                        <div class="col-2">
                            <label>ยอดไถ่ออก :</label>
                            <input type="text" class="payout1 form-control" id="payout1" name="payout1" value="<?php echo number_format($p->Pledge_Price, 2) ?>" readonly>
                            <input type="hidden" class="payout" id="payout" name="payout" value="<?php echo $p->Pledge_Price ?>">
                        </div>

                    </div>


                </div>
                <div class="row justify-content-center">
                    <div style="margin-bottom: 15px;">

                        <button type="submit" class="btn btn-info">ต่อดอก</button>
                        <a class="btn btn-danger" href="<?php echo site_url('Welcome/order') ?>">ยกเลิก</a>

                    </div>

                </div>
            </div>

            </div>
        </form>
    <?php } ?>
</body>

<script>
    $(document).ready(function() {
        console.log("ready!");
        pledge = parseInt($(' .pledge').val());
        det = parseInt($(' .pay').val());
        result = pledge - det;
        resultcom = result.toLocaleString();
        $(' #price1').val(result);
        $(' .pledge').val(resultcom);
            

    });

    $(document).on('change', '.weight_per', function() {
        id = $(this).parents('tr').attr('id');
        
        weight = parseFloat($('#' + id + ' .weight_per').val());
        if($(this).val()==''){
            $(this).val(0); 
        }
      

        var result = 0;
        var weig = 0;

        $('.weight_per').each(function(){
            result = parseFloat($(this).val());
            weig = weig+result;
        });
            
        
        weigcom = weig.toLocaleString();
        
        

        $(' .weight').val(weig);
    });

    $(document).on('change ', '.month', function() {


        am = parseInt($(this).val());
        day = parseInt($(this).val());
        debt = parseInt($(' #debt').val());
        value = parseInt($(' #price ').val());
        enddate = $(' #pledgeenddate ').val();

        day = (day / 30);

        percent = (value / 100) * debt;


        det = percent * day;
        result = det + value;
        
        // console.log(value);

        
       
        detcom = det.toLocaleString();
        resultcom = result.toLocaleString();


        // console.log(result);

        $(' .payout').val(result);
        $(' .payout1').val(resultcom);
        $(' .pay').val(det);
        $(' .pay1').val(detcom);

        
        date = new Date(enddate);
        date.setDate(date.getDate() + am);
        format = date.toISOString();
        format = format.substr(0, 10);
        console.log(format);
        $(' .endate').val(format);
    });


    $(document).ready(function() {
        // var i = 1;
        
        var d = $('.pledge tr:last-child').attr('id');
        i = d.substr(3);
        // console.log(i);

        $('#add').click(function() {
            i++;
            var pro = '<tr id="pro' + i + '"><td><input class="form-control" type="text"  name="pled_pro[]" id="pled_pro" required></td><td><input class="weight_per form-control" id="weight_per" name="weight_per[]" value="0"  required></td>  <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true" ></i></button></td></tr>'
            $('table').append(pro);
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#pro' + button_id + '').remove();
        });
    });

    function numberonly(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>