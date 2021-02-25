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
$hashpass = hash("sha256", $password);
$passValidate = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/";

$email = $email1.'@'.$email2;
$emailValidate = "/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";
$email_query = "select email1, email2 from member where email1='$email1' and email2='$email2'";
$email_result = mysqli_query($conn, $email_query);
$row = mysqli_fetch_array($email_result);



if($email1==$row['email1'] && $email2==$row['email2']){
    echo json_encode(array('res'=>'emailDuplicate'));
}
if(!preg_match($emailValidate,$email)){
    echo json_encode(array('res'=>'email_fail'));
}
if(!preg_match($passValidate,$password)){
    echo json_encode(array('res'=>'password_fail1'));
}
if($password != $passChk){
    echo json_encode(array('res'=>'password_fail2'));
}

$query = "insert into member (uname, id, pw_crypt, email1, email2, phone1, phone2, phone3, home1, home2, home3, zip, address1, address2, sms, mailre)
        values ('$name','$id', '$hashpass','$email1', '$email2', '$phone1', '$phone2', '$phone3', '$home1', '$home2', '$home3', $zip,'$address1', '$address2', $radio, $radio2)";
$result = mysqli_query($conn, $query);
if($result){
    echo json_encode(array('res'=>'success'));
}else{
    echo json_encode(array('res'=>'fail'));
}

?>