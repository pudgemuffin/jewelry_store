<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {


            font-family: "THSarabun";


            font-size: 20px;

            align-content: center;
            text-align: center;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .middle {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="row justify-content-center">
        <!-- <img src="<?php echo base_url('img/TONGDEEee.png') ?>" style="height: 55px; width:80px;" class=""> -->
    </div>

    <?php foreach ($pledge as $h) { ?>
        <h3>ร้านห้างทองทองดีเยาวราช</h3>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        ชื่อพนักงาน : <?php echo $h->Firstname; ?>
                    </td>
                    <td colspan="12"></td>
                    <td colspan="5" nowrap>
                        ชื่อลูกค้า :<?php echo $h->Cus_fname; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        วันที่ต่อดอกรอบถัดไป : <?php echo $h->Pledge_Ndate; ?>
                    </td>
                    <td>
                        จำนวนเดือน <?php echo ($h->Pledge_Month)/30; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        เลขที่ใบจำนำ : <?php echo $h->Pledge_Id ?>
                    </td>
                </tr>

            </tbody>
        </table>
       


        <hr>
        <table style="width: 100%;">
        <tr>
                <td class="right" style="width: 66%;">ค่าดอกเบี้ย</td>
                <td class="right">
                    <?php   echo number_format($h->Pledge_Debt_Price,2)?>
                    </td>
            </tr>
            <tr>
                <td class="right" style="width: 66%;">ราคาไถ่ :</td>
                <td class="right">
                    <?php echo number_format($h->Pledge_Price, 2) ?>
                </td>
            </tr>
           
           
        </table>
    <?php } ?>
</body>

</html>