<?php 
include "../db.php";
$id = $_POST["id"];
$query = "select id from member where id='".$id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$idobj = substr($id, 0, 1);
$chk = '/^[a-z]+$/';

if(!preg_match($chk, $idobj)){
    echo json_encode(array('res'=>'match_fail'));
}else{
    if($row == 0){
        echo json_encode(array('res'=>'success'));
    }else{
        echo json_encode(array('res'=>'fail'));
    }    
}
mysqli_close($conn);
?>


