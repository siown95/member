<?php
include "../db.php";
session_start();
$num = $_GET['num'];
$id = $_SESSION['userid'];
$lecture_num = $_POST['lecture_num'];
$title = $_POST['title'];
$satis = $_POST['radio'];
$content = $_POST['content'];

$query = "update board set board_title='$title', board_content='$content', board_satis='$satis', lecture_num=$lecture_num where board_num=$num and id='$id'";
$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("수강후기가 수정되었습니다.");location.href="../index.php?mode=list";</script>';
}else{
    echo $query;
}
?>