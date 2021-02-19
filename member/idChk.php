<?php 
include "../db.php";
$id = $_GET["id"];
$query = "select id from member where id='".$id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$idobj = substr($id, 0, 1);
$chk = '/^[a-z]+$/';

if(!preg_match($chk, $idobj)){
    echo '<script>alert("아이디는 영어 소문자로 시작해야 합니다.");window.close();</script>';
}else{
    if($row == 0){
        echo '<script>alert("'.$id.'는 사용 가능한 아이디입니다.");opener.sendData();window.close();</script>';
    }else{
        echo '<script>alert("중복된 아이디 입니다.");window.close();</script>';
    }    
}
mysqli_close($conn);
?>


