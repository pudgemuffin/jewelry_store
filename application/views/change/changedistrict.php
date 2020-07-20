<div class="row justify-content-center">
                <div class="col-5">
                    <label>แขวง :</label>
                    <select class="form-control" id="district" name="district">
                        <option value="">แขวง</option>
                        <?php foreach ($result as $d) { ?>
                            <option value="<?php echo $d->DISTRICT_ID; ?>">
                                <?php echo $d->DISTRICT_NAME; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            