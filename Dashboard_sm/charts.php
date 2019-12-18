<?php

session_start();

if($_SESSION['loggedin'] != true){
    header("location: index.php");
}

?>
<?php
 include 'db_connection.php';

 	$conn= OpenCon();
 $sql= "select DATE_ADD(Record_Time, INTERVAL 0 MINUTE) as Rec_Time from smart_meter order by Record_Time DESC  LIMIT 1;";
 $result = $conn->query($sql);
 $row= $result->fetch_assoc(); 
    

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> graphs</title>

    <!-- Bootstrap core CSS-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" type="text/css">


    <!-- Page level plugin CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="mycss/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top" style="overflow:hidden">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="home.php">Smart Meter</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
<?php include 'sidebar.php' ?>
      
       

    </nav>

    <!-- <div id="wrapper"> -->

      <!-- Sidebar -->
      

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Charts</li>
          </ol>

          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated at<?php echo " ".$row['Rec_Time'];?></div>
          </div>


        </div>
        <!-- /.container-fluid -->

       

      </div>
      <!-- /.content-wrapper -->

    <!-- </div> -->
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/todc-bootstrap/3.4.0-3.4.1/js/bootstrap.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <!-- <script src="https:////cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.js"></script> -->

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

   

    <!-- Demo scripts for this page-->
    <!-- <script src="js/demo/chart-area-demo.js"></script> -->
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <?php


// $sql = "select * from smart_meter order by id DESC LIMIT 6";

    $query="SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
    $result = $conn->query($query);

    $sql = "select 
    max(DATE_ADD(Record_Time, INTERVAL 0 MINUTE)) as Rec_Time,
    max(id) as id,max(Frequency_Hz) as Frequency_Hz,
    max(Active_Total_Import)*20 as Active_Total_Import,
    max(Average_Voltage) as Average_Voltage,
    max(Avg_power_factor) as Avg_power_factor,
    max(R_Phase_Line_current) as R_Phase_Line_current,
    max(Y_Phase_Line_current) as Y_Phase_Line_current,
    max(B_Phase_Line_current) as B_Phase_Line_current 
    from smart_meter
    group by date(DATE_ADD(Record_Time, INTERVAL 0 MINUTE)) 
    order by id desc;";

    $result = $conn->query($sql);

?>
    <script>
      // Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
      <?php 
        while($row = $result->fetch_assoc()){
          echo '"'.date('jS F o g:i A.',strtotime($row['Rec_Time'])).'",';
        }
      ?>
    ],
    datasets: [{
      label: "UNITS(kwh)",
      data:[
        <?php 

        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
          echo ((float)$row['Active_Total_Import']).",";
        }
      ?>
      ],
      backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
    }],
  },
  options: {
    scales: {
      xAxes: [{
            barPercentage:0.25,
            gridLines: {
          color: "rgba(0, 0, 0, 0.1)",
        },
        ticks: {
          stepSize: 0
        }

        }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php 
        $sql = "select (max(Active_Total_Import))*20+((max(Active_Total_Import))*20)/8 as maxticks from smart_meter;";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
          echo (int)$row['maxticks'];
        }
      ?>,
          StepSize:<?php echo (int)$row['maxticks']/12;?>
        },
        gridLines: {
          color: "rgba(0, 0, 0, 0.0)",
          
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
    </script>
    <?php
      
			 CloseCon($conn);
             ?>
  </body>

</html>