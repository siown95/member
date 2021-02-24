<?php
include "../db.php";
$num = $_GET['num'];
$query = "select lecture_img from lecture where lecture_num = $num";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$dir = "../files/lecture_img/";
$img = $row['lecture_img'];
$query2 = "delete from lecture where lecture_num = $num";
$result = mysqli_query($conn, $query2);
if($result){
    unlink($dir.$img);
    echo '<script>alert("강의가 삭제되었습니다.");location.href="../index.php?mode=admin";</script>';
}else{
    echo '<script>alert("Fail.");history.back();</script>';
}
?>