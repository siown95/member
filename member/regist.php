<?php
include "db.php";
$name = $_POST['name'];
$id = $_POST['id'];
$password = $_POST['password'];
$passChk = $_POST['passChk'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$phone1 = $_POST["phone1"];
$phone2 = $_POST["phone2"];
$phone3 = $_POST["phone3"];
$home1 = $_POST['home1'];
$home2 = $_POST['home2'];
$home3 = $_POST['home3'];
$zip = $_POST['zip'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$radio = $_POST['radio'];
$radio2 = $_POST['radio2'];
$email = $email1.'@'.$email2;
$phone = $phone1.'-'.$phone2.'-'.$phone3;
$email_query = "select email from member where email='$email'";
$email_result = mysqli_query($conn, $email_query);
$row = mysqli_fetch_array($result);
if($home1 != '' && $home2 != '' && $home3 != ''){
    $home = $home1.'-'.$home2.'-'.$home3;
}else{
    $home = '';
}
$address = $address1.' '.$address2;
$hashpass = hash("sha256", $password);
$check_email=filter_var($email, FILTER_VALIDATE_EMAIL);
if($password != $passChk){
    echo '<script>alert("비밀번호와 확인이 다릅니다.");history.back();</script>';
}else if($check_email!=true){
    echo '<script>alert("잘못된 이메일 형식입니다.");history.back();</script>';
}else if(row == 1){
    echo '<script>alert("등록된 이메일 형식입니다.");history.back();</script>';
}else{
    $query = "insert into member (uname, id, pw, pw_crypt, email, phone, home, zip,address, sms, mailre)
        values ('$name','$id','$password','$hashpass','$email','$phone','$home','$zip','$address', $radio, $radio2)";
    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("회원가입 완료"); location.href="complete.html";</script>';
    }else{
        echo '<script>alert("Fail!"); history.back();</script>';
    }
}

?>