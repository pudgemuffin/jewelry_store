<div class="row justify-content-center">
                <div class="col-5">
                    <label>รหัสไปรษณีย์ :</label>
                    <select class="form-control" id="postcode" name="postcode">
                        <option value="">รหัสไปรษณีย์</option>
                        <?php foreach ($result as $d) { ?>
                            <option value="<?php echo $d->POSTCODE; ?>">
                                <?php echo $d->POSTCODE; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>