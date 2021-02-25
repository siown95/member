<?php
session_start();

$pin = $_POST['pin'];
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$phone3 = $_POST['phone3'];
if($pin == $_SESSION['pin']){
    echo json_encode(array('res'=>'success'));
    $_SESSION['phone1'] = $phone1;
    $_SESSION['phone2'] = $phone2;
    $_SESSION['phone3'] = $phone3;
}else{
    echo json_encode(array('res'=>'fail'));
}
?>