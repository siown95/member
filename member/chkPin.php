<?php
session_start();
$pin = $_POST['pin'];

if($pin == $_SESSION['pin']){
    echo json_encode(array('res'=>'success'));
}else{
    echo json_encode(array('res'=>'fail'));
}
?>