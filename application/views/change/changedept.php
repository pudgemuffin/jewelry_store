<div class="col-sm-2">
    <select class="form-control" id="pos" name="pos">
    <!-- <option value="">ตำแหน่ง</option> -->
        <?php foreach ($result as $p) { ?>
            <option value="<?php echo $p->Job_Id; ?>">
                <?php echo $p->job; ?>
            </option>
        <?php } ?>
    </select>
</div>