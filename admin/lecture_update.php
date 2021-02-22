<?php
include "../db.php";
$num = $_GET['num'];
$lecure_kind = $_POST['lecture_kind'];
$lecture_title = $_POST['lecture_title'];
$lecture_teacher = $_POST['lecture_teacher'];
$lecture_diffi = $_POST['lecture_diffi'];
$lecture_time = $_POST['lecture_time'];
$lecture_img = $_FILES['lecture_img'];
$dir = "../files/";
$file = $dir.basename($_FILES['lecture_img']['name']);

if(move_uploaded_file($_FILES['lecture_img']['tmp_name'], $file)){
        $query = "update lecture set lecture_kind='$lecure_kind', lecture_title='$lecture_title', 
        lecture_teacher='$lecture_teacher', lecture_diffi='$lecture_diffi', lecture_time='$lecture_time', lecture_img='$lecture_img' where lecture_num=$num";
        $result = mysqli_query($conn, $query);
        if($result){
                echo '<script>alert("강의가 수정되었습니다.");location.href="../index.php?mode=admin";</script>';
        }else{  
                echo $query;
        }
}

?>