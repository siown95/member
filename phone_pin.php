<?php
session_start();
$pin = $_GET["pin"];

if($_SESSION["pin"] == $pin){
    echo '
    <script>alert("인증에 성공하였습니다.");
    location.href="01_회원가입_03_정보입력.html"
    </script>';
    session_destroy();
}else{
    echo '<script>alert("인증에 실패하였습니다."); history.back();</script>';
}
?>