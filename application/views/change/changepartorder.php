

    <!-- <select class="form-control" id="prodid[]" name="prodid[]" required oninvalid="this.setCustomValidity('กรุณาเลือกสินค้า')" oninput="setCustomValidity('')"onchange="prices()"> -->
            <option value="">กรุณาเลือกสินค้า</option>
            <?php foreach ($result as $pr) { ?>
                <option value="<?php echo $pr->Prod_Id; ?>">
                    <?php echo $pr->Prod_Name; ?>
                </option>
            <?php } ?>
  
<!-- 
    <td><input class="form-control" type="text" id="price" name="price" readonly></td>
    <td><input class="form-control" id="piece[]" name="piece[]" required oninvalid="this.setCustomValidity('กรุณากรอกจำนวน')" oninput="setCustomValidity('')"></td>
    <td><input class="form-control" id="total" name="total" readonly></td>
    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td> -->

