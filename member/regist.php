<?php
include "../db.php";
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
$email_query = "select email1, eamil2 from member where email1='$email1' and email2='$email2'";
$email_result = mysqli_query($conn, $email_query);
$row = mysqli_fetch_array($email_result);

if($password != $passChk){
    echo '<script>alert("비밀번호가 일치하지 않습니다.");history.back();</script>';
}
$hashpass = hash("sha256", $password);
if($row['email1'] == $email1 && $row['email1']==$email2){
    echo '<script>alert("등록된 이메일입니다.");location.href="login.html";</script>';
}

$query = "insert into member (uname, id, pw_crypt, email1, email2, phone1, phone2, phone3, home1, home2, home3, zip, address1, address2, sms, mailre)
        values ('$name','$id', '$hashpass','$email1', '$email2', '$phone1', '$phone2', '$phone3', '$home1', '$home2', '$home3', $zip,'$address1', '$address2', $radio, $radio2)";
$result = mysqli_query($conn, $query);
if($result){
     echo '<script>alert("회원가입 완료"); location.href="complete.html";</script>';
}else{
    echo $query;
}

?>