<?php
include "db.php";
session_start();
$id = $_SESSION['userid'];
$password = $_POST['password'];
$passChk = $_POST['passChk'];
$hashpass = hash("sha256", $password);

if($password != $passChk){
    echo '<script>alert("비밀번호와 확인이 다릅니다.");history.back();</script>';
}else{
    $query = "update member set pw='$password', pw_crypt='$hashpass' where id='$id'";
    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("비밀번호가 변경되었습니다.");location.href="00_로그인.html";</script>';
    }
}
?>