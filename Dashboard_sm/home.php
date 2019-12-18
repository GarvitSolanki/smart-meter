<?php

session_start();
include 'db_connection.php';
$conn= OpenCon();


if($_SESSION['loggedin'] != true){
    header("location: index.php");
    exit; 
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: index.php");
  exit;
}
if (isset($_GET['download_csv']))
{
  $i=0;
  $csv="";
  $res=$conn->query(download_csv());
  while ($row=$res->fetch_assoc()) {
      $i++;
      $csv.=preg_replace("/\n/",'',preg_replace("/,/",';',$row['id'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Record_Time'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_to_Neutral_Voltage'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_to_Neutral_Voltage'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_to_Neutral_Voltage'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Average_Voltage'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_Line_current'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_Line_current'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_Line_current'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Neutral_Line_current'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Avg_power_factor'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_Active_Power'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_Active_Power'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_Active_Power'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['3_Phase_Active_Power'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Frequency_Hz'])).",".
            preg_replace("/\n/",'',preg_replace("/,/",';',$row['Active_Total_Import']));
      $csv.="\n";
  }

  if ($i>0) {
      header("Content-type: text/csv");
      header("Content-Disposition: attachment; filename=table.csv");
      header("Pragma: no-cache");
      header("Expires: 0");

      echo $csv;
  } else {
      return "Nothing to download!";
}

          header("location: home.php");
          exit;
    
}
if (isset($_GET['download_xlsx']))
        {

// $i=0;
// $csv="";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=table.xls");
header("Cache-Control: max-age=0");

echo '<table border="1">';
echo '<tr><th>ID</th>
<th>Record_Time</th>
<th>R_Phase_to_Neutral_Voltage</th>
<th>Y_Phase_to_Neutral_Voltage</th>
<th>B_Phase_to_Neutral_Voltage</th>
<th>Average_Voltage</th>
<th>R_Phase_Line_current</th>
<th>Y_Phase_Line_current</th>
<th>B_Phase_Line_current</th>
<th>Neutral_Line_current</th>
<th>Avg_power_factor</th>
<th>R_Phase_Active_Power</th>
<th>Y_Phase_Active_Power</th>
<th>B_Phase_Active_Power</th>
<th>3_Phase_Active_Power</th>
<th>Frequency_Hz</th>
<th>Active_Total_Import</th></tr>';

$res=$conn->query(download_xlsx());
while ($row=$res->fetch_assoc()) {
  echo "<tr><td>".$row['id']."</td>
<td>".$row['Record_Time']."</td>
<td>".$row['R_Phase_to_Neutral_Voltage']."</td>
<td>".$row['Y_Phase_to_Neutral_Voltage']."</td>
<td>".$row['B_Phase_to_Neutral_Voltage']."</td>
<td>".$row['Average_Voltage']."</td>
<td>".$row['R_Phase_Line_current']."</td>
<td>".$row['Y_Phase_Line_current']."</td>
<td>".$row['B_Phase_Line_current']."</td>
<td>".$row['Neutral_Line_current']."</td>
<td>".$row['Avg_power_factor']."</td>
<td>".$row['R_Phase_Active_Power']."</td>
<td>".$row['Y_Phase_Active_Power']."</td>
<td>".$row['B_Phase_Active_Power']."</td>
<td>".$row['3_Phase_Active_Power']."</td>
<td>".$row['Frequency_Hz']."</td>
<td>".$row['Active_Total_Import']."</td></tr>";
//     $i++;
//     $csv.=preg_replace("/\n/",'',preg_replace("/,/",';',$row['id'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Record_Time'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_to_Neutral_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_to_Neutral_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_to_Neutral_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Average_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Neutral_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Avg_power_factor'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['3_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Frequency_Hz'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Active_Total_Import']));
//     $csv.="\n";
}
echo '</table>';
// if ($i>0) 
// {

// }
// else 
// {
//   return "Nothing to download!";
// }
  header("location: home.php");
  exit;
    
}

?>

<?php


//$p_factor=0;
//if(isset($GET['pf']))
//{
//	$p_factor = $_GET['pf']; }

