<?php
include "../db.php";
$num = $_GET['num'];
$lecure_kind = $_POST['lecture_kind'];
$lecture_title = $_POST['lecture_title'];
$lecture_teacher = $_POST['lecture_teacher'];
$lecture_diffi = $_POST['lecture_diffi'];
$lecture_time = $_POST['lecture_time'];
$lecture_img = $_FILES['lecture_img'];

$file_type = substr($lecture_img['name'], strrpos($lecture_img['name'], '.') + 1);
$dir = '../files/';
$path = md5(microtime()) . '.' . $file_type;

$select_query = "select lecure_img from lecture where lecture_num=$num";
$select_result = mysqli_query($conn, $select_query);
$row = mysqli_fetch_array($select_result);
$origin = $row['lecure_img'];

$update_query = "update lecture set lecture_kind='$lecure_kind', lecture_title='$lecture_title', 
        lecture_teacher='$lecture_teacher', lecture_diffi='$lecture_diffi', lecture_time='$lecture_time', lecture_img='$dir$path' where lecture_num=$num";
$update_result = mysqli_query($conn, $update_query);
if($update_result){
        unlink($origin);
        echo '<script>alert("강의가 수정되었습니다.");location.href="../index.php?mode=admin";</script>';
}else{  
        echo $query;
}


?>