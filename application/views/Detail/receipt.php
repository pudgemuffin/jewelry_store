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

    <?php foreach ($head as $h) { ?>
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
                        วันที่ : <?php echo substr($h->Receipt_Date, 0, 10); ?>
                    </td>
                    <td>
                        <?php echo substr($h->Receipt_Date, 10); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        เลขที่ใบเสร็จ : <?php echo $h->Receipt_Id ?>
                    </td>
                </tr>

            </tbody>
        </table>
        <hr>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th class="left">สินค้า</th>

                    <th>จำนวน</th>

                    <th>ราคารวม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($receipt as $rp) { ?>

                    <tr>
                        <td>
                            <?php echo $rp->Prod_Name ?>
                            <?php echo $rp->ProdPL_Name ?>
                        </td>

                        <td class="middle">
                            <?php echo $rp->Receipt_Amount ?>
                        </td>

                        <td class="right">
                            <?php echo number_format($rp->Receipt_Price_Total, 2) ?>
                        </td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>


        <hr>
        <table style="width: 100%;">
            <tr>
                <td class="right" style="width: 66%;">ราคารวม :</td>
                <td class="right">
                    <?php echo number_format($h->Receipt_Total, 2) ?>
                </td>
            </tr>
            <tr>
                <td class="right" style="width: 66%;">Vat(7%)</td>
                <td class="right">
                    <?php $cal =  (($h->Receipt_Total)/100)*7;
                           echo number_format($cal,2)  ?>
                    </td>
            </tr>
            <tr>
                <td class="right" style="width: 66%;">ราคาสุทธิ : </td>
                <td class="right">
                    <?php $result = ($h->Receipt_Total) + $cal;
                    echo number_format($result,2) ?>
                </td>
            </tr>
        </table>
    <?php } ?>
</body>

</html>