<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>รายงานยอดขายสินค้า</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css'); ?>" />

    <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.js'); ?>"></script>
</head>

<body>
<h2 style="text-align: center;">ยอดขายสินค้าประจำปี</h2>
    <br>
    <form action="<?php echo site_url('callreport/inputcrosstab') ?>" method="post">
        <div class="row justify-content-center">
            <div class="col-3">
                <select class="custom-select text-danger" name="year" id="year" required>
                    <option value="" class='input-center' disabled="disabled">เลือกปีที่ต้องการออกรายงาน</option>
                    <?php
                    $this_y = date("Y");
                    $year = date("Y");
                    ?>
                    <?php for ($i = 0; $i <= 10; $i++) { ?>
                        <option value="<?= $year ?>"><?= $year ?></option>
                    <?php $year--;
                    } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-info">ค้นหา</button>
        </div>
    </form>
    <br>
    
    <div class="row">

        <div class="col">

            <!-- <div id="piechart"></div> -->
            <div class="card boder-0 ">
                <table id="aaaa" class="table table-bordered table-striped">
                    <thead>
                        <th>สินค้า</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                    </thead>
                    <tbody>
                        <?php foreach ($cross as $cr) { ?>
                            <tr>
                                <td><?php echo $cr->Prod_Name; ?> </td>
                                <td><?php echo number_format($cr->Jan, 2); ?></td>
                                <td><?php echo number_format($cr->Feb, 2); ?></td>
                                <td><?php echo number_format($cr->Mar, 2); ?></td>
                                <td><?php echo number_format($cr->Apr, 2); ?></td>
                                <td><?php echo number_format($cr->May, 2); ?></td>
                                <td><?php echo number_format($cr->Jun, 2); ?></td>
                                <td><?php echo number_format($cr->Jul, 2); ?></td>
                                <td><?php echo number_format($cr->Aug, 2); ?></td>
                                <td><?php echo number_format($cr->Sep, 2); ?></td>
                                <td><?php echo number_format($cr->Oct, 2); ?></td>
                                <td><?php echo number_format($cr->Nov, 2); ?></td>
                                <td><?php echo number_format($cr->Dec, 2); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <h2 style="text-align: center;">ยอดขายสินค้าจำนำประจำปี</h2>
    <div class="row">

        <div class="col">

            <!-- <div id="piechart"></div> -->
            <div class="card boder-0 ">
                <table id="bbbb" class="table table-bordered table-striped">
                    <thead>
                        <th>สินค้า</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                    </thead>
                    <tbody>
                        <?php foreach ($ple as $pl) { ?>
                            <tr>
                                <td><?php echo $pl->ProdPL_Name; ?> </td>
                                <td><?php echo number_format($pl->Jan, 2); ?></td>
                                <td><?php echo number_format($pl->Feb, 2); ?></td>
                                <td><?php echo number_format($pl->Mar, 2); ?></td>
                                <td><?php echo number_format($pl->Apr, 2); ?></td>
                                <td><?php echo number_format($pl->May, 2); ?></td>
                                <td><?php echo number_format($pl->Jun, 2); ?></td>
                                <td><?php echo number_format($pl->Jul, 2); ?></td>
                                <td><?php echo number_format($pl->Aug, 2); ?></td>
                                <td><?php echo number_format($pl->Sep, 2); ?></td>
                                <td><?php echo number_format($pl->Oct, 2); ?></td>
                                <td><?php echo number_format($pl->Nov, 2); ?></td>
                                <td><?php echo number_format($pl->Dec, 2); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#aaaa').DataTable({
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, "All Data"]
            ],
            language: {
                "emptyTable": "ไม่พบข้อมูลสินค้า"
            }
        });

        $('#bbbb').DataTable({
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, "All Data"]
            ],
            language: {
                "emptyTable": "ไม่พบข้อมูลสินค้า"
            }
        });
    });


    // google.charts.load('current', {
    //     'packages': ['corechart']
    // });
    // google.charts.setOnLoadCallback(drawChart);

    // // Draw the chart and set the chart values
    // function drawChart() {
    //     var data = google.visualization.arrayToDataTable([
    //         ['Task', 'Hours per Day'],
    //         <?php foreach ($cross as $cr) { ?>
    //             ['<?php echo $cr->Prod_Name; ?>',<?php echo $cr->Jan; ?>],
    //             ['<?php echo $cr->Prod_Name; ?>',<?php echo $cr->Feb; ?>],
    //             <?php } ?>
    //     ]);

    //     // Optional; add a title and set the width and height of the chart
    //     var options = {
    //         'title': 'ยอดขายสินค้าประจำปี',
    //         'width': 550,
    //         'height': 400
    //     };

    //     // Display the chart inside the <div> element with id="piechart"
    //     var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    //     chart.draw(data, options);
    // }
</script>