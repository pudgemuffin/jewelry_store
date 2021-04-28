<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>รายงานกำไรขาดทุน</title>

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
<h2 style="text-align: center;">รายงานกำไรขาดทุน</h2>
    <br>
    <form action="<?php echo site_url('callreport/inputprofit') ?>" method="post">
        <div class="row justify-content-center">
            <div class="col-3">
                วันเริ่มต้น : <input class="form-control" type="date" id="dates" name="dates" required>
            </div>
            <div class="col-3">
                วันสิ้นสุด : <input class="form-control" type="date" id="daten" name="daten" required>
            </div>
            <button type="submit" class="btn btn-info">ค้นหา</button>
        </div>
        <br>
            
    </form>
    <br>

    
    <div class="row">
        <div class="col">
        <div class="row justify-content-center">
        <!-- <div id="barchart"></div> -->
    </div>
            <div id="barchart"></div>
            <div class="card boder-0 ">
                <table id="aaaa" class="table table-bordered table-striped">
                    <thead>
                        <th>
                            สินค้า
                        </th>
                        <th>
                            กำไร/ขาดทุน
                        </th>


                    </thead>
                    <tbody>
                        <?php foreach ($profit as $pr) { ?>
                            <tr>
                                <td><?php echo $pr->Prod_Name; ?> </td>
                                <td><?php echo number_format($pr->Total,2); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col">
            <div class="card boder-0 ">
                <div id="barchar1"></div>
                <table id="bbbb" class="table table-bordered table-striped">
                    <thead>
                        <th>
                            สินค้า
                        </th>
                        <th>
                            กำไร/ขาดทุน
                        </th>


                    </thead>
                    <tbody>
                        <?php foreach ($plefit as $pl) { ?>
                            <tr>
                                <td><?php echo $pl->ProdPL_Name; ?> </td>
                                <td><?php echo number_format($pl->profit,2); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

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
    //         <?php foreach ($profit as $pr) { ?>['<?php echo $pr->Prod_Name; ?>', <?php echo $pr->Total; ?>],
    //         <?php } ?>
    //     ]);

    //     // Optional; add a title and set the width and height of the chart
    //     var options = {
    //         'title': 'กำไร/ขาดทุนของสินค้า',
    //         'width': 550,
    //         'height': 400
    //     };

    //     // Display the chart inside the <div> element with id="piechart"
    //     var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    //     chart.draw(data, options);
    // }

    // google.charts.load('current', {
    //     'packages': ['corechart']
    // });
    // google.charts.setOnLoadCallback(drawChart1);

    // // Draw the chart and set the chart values
    // function drawChart1() {
    //     var data1 = google.visualization.arrayToDataTable([
    //         ['Task', 'Hours per Day'],
    //         <?php foreach ($plefit as $pl) { ?>['<?php echo $pl->ProdPL_Name; ?>', <?php echo $pl->profit; ?>],
    //         <?php } ?>
    //     ]);

    //     // Optional; add a title and set the width and height of the chart
    //     var options1 = {
    //         'title': 'กำไร/ขาดทุนของสินค้าจำนำ',
    //         'width': 550,
    //         'height': 400
    //     };

    //     // Display the chart inside the <div> element with id="piechart"
    //     var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
    //     chart1.draw(data1, options1);
    // }

           
    google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(prodbar);
            google.charts.setOnLoadCallback(pledge);

            function prodbar() {
                var data = google.visualization.arrayToDataTable([
                    ['สินค้า', 'กำไร/ขาดทุน'],
                    <?php
                    $prod = '';
                    // $rowprod = 0;
                    foreach ($profit as $pr) {
                            $prod .= "['$pr->Prod_Name',$pr->Total],";
                            // $rowprod++;
                        }
                        
                   
                    echo $prod;
                    ?>
                ]);
                var options = {
                    chart: {
                        title: 'กำไร/ขาดทุน',
                    },
                    bars: 'vertical' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('barchart'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }

            function pledge() {
                var data1 = google.visualization.arrayToDataTable([
                    ['สินค้า', 'กำไร/ขาดทุน'],
                    <?php
                    $pled = '';
                    $rowpled = 0;
                    foreach ($plefit as $pl) {
                            $pled .= "['$pl->ProdPL_Name',$pl->profit],";
                            $rowpled++;
                        }
                        
                   
                    echo $pled;
                    ?>
                ]);
                var options1 = {
                    chart: {
                        title: 'กำไร/ขาดทุน',
                    },
                    bars: 'vertical' // Required for Material Bar Charts.
                };

                var chart1 = new google.charts.Bar(document.getElementById('barchar1'));

                chart1.draw(data1, google.charts.Bar.convertOptions(options1));
            }
</script>
