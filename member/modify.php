<?php 
session_start();
include "../db.php";
$id = $_SESSION['userid'];
$password = $_POST['password'];
$passChk = $_POST['passChk'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$home1 = $_POST['home1'];
$home2 = $_POST['home2'];
$home3 = $_POST['home3'];
$zip = $_POST['zip'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$radio = $_POST['radio'];
$radio2 = $_POST['radio2'];

$row = mysqli_fetch_array($email_result);
$hashpass = hash("sha256", $password);
if($password != $passChk){
    echo '<script>alert("비밀번호와 확인이 다릅니다.");history.back();</script>';
}else{
    $query = "update member set pw_crypt='$hashpass', email1='$email1', email2 = '$email2', home1='$home1', home2='$home2', home3='$home3', 
    address1='$address1', address2='$address2', sms=$radio, mailre=$radio2 where id='$id'";

    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("정보가 수정되었습니다.");location.href="../index.php?mode=index";</script>';

    }else{
        echo '<script>alert("fail");history.back();</script>';
    }
}
mysqli_close($conn);

?>