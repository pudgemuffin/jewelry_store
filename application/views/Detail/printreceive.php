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
        <h2>ใบรับสินค้า</h2>
    </center>
    <?php foreach ($viewreceive as $v) { ?>
        <table style="width: 100%; border: 10px;">
            <thead>

            </thead>
            <tbody>
                <tr>
                    <td>
                        เลขที่ใบรับสินค้า :<?php echo $v->Rec_Id; ?>
                    </td>
                    <td>
                        ชื่อพนักงาน : <?php echo $v->Firstname; ?>
                    </td>
                    <td>
                        วันที่รับสินค้า : <?php echo $v->Rec_Date; ?>
                    </td>


                </tr>
            </tbody>

        </table>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>รหัสใบรับสินค้า</th>
                    <th>รหัสใบสั่งซื้อสินค้า</th>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewsubreceive as $sb) { ?>
                    <tr>
                        <td class="middle"><?php echo $sb->Rec_Id; ?></td>
                        <td class="middle"><?php echo $sb->Ord_Id; ?></td>
                        <td class="middle"><?php echo $sb->Prod_Name; ?></td>

                        <td class="middle"><?php echo $sb->Amount; ?></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>


    <?php } ?>
</body>

</html>