<?php
@session_start();
include '../global_config/databaseconfig.php';
global $aid;
if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];}
if(isset($_GET['aid'])){ 
    $aid = $_GET['aid'];
//     $del= $mysqli->query("DELETE FROM `login`.`appointment` WHERE `appointment`.`app_id` = \'$aid'");
//    delete_appointment($aid);
               }
//if(isset($_POST['location'])){ $loc = $_POST['location']; }
$mysqli = new mysqli($host,$username,$password,$db_name);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
// echo $mysqli->host_info . "\n";
$mysqli = new mysqli("127.0.0.1",$username,$password,$db_name, 3306);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$cid=$mysqli->query("select id from members where username='$user'");
$row = mysqli_fetch_assoc($cid);
$custid = $row['id'];
 $result = $mysqli->query( "select a.app_id,p.provider_name,l.lname,s.sname,DATE_FORMAT(sc.date,'%d-%m-%Y') as date,DATE_FORMAT(sc.start_time,'%h:%i %p') as start_time,DATE_FORMAT(sc.end_time,'%h:%i %p') as end_time\n"
    . "from appointment a join provider_members p on p.id = a.providerid_fk join locations l on l.pincode = a.locationid_fk join services s on s.service_id = a.serviceid_fk\n"
    . "join schedule sc on sc.schedule_id = a.schedulefk_id where a.custfk_id = '$custid' AND sc.date >= CURDATE()");
 ?>