<?php
include "../db.php";
$num = $_GET['num'];
$query = "delete from lecture where lecture_num = $num";
$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("강의가 삭제되었습니다.");location.href="../index.php?mode=admin";</script>';
}else{
    echo $query;
}
?>