$sql="set time_zone='+5:30'";
$result = $conn->query($sql);


 $sql= "select 
 Frequency_Hz,
 R_Phase_to_Neutral_Voltage,
 Y_Phase_to_Neutral_Voltage,
 B_Phase_to_Neutral_Voltage,
 R_Phase_Line_current,
 Y_Phase_Line_current,
 B_Phase_Line_current,
 Avg_power_factor,
 DATE_ADD(Record_Time, INTERVAL 0 MINUTE) as Rec_Time 
 from smart_meter 
 order by id desc 
 limit 1;";
 $sql1 = "select 
 count(id)*5 as workTime 
 from smart_meter 
 where date(DATE_ADD(Record_Time, INTERVAL 0 MINUTE))  = CURDATE() 
 and 
 R_Phase_Line_current>5 
and 
Y_Phase_Line_current>5 
and 
B_Phase_Line_current>5";

$timeDiff = "select timediff(now(),(select Record_Time from smart_meter order by id desc limit 1)) as timeDiff from smart_meter limit 1;";

 $result = $conn->query($sql);
 $row= $result->fetch_assoc(); 

$result1 = $conn->query($sql1);
 $row1= $result1->fetch_assoc();

$result2 = $conn->query($timeDiff);
 $row2= $result2->fetch_assoc();  

$loadState="ON";


$diff_arr  = explode(":", $row2['timeDiff']);
// foreach ($diff_arr as $key) {
  // echo 1;
// }

// Check mins and hrs
// if ( intval($diff_arr[1]) >= 5 || intval($diff_arr[0]) > 0) {
//     echo "Time more then 5 min";
// } else {
//     echo "Time less then 5 min";
// }
$offTime = "";
// echo $diff_arr[0];
// echo ((float)$row['Neutral_Line_current']);    
if (((float)$row['R_Phase_Line_current'])<=5 || intval($diff_arr[1]) >= 6 || intval($diff_arr[0]) > 0)
{
  $loadState="OFF";
  $offTime="Since<br>".$diff_arr[0]." hrs<br>".$diff_arr[1]." mins";
  if (intval($diff_arr[1]) >= 6 || intval($diff_arr[0] > 0))
   {
    $offTime="Connection Lost<br>Since<br>".$diff_arr[0]." hrs<br>".$diff_arr[1]." mins";

  }
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- <meta http-equiv="Refresh" content="10">  -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Dashboard</title>

     <!-- Bootstrap core CSS-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" type="text/css">


    <!-- Page level plugin CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="mycss/sb-admin.css" rel="stylesheet">

    


  </head>

  <body id="page-top" >

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="home.php">Smart Meter</a>

      <!-- <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
 -->
      <!-- Navbar Search -->
      <form method="POST" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="number" name="price" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" placeholder="Update Price" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-success" name="Update" type="submit" value="Update" type="button">
              <span class="small">Update</span>
            </button>
          </div>
        </div>
      </form>


      <?php
        if(isset($_POST['Update']))
        { 
          $price = $_POST["price"];
          $floatVal = floatval($price);
          if ($floatVal)
           {
            $unit_price = (float) $price;
          }
          
        }    
      ?>
      

      <!-- Navbar -->
    <?php include 'sidebar.php' ?>
      <ul class="navbar-nav ml-auto ml-md-0">
        
       
         
        
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
     

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
      <div class="col-xl-12 col-sm-12 mb-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        
  
          </ol>
</div>
          <!-- Icon Cards-->
          <div class="row">
          
      
      <div class="col-xl-2 col-sm-2 mb-2">
              <div class="card text-white bg-primary o-hidden h-100" style="background-color:#a1edf7 !important;">
                <div class="card-body">
                  <div class="card-body-icon">
                    <div class="led-box" style="padding-top: 36px; padding-right: 36px;">
                      <div class="<?php 
                      if($loadState=="ON")
                      {
                        echo "led-green";
                      }
                      else 
                        {echo "led-red";} 
                      ?>" style="z-index: 200;" ></div>
                    </div>
                  </div>
                  <div class="mr-5" style="font-weight: 410;color:black;"><?php echo $loadState; ?><br><?php echo $offTime; ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left" style="font-weight: 410;color:black;">LOAD STATE</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
    
      <div class="col-xl-2 col-sm-2 mb-2">
              <div class="card text-white bg-primary o-hidden h-100" style="background-color:#fa8072 !important;">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fab fa-creative-commons-sampling"></i>
                  </div>
                  <div class="mr-5" style="font-weight: 410;color:black;"><?php echo number_format((float)$row['Frequency_Hz'],4,'.',''); ?><br>Hz</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left" style="font-weight: 410;color:black;">FREQUENCY</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
      
      <div class="col-xl-2 col-sm-2 mb-2">
              <div class="card text-white bg-primary o-hidden h-100" style="background-color:#D6C3C9 !important;">
                <div class="card-body">
                  <div class="card-body-icon">
            <i class="fas fa-bolt"></i>
                  </div>
                  <div class="mr-5" style="font-weight: 410;color:black;"><?php echo number_format(((float)$row['R_Phase_to_Neutral_Voltage']+(float)$row['Y_Phase_to_Neutral_Voltage']+(float)$row['B_Phase_to_Neutral_Voltage'])/3,4,'.',''); ?><br>volts</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left" style="font-weight: 410;color:black;">VOLTAGE</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-2 col-sm-2 mb-2">
              <div class="card text-white bg-warning o-hidden h-100" style="background-color:#A5B2D7 !important;">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-bolt"></i>
                  </div>
                  <div class="mr-5" style="font-weight: 410;color:black;"><?php
                  
                   echo number_format(((float)$row['R_Phase_Line_current']+(float)$row['Y_Phase_Line_current']+(float)$row['B_Phase_Line_current'])/3,4,'.',''); 
                   ?><br>amp</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left" style="font-weight: 410;color:black;">CURRENT</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
           <div class="col-xl-2 col-sm-2 mb-2">
              <div class="card text-white bg-success o-hidden h-100" style="background-color:#D5E494 !important;" >
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-power-off"></i>
                  </div>
                  <div class="mr-5" style="font-weight: 410;color:black;"><?php echo number_format((float)$row['Avg_power_factor'],4,'.','');?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="graph1.php">
                  <span class="float-left" style="font-weight: 410;color:black;">POWER FACTOR</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
        
      <div class="col-xl-2 col-sm-2 mb-2">
              <div class="card text-white bg-success o-hidden h-100" style="background-color:#7FD1B9 !important;">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-clock"></i>
                  </div>
                  <div class="mr-5" style="font-weight: 410;color:black;"> <?php $time = date( "Y-M-d H:i:s", strtotime( $row['Rec_Time'] ));?>
                <td><?php echo $time  ;?></td></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="graph1.php">
                  <span class="float-left" style="font-weight: 410;color:black;">TIME</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>


            <ul class="alert alert-info">
              <span style="display: inline-block;width: 150px;">Today Active For  </span>
              <?php
            echo "&nbsp;&nbsp;";
            $time_today=explode(":",date('H:i', mktime(0, $row1['workTime']))) ;
            echo $time_today[0]." hrs ".$time_today[1]." mins";
            ?>
            </ul>


            <ul class="alert alert-info">
              <span style="display: inline-block;width: 150px;">Yesterday Active For  </span>
              <?php
            $sql= "select count(id)*5 as activeYesterday
            from smart_meter 
            where date(Record_Time)=date(date_sub(now(),interval 1 day)) 
            and 
            R_Phase_Line_current>5 
            and 
            Y_Phase_Line_current>5 
            and 
            B_Phase_Line_current>5;";

            $result = $conn->query($sql);
            $row= $result->fetch_assoc();
            echo "&nbsp;&nbsp;";
            $time_yesterday=explode(":",date('H:i', mktime(0, $row['activeYesterday']))) ;
            echo $time_yesterday[0]." hrs ".$time_yesterday[1]." mins";
            ?>
            </ul>

            

            <ul class="alert alert-info">
              <span style="display: inline-block;width: 150px;">Load last Deactive  </span>
              <?php
            $sql= "select DATE_ADD(Record_Time, INTERVAL 0 MINUTE) as Rec_Time from smart_meter where id=(select id-1 from smart_meter where R_Phase_Line_current>5 and id-1=(select id from smart_meter where R_Phase_Line_current<5 order by id desc limit 1) );";

            $result = $conn->query($sql);
            if($row= $result->fetch_assoc())
            {
            echo "&nbsp;&nbsp;";
            echo date('l, jS F o g:i A.',strtotime($row['Rec_Time']));
            }
            else
            {
             echo "&nbsp;&nbsp;";
             echo("-"); 
            }
            ?>
            </ul>

            <ul class="alert alert-info">
              <span style="display: inline-block;width: 150px;">Load last Activated  </span>
              <?php
            $sql= "select DATE_ADD(Record_Time, INTERVAL 0 MINUTE) as Rec_Time from smart_meter where R_Phase_Line_current>=5 and id>(select id from smart_meter where R_Phase_Line_current<5 order by id desc limit 1) limit 1;";

            $result = $conn->query($sql);
            if ($row= $result->fetch_assoc()) {
              echo "&nbsp;&nbsp;";
            echo date('l, jS F o g:i A.',strtotime($row['Rec_Time']));  
            }
            else
            {
              echo "&nbsp;&nbsp;";
              echo("-");
            }
            ?>
            </ul>

          <!-- Area Chart Example-->
        

          <!-- DataTables Example -->
        <?php 

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

    $sql1 = "select 
    null as id,
    null as my_value,
    null as diff_to_prev,
    null as c4 from dual
union all 
SELECT x.*
     , COALESCE(x.my_value-@prev,0) diff_to_prev
     , @prev:=my_value as c4  
  FROM myview x
     , (SELECT @prev:=null) vars 
 ORDER 
    BY id desc;"
    ?>
                    
      <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data ENTRIES</div>
            <div class="card-header">
                <a class="btn btn-outline-dark" href='home.php?Yesterday=true' role="button">Yesterday</a>
                <a class="btn btn-outline-dark" href='home.php?Today=true' role="button">Today</a>
                <a class="btn btn-outline-dark" href="home.php?Month=true" role="button">Month</a>
            </div>
              
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th><center>TIME</center></th>
                      <!-- <th><center>ID</center></th> -->
                      <th><center>CURRENT</center></th>
                      <th><center>DAILY</center><center>UNIT(kwh)</center></th>
                      <th><center>DAILY</center><center>COST (IN &#x20b9;)</center></th>
                      <th><center>CUMULATIVE</center><center>UNIT(kwh)</center></th>
                      <th><center>CUMULATIVE</center><center>COST (IN &#x20b9;)</center></th>
                    </tr>
                  </thead>
          
        
</div>
        <?php
        function download_csv()
        {

        $sql='Select * from smart_meter';
        return $sql;

        }

        

        function download_xlsx()
        {

        $sql='Select * from smart_meter';
        return $sql;

        }

        if (isset($_POSTz['download_xlsx']))
        {
//         $i=0;
// $csv="";
// $res=$conn->query(download_xlsx());
// while ($row=$res->fetch_assoc()) {
//     $i++;
//     $csv.=preg_replace("/\n/",'',preg_replace("/,/",';',$row['id'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Record_Time'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_to_Neutral_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_to_Neutral_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_to_Neutral_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Average_Voltage'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Neutral_Line_current'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Avg_power_factor'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['R_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Y_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['B_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['3_Phase_Active_Power'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Frequency_Hz'])).",".
//           preg_replace("/\n/",'',preg_replace("/,/",';',$row['Active_Total_Import']));
//     $csv.="\n";
// }

// if ($i>0) {
//     header("Content-type: text/csv");
//     header("Content-Disposition: attachment; filename=file.csv");
//     header("Pragma: no-cache");
//     header("Expires: 0");

//     echo $csv;
// } else {
//     return "Nothing to download!";
// }


    //     $sql = $sql = "select 
    // max(DATE_ADD(Record_Time, INTERVAL 0 MINUTE)) as Rec_Time,
    // max(id) as id,max(Frequency_Hz) as Frequency_Hz,
    // max(Active_Total_Import)*20 as Active_Total_Import,
    // max(Average_Voltage) as Average_Voltage,
    // max(Avg_power_factor) as Avg_power_factor,
    // max(R_Phase_Line_current) as R_Phase_Line_current,
    // max(Y_Phase_Line_current) as Y_Phase_Line_current,
    // max(B_Phase_Line_current) as B_Phase_Line_current 
    // from smart_meter
    // group by date(DATE_ADD(Record_Time, INTERVAL 0 MINUTE)) 
    // order by id desc;";
          header("location: home.php");
          exit;
    
        }


        function Yesterday()
        {
          $sql="select 
          R_Phase_Line_current,
          Y_Phase_Line_current,
          B_Phase_Line_current,
          Active_Total_Import,
          DATE_ADD(Record_Time, INTERVAL 0 MINUTE) as Rec_Time 
          from smart_meter 
          where Record_Time >= CURDATE() - INTERVAL 1 DAY 
          and 
          Record_Time <CURDATE() order by id desc;";
          return $sql;
        }
        if (isset($_GET['Yesterday']))
        {
          $sql=Yesterday();
        }
        function Today()
        {
          $sql="select 
          R_Phase_Line_current,
          Y_Phase_Line_current,
          B_Phase_Line_current,
          Active_Total_Import,
          DATE_ADD(Record_Time, 
          INTERVAL 0 MINUTE) as Rec_Time 
          from smart_meter 
          where date(Record_Time)  = CURDATE() 
          order by id desc;";
          return $sql;
        }
        if (isset($_GET['Today']))
        {
          $sql=Today();
        }
        function Month()
        {
          $sql="select 
          R_Phase_Line_current,
          Y_Phase_Line_current,
          B_Phase_Line_current,
          Active_Total_Import,
          DATE_ADD(Record_Time, INTERVAL 0 MINUTE) as Rec_Time 
          from smart_meter 
          where month(Record_Time)=month(now()) 
          order by id desc;";
          return $sql;
        }
        if (isset($_GET['Month']))
        {
          $sql=Month();
        }



        $result = $conn->query($sql);
        $result1 = $conn->query($sql1);
        $row_len = $result->num_rows;
                      $row1= $result1->fetch_assoc();
            while($row_len >0)
            {
              $row= $result->fetch_assoc();
              $row1= $result1->fetch_assoc();
              $row_len--;
            ?>
                 
            <tr>
       <td><?php echo $row['Rec_Time']  ;?></td>
       
                
                <td><?php echo number_format(((float)$row['R_Phase_Line_current']+(float)$row['Y_Phase_Line_current']+(float)$row['B_Phase_Line_current'])/3,4,'.',''); ?></td>
                <td><?php echo number_format((float)$row1['diff_to_prev']*20*-1,4,'.',''); ?></td>
                <td><?php echo number_format((float)$row1['diff_to_prev']*(-1)*$unit_price*20,4,'.',''); ?></td>
                <td><?php echo number_format((float)$row['Active_Total_Import'],4,'.','');?></td>
                <td><?php echo number_format(((float)($row['Active_Total_Import'])*$unit_price),4,'.','');?></td>
               
              
            </tr>
        <?php
            }
          
             
       CloseCon($conn);
             ?>

             </table>
                  
                      
                   
                   </div>
               
               
          
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
      .container {
  background-size: cover;
  background: rgb(226,226,226); /* Old browsers */
  background: -moz-linear-gradient(top,  rgba(226,226,226,1) 0%, rgba(219,219,219,1) 50%, rgba(209,209,209,1) 51%, rgba(254,254,254,1) 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(226,226,226,1)), color-stop(50%,rgba(219,219,219,1)), color-stop(51%,rgba(209,209,209,1)), color-stop(100%,rgba(254,254,254,1))); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top,  rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top,  rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(top,  rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* IE10+ */
  background: linear-gradient(to bottom,  rgba(226,226,226,1) 0%,rgba(219,219,219,1) 50%,rgba(209,209,209,1) 51%,rgba(254,254,254,1) 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e2e2e2', endColorstr='#fefefe',GradientType=0 ); /* IE6-9 */
  padding: 20px;
}

.led-box {
  height: 30px;
  width: 25%;
  margin: 10px 0;
  float: left;
}

.led-box p {
  font-size: 12px;
  text-align: center;
  margin: 1em;
}

.led-red {
  margin: 0 auto;
  width: 24px;
  height: 24px;
  background-color: #ff0000;
  border-radius: 50%;
  box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 12px;
  -webkit-animation: blinkRed 0.5s infinite;
  -moz-animation: blinkRed 0.5s infinite;
  -ms-animation: blinkRed 0.5s infinite;
  -o-animation: blinkRed 0.5s infinite;
  animation: blinkRed 0.5s infinite;
}

@-webkit-keyframes blinkRed {
    from { background-color: #F00; }
    50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
    to { background-color: #F00; }
}
@-moz-keyframes blinkRed {
    from { background-color: #F00; }
    50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
    to { background-color: #F00; }
}
@-ms-keyframes blinkRed {
    from { background-color: #F00; }
    50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
    to { background-color: #F00; }
}
@-o-keyframes blinkRed {
    from { background-color: #F00; }
    50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
    to { background-color: #F00; }
}
@keyframes blinkRed {
    from { background-color: #F00; }
    50% { background-color: #A00; box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #441313 0 -1px 9px, rgba(255, 0, 0, 0.5) 0 2px 0;}
    to { background-color: #F00; }
}



.led-green {
  margin: 0 auto;
  width: 24px;
  height: 24px;
  background-color: #00ff00;
  border-radius: 50%;
  box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #304701 0 -1px 9px, #21ff00 0 2px 12px;
}


    </style>




    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.js"></script> -->

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https:////cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script type="text/javascript">
      $( function() {
  var $winHeight = $( window ).height()
  $( '.container' ).height( $winHeight );
});

    var table = $('#dataTable').DataTable({order:[]});


    </script>
  </body>

  
</html>
