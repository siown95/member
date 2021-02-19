<?php
include "../db.php";
session_start();
$id = $_POST['id'];
$password = $_POST['password'];
$pw_crypt = hash("sha256", $password);

$query = "select id, pw_crypt from member where id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if($row == 0){
    echo '<script>alert("등록되지 않은 사용자입니다.");history.back();</script>';
}else if($row['pw_crypt']!=$pw_crypt){
    echo '<script>alert("비밀번호가 일치하지 않습니다.");history.back();</script>';
}else{
    $_SESSION['userid'] = $id;
    echo '<script>alert("로그인 성공!");location.href="/member/index.php/?mode=index";</script>';
    mysqli_close($conn);
}
?>

