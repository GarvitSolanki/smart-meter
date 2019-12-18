<?php

session_start();

if($_SESSION['loggedin'] != true){
    header("location: index.php");
}

?>

<?php
 include 'db_connection.php';
//$p_factor=0;
//if(isset($GET['pf']))
//{
//	$p_factor = $_GET['pf']; }
 	$conn= OpenCon();
 $sql= "select * from smart_meter order by Record_Time DESC LIMIT 1;";
 $result = $conn->query($sql);
 $row= $result->fetch_assoc(); 
//print_r($row);
//echo gettype($row)."\n";     

?>

<!DOCTYPE html>
<html lang="en">

  <head>

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

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="home.php".php">Smart Meter</a>

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

    <div id="wrapper" style="width:100%">

      <!-- Sidebar -->
     

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
		  <div class="col-xl-12 col-sm-12 mb-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
			  
	
          </ol>
</div>
        

          <!-- DataTables Example -->
        <?php 
		$sql = "select * from smart_meter";
		?>
                    
      <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data ENTRIES</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					 <th>TIME</th>
                      <th>ID</th>
					  <th>FREQUENCY</th>
                     <th>UNIT(kwh)</th>
                      <th>VOLTAGE</th>
                      <th>POWER_FACTOR</th>
					  <th>CURRENT</th>
					 
                     </tr>
                  </thead>
          
        
</div>
        <?php
        $result = $conn->query($sql);
        if($result->num_rows  > 0){

            while($row= $result->fetch_assoc())
            {

            ?>
                 
            <tr>
			 <td><?php echo $row['Record_Time'] ;?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['Frequency_Hz']; ?></td>
                <td><?php echo number_format((float)$row['Active_Total_Import']-10,3,'.',''); ?></td>
                <td><?php echo $row['Average_Voltage']; ?></td>
                <td><?php echo $row['Avg_power_factor'] ;?></td>
				<td><?php echo $row['Neutral_Line_current']; ?></td>
               
              
            </tr>
        <?php
            }
          
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
    <!-- Bootstrap core JavaScript-->
<!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/todc-bootstrap/3.4.0-3.4.1/js/bootstrap.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https:////cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>


  </body>

</html>
