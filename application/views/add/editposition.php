<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<center>
    <h2>Edit Job</h2>
</center>

<body>
    <?php foreach ($editjob as $e){?>
    <form action="<?php echo site_url('Regis/updatejob') ?>" method="post">
        <?php echo validation_errors(); ?>
        <div style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-5">
                    <label>ชื่อตำแหน่ง</label>
                    <input class="form-control" type=text name="posi" id="posi" value = "<?php echo $e->job;?>"required>
                </div>
            </div><br>
            <div class="row justify-content-center">
                <div class="col-5">

                    <button type="submit" class="btn btn-info" name="updatejob" value="<?php echo $e->Job_Id;?>">Update</button>
                    <a class="btn btn-danger" href="<?php echo site_url('Welcome/viewposition') ?>">Cancel</a>

                </div>
            </div>
        </div>
    </form>
    <?php } ?>
</body>