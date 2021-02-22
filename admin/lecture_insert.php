<?php
include "../db.php";
$lecure_kind = $_POST['lecture_kind'];
$lecture_title = $_POST['lecture_title'];
$lecture_teacher = $_POST['lecture_teacher'];
$lecture_diffi = $_POST['lecture_diffi'];
$lecture_time = $_POST['lecture_time'];
$lecture_img = $_FILES['lecture_img'];
$dir = "../files/";
$file = $dir.basename($_FILES['lecture_img']['name']);

if(move_uploaded_file($_FILES['lecture_img']['tmp_name'], $file)){
        $query = "insert into lecture (lecture_kind, lecture_title, lecture_teacher, lecture_diffi, lecture_time, lecture_img) 
                values('$lecure_kind','$lecture_title','$lecture_teacher','$lecture_diffi','$lecture_time','$file')";
        $result = mysqli_query($conn, $query);
        if($result){
                echo '<script>alert("강의가 등록되었습니다.");location.href="../index.php?mode=admin";</script>';
        }else{  
                echo $query;
        }
}

?>