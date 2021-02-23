<?php
include "../db.php";
$lecure_kind = $_POST['lecture_kind'];
$lecture_title = $_POST['lecture_title'];
$lecture_teacher = $_POST['lecture_teacher'];
$lecture_diffi = $_POST['lecture_diffi'];
$lecture_time = $_POST['lecture_time'];
$lecture_img = $_FILES['lecture_img'];

$file_type = substr($lecture_img['name'], strrpos($lecture_img['name'], '.') + 1);
$dir = '../files/';
$path = md5(microtime()) . '.' . $file_type;

$query = "insert into lecture (lecture_kind, lecture_title, lecture_teacher, lecture_diffi, lecture_time, lecture_img) 
        values('$lecure_kind','$lecture_title','$lecture_teacher','$lecture_diffi','$lecture_time','$dir$path')";
$result = mysqli_query($conn, $query);
if($result){
        move_uploaded_file($lecture_img['tmp_name'], $dir.$path);
        echo '<script>alert("강의가 등록되었습니다.");location.href="../index.php?mode=admin";</script>';
        }else{  
                echo $query;
        }
?>