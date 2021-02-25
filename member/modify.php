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

$email_query = "select email1, email2 from member where email1='$email1' and email2='$email2' and id not in ('$id')";
$email_result = mysqli_query($conn, $email_query);
$email_row = mysqli_fetch_array($email_result);

$user_email = "select email1, email2 from member where email1='$email1' and email2='$email2' and id='$id'";
$user_result = mysqli_query($conn, $user_email);
$user_row = mysqli_fetch_array($user_result);

$hashpass = hash("sha256", $password);
if($password != $passChk){
    echo '<script>alert("비밀번호와 확인이 다릅니다.");history.back();</script>';
}

if($email1==$email_row['email1']&&$email2==$email_row['email2']){
    echo '<script>alert("등록된 이메일입니다.");history.back();</script>';
}else{
    if($email1==$user_row['email1']&&$email2==$user_row['email2']){
        $query = "update member set pw_crypt='$hashpass', home1='$home1', home2='$home2', home3='$home3', 
            address1='$address1', address2='$address2', sms=$radio, mailre=$radio2 where id='$id'";
    }else{
        $query = "update member set pw_crypt='$hashpass', email1='$email1', email2 = '$email2', home1='$home1', home2='$home2', home3='$home3', 
            address1='$address1', address2='$address2', sms=$radio, mailre=$radio2 where id='$id'";
    }   
    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("정보가 수정되었습니다.");location.href="../index.php?mode=index";</script>';

    }else{
        echo '<script>alert("fail");history.back();</script>';
    }
}
?>