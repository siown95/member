<?php
include "../db.php";
$lecure_kind = $_POST['lecture_kind'];
$lecture_title = $_POST['lecture_title'];
$lecture_teacher = $_POST['lecture_teacher'];
$lecture_diffi = $_POST['lecture_diffi'];
$lecture_time = $_POST['lecture_time'];
$lecture_img = $_FILES['lecture_img'];

$file_name = $_FILES['lecture_img']['name'];
$file_tmp_name = $_FILES['lecture_img']['tmp_name'];
$file_size = $_FILES['lecture_img']['size'];
$mimeType = $_FILES['lecture_img']['type'];
$file_type = substr($lecture_img['name'], strrpos($lecture_img['name'], '.') + 1);

if($file_type=="html" || $file_type=="htm" || $file_type=="php" || $file_type=="php3" || $file_type=="inc" || $file_type=="pl" || $file_type=="cgi" || $file_type=="txt" || $file_type=="TXT" || $file_type=="asp" || $file_type=="jsp" || $file_type=="phtml" || $file_type=="js" || $file_type=="") { 
	echo '<script> alert("업로드를 할 수 없는 파일형식입니다."); history.back(); </script>'; 
	exit;
}

$real_name = $file_name;
$arr = explode(".", $real_name);	 // 파일의 확장자명을 가져와서 그대로 사용	 $file_exe	
$arr1 = $arr[0];	
$arr2 = $arr[1];	
$arr3 = $arr[2];	
$arr4 = $arr[3];	
if($arr4) { 
        $file_exe = $arr4;
} else if($arr3 && !$arr4) { 
	$file_exe = $arr3;					
} else if($arr2 && !$arr3) { 
	$file_exe = $arr2;					
}
$file_time = time(); 
$file_Name = "file_".$file_time.".".$file_exe;
$save_dir = '../files/lecture_img/';
$path = "file_".$file_time.".". $file_type;
$change_file_name = $file_Name;
$dest_url = $save_dir.$change_file_name;

if(!move_uploaded_file($file_tmp_name, $dest_url))
{
   die("파일을 지정한 디렉토리에 업로드하는데 실패했습니다.");
}

$query = "insert into lecture (lecture_kind, lecture_title, lecture_teacher, lecture_diffi, lecture_time, lecture_img) 
        values('$lecure_kind','$lecture_title','$lecture_teacher','$lecture_diffi','$lecture_time','$change_file_name')";
$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("강의가 등록되었습니다.");location.href="../index.php?mode=admin";</script>';
    }else{  
        echo $query;
    }
?>