<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>รายงานสินค้าขายดีตามช่วงเวลา</title>

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
    <br>
    <form action="<?php echo site_url('callreport/inputdate') ?>" method="post">
        <div class="row justify-content-center">
            <div class="col-3">
                วันเริ่มต้น : <input class="form-control" type="date" id="dates" name="dates">
            </div>
            <div class="col-3">
                วันสิ้นสุด : <input class="form-control" type="date" id="daten" name="daten">
            </div>
            <button type="submit" class="btn btn-info">ค้นหา</button>
        </div>


    </form>
    <br>
    <div class="row">

        <div class="col">
            <div id="piechart"></div>
            <div class="card boder-0 ">
                <table id="aaaa" class="table table-bordered table-striped">
                    <thead>
                        <th>
                            สินค้า
                        </th>
                        <th>
                            จำนวนชิ้น
                        </th>


                    </thead>
                    <tbody>
                        <?php foreach ($reportpro as $rpr) { ?>
                            <tr>
                                <td><?php echo $rpr->Prod_Name; ?> </td>
                                <td><?php echo $rpr->amount; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="card boder-0 ">
            <div id="piechart1"></div>
                <table id="bbbb" class="table table-bordered table-striped">
                    <thead>
                        <th>
                            สินค้า
                        </th>
                        <th>
                            จำนวนชิ้น
                        </th>


                    </thead>
                    <tbody>
                        <?php foreach ($reportple as $rpe) { ?>
                            <tr>
                                <td><?php echo $rpe->ProdPL_Name; ?> </td>
                                <td><?php echo $rpe->amount; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
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

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php foreach ($reportpro as $rpr) { ?>
                ['<?php echo $rpr->Prod_Name; ?>',<?php echo $rpr->amount; ?>],
                <?php }?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options = {
            'title': 'สิ้นค้าขายดีตามช่วงเวลา',
            'width': 550,
            'height': 400
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart1);

    // Draw the chart and set the chart values
    function drawChart1() {
        var data1 = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php foreach ($reportple as $rpe) { ?>
                ['<?php  echo $rpe->ProdPL_Name; ?>',<?php echo $rpe->amount; ?>],
                <?php }?>
        ]);

        // Optional; add a title and set the width and height of the chart
        var options1 = {
            'title': 'สิ้นค้าขายดีตามช่วงเวลา',
            'width': 550,
            'height': 400
        };

        // Display the chart inside the <div> element with id="piechart"
        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart1.draw(data1, options1);
    }

    
</script>