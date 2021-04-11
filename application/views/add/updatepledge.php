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
    <form action="<?php echo site_url('pledgecon/insertpledge') ?>" method="post">
        <div class="card boder-0 ">
            <div class="card-body">
                <div class="row justify-content-center">
                    <h2>ใบรับจำนำ</h2>
                </div>
                <div class="row justify-content-center">
                    <div class="col-3 ">
                        <label>ชื่อพนักงาน :</label>
                        <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $fname; ?>" readonly>
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    </div>
                    <div class="col-3">

                    </div>
                    <div class="col-3">
                        <label>ลูกค้า :</label>
                        <select class="form-control" type="select" name="cust" id="cust">
                            <option value="" disabled selected>กรุณาเลือกลูกค้า</option>
                            <?php foreach ($cus as $c) { ?>
                                <option value="<?php echo $c->Cus_Id; ?>">
                                    <?php echo $c->Name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-3">
                        <label>รายละเอียด :</label>
                        <textarea class="form-control" name="det" id="det">
                    </textarea>
                    </div>
                    <div class="col-3">
                    </div>
                    <div class="col-1">
                        <label>น้ำหนัก :</label>
                        <input type="text" class="form-control" id="weight" name="weight[]">
                    </div>
                    <div class="col-2">
                        <label>ยอดจำนำ :</label>
                        <input type="text" class="pledge form-control" id="price" name="price[]" onkeypress="return numberonly(event)" required oninvalid="this.setCustomValidity(' กรุณากรอกยอดจำนำ')" oninput="setCustomValidity('')">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-6">
                        <table id="pro">
                            <tr>
                                <label>สินค้า :</label>
                                <td><input class="form-control" type="text" name="pled_pro[]" id="pled_pro" required></td>
                                <label style="padding-left: 27%;">น้ำหนัก :</label>
                                <td><input class="form-control" id="weight_per" name="weight_per[]" required oninvalid="this.setCustomValidity('กรุณากรอกราคา')" oninput="setCustomValidity('')"></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-2">
                        <label>ค่าดอก :</label>
                        <select class="debt form-control" id="debt" name="debt" required>
                            <option value="" disabled selected>กรุณาเลือกเปอร์เซ็น</option>
                            <option value="2">2 %</option>
                            <option value="3">3 %</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label>ค่าต่อดอก :</label>
                        <input type="text" class="pay1 form-control" id="pay1" name="pay1" readonly>
                        <input type="hidden" class="pay form-control" id="pay" name="pay">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-3">
                        <label>วันที่รับจำนำ :</label>
                        <input class="form-control" type="text" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="col-3">
                        <label>ค่าดอก : *1เดือน=30วัน*</label>
                        <select class="month form-control" id="month" name="month" required>
                            <option value="" disabled selected>กรุณาเลือกจำนวนเดือน</option>
                            <option value="30">1</option>
                            <option value="60">2</option>
                            <option value="90">3</option>
                        </select>
                        <input type="hidden" class="endate" id="endate" name="endate">
                    </div>
                    <div class="col-2">
                        <label>ยอดไถ่ออก :</label>
                        <input type="text" class="payout1 form-control" id="payout1" name="payout1" readonly>
                        <input type="hidden" class="payout" id="payout" name="payout">
                    </div>

                </div>


            </div>
            <div class="row justify-content-center">
                <div style="margin-bottom: 15px;">

                    <button type="submit" class="btn btn-info">เพิ่มข้อมูลการสั่งซื้อ</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/order') ?>">ยกเลิก</a>

                </div>

            </div>
        </div>

        </div>
    </form>
</body>

<script>
    $(document).on('change ', '.month', function() {


        am = parseInt($(this).val());
        day = parseInt($(this).val());
        debt = parseInt($(' #debt').val());
        value = parseInt($(' #price ').val());

        day = (day / 30);

        percent = (value / 100) * debt;

        det = percent * day;
        result = percent + value;

        detcom = det.toLocaleString();
        resultcom = result.toLocaleString();


        console.log(result);

        $(' .payout').val(result);
        $(' .payout1').val(resultcom);
        $(' .pay').val(det);
        $(' .pay1').val(detcom);

        result = new Date();
        result.setDate(result.getDate() + am);
        format = result.toISOString();
        format = format.substr(0, 10);
        $(' .endate').val(format);
    });
</script>