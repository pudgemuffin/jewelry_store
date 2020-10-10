<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gold - Store</title>
    <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  /* transition: 0.3s; */
    margin-top: 15%;
    padding-bottom: 5%;
}
</style>
<body style="background-color: #6A0011;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="padding-top: 10rem; background-color:#820115">

                    <div class="card-body">
                        <form action="<?php echo site_url('auth/login') ?>" method="post">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right" style="font-weight: bold; color: black;">ชื่อผู้ใช้งาน :</label>
                                <div class="col-md-6">
                                    <input type="text" style = "background-color: #F8EBEB;" id="user" class="form-control" name="user" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right" style="font-weight: bold; color: black;">รหัสผ่าน :</label>
                                <div class="col-md-6">
                                    <input type="password" style = "background-color: #F8EBEB;" id="pass" class="form-control" name="pass" required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger" style="background-color: #A11616; font-weight: bold; color: black;">
                                    เข้าใช้งาน
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    
    </div>

</body>
</html>