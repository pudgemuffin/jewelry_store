
<div class="card boder-0 ">
    <div class="card-body">
        <div style="margin-left: 20px">
        <h1>ประวัติการขาย</h1>
            <div class="row justify-content-center">
                <div class="col-4">
                    <?php foreach ($receipt as $r) { ?>
                        <label>ชื่อพนักงาน :</label>
                        <input class="form-control" type="text" name="emp" id="emp" value="<?php echo $r->Firstname; ?>" readonly>

                </div>
                <div class="col-4">
                    <label>วันที่ขายสินค้า :</label>
                    <input class="form-control" type="text" name="date" id="date" value="<?php echo $r->Receipt_Date; ?>" readonly>
                </div>



                <div class="col-4">
                    <label>ลูกค้า :</label>
                    <input class="form-control" type="text" name="cus" id="cus" value="<?php echo $r->Cus_fname; ?>" readonly>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                    <label>ประเภทการชำระ :</label>
                    <input class="form-control" type="text" name="total" id="total" value="<?php if ($r->Receipt_Payment == "cash") {
                                                                                                echo "เงินสด";
                                                                                            } else {
                                                                                                echo "เครดิต";
                                                                                            } ?>" readonly>
                </div>
                <div class="col-4">
                    <label>ยอดขายรวม :</label>
                    <input class="form-control" type="text" name="total" id="total" value="<?php echo number_format($r->Receipt_Total, 2); ?>" readonly>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
<div class="card boder-0 ">
    <div class="card-body">
        <div class="row justify-content-center">
        <h3>สินค้าทั่วไป</h3>
            <table class="display table table-bordered" id="product" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle" style="text-align: center;">ชื่อสินค้า</th>
                        <th class="align-middle" style="text-align: center;">จำนวน</th>
                        <th class="align-middle" style="text-align: center;">ราคาต่อหน่วย</th>
                        <th class="align-middle" style="text-align: center;">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($count_pro > 0) { ?>
                        <?php foreach ($subreceiptpro as $spro) { ?>
                            <tr>
                                <td class="align-middle" style="text-align: center;"><?php echo $spro->Prod_Name; ?></td>
                                <td class="align-middle" style="text-align: center;"><?php echo $spro->Receipt_Amount; ?></td>
                                <td class="align-middle" style="text-align: center;"><?php echo number_format($spro->Receipt_Price_Per,2); ?></td>
                                <td class="align-middle" style="text-align: center;"><?php echo number_format($spro->Receipt_Price_Total,2); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4">ไม่พบรายการข้อมูล</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h3>สินค้าจำนำ</h3>
            <table class="display table table-bordered" id="product" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle" style="text-align: center;">ชื่อสินค้าจำนำ</th>
                        <th class="align-middle" style="text-align: center;">จำนวน</th>
                        <th class="align-middle" style="text-align: center;">ราคาต่อหน่วย</th>
                        <th class="align-middle" style="text-align: center;">รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($count_ple > 0) { ?>
                        <?php foreach ($subreceiptpledge as $sple) { ?>
                            <tr>
                                <td class="align-middle" style="text-align: center;"><?php echo $sple->ProdPL_Name; ?></td>
                                <td class="align-middle" style="text-align: center;"><?php echo $sple->Receipt_Amount; ?></td>
                                <td class="align-middle" style="text-align: center;"><?php echo number_format($sple->Receipt_Price_Per,2); ?></td>
                                <td class="align-middle" style="text-align: center;"><?php echo number_format($sple->Receipt_Price_Total,2); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4">ไม่พบรายการข้อมูล</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>