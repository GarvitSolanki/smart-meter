<?php
include 'db_connection.php';

//$v1=$v2 =$v3=$v4 =$t= 0;
$conn = OpenCon();
//print_r($_GET);
$id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6);

//echo "id is".$id;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	
  $freq= $_GET['f'];
  $unitc = $_GET['uc'];
  $volts = $_GET['v'];
  $curr = $_GET['c'];
  $powerf = $_GET['pf'];
}
$sql = "insert into get_values(var_key,frequency (Hz),unitconsumption(kwh),voltage(avg),current(avg),powerfactor(avg))values('$id','freq','$unitc','$volts','$curr','$powerf')";
if(!$result = $conn->query($sql)){
 die('There was an error running the query [' . $conn->error . ']');
	echo '{"status":"failure","msg":"There was an error running the query"}';
}
else
{
  echo '{"status":"success","msg":"The values were recorded successfully"}';
}

CloseCon($conn);
?>