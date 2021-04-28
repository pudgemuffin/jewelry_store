<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {


            font-family: "THSarabun";


            font-size: 21px;

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

        table {
            border: 1px;
            border-color: black;
        }
    </style>
</head>

<body>
    <center>
        <h2>ใบสั่งซื้อสินค้า</h2>
    </center>
    <?php foreach ($vieworder as $v) { ?>
        <table style="width: 100%;">
            <thead>
               
            </thead>
            <tbody>
            <tr>
                    <td>
                        เลขที่ใบสั่งซื้อ :<?php echo $v->Ord_Id; ?>
                    </td>
                    <td>
                        ชื่อพนักงาน : <?php echo $v->Firstname; ?>
                    </td>
                    <td>
                        วันที่สั่งซื้อสินค้า : <?php echo $v->Ord_Date; ?>
                    </td>

                    <td>
                        บริษัทคู่ค้า : <?php echo $v->Part_Name ?>
                    </td>
                </tr>
            </tbody>

        </table>
        <table style="width: 100%;">
            <thead>
                <tr>
                <th>ชื่อบริษัท</th>
                <th>สินค้า</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suborder as $sb) { ?>
                    <tr>

                        <td class="middle"><?php echo $v->Part_Name; ?></td>
                        <td class="middle"><?php echo $sb->Prod_Name; ?></td>
                        <td class="middle"><?php echo number_format($sb->Priceper, 2) ?></td>
                        <td class="middle"><?php echo $sb->Piece; ?></td>

                        <td class="middle"><?php echo number_format($sb->Total_per, 2) ?></td>

                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="3"></th>
                    <th>
                        ราคารวม
                    </th>
                    <th>
                        <?php echo number_format($v->Ord_Price, 2); ?>
                    </th>
                </tr>
            </tbody>

        </table>


    <?php } ?>
</body>

</html>