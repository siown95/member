<?php
include "../db.php";
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$phone3 = $_POST['phone3'];

$query = "select phone1, phone2, phone3 from member where phone1='$phone1' and phone2='$phone2' and phone3='$phone3'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
	
if($row!=0){
	echo json_encode(array('res'=>'duplicate'));
}else{
    echo json_encode(array('res'=>'success'));
}
?>