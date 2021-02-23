<?php
include "../db.php";
session_start();
$id = $_SESSION['userid'];
$lecture_num = $_POST['lecture_num'];
$title = $_POST['title'];
$satis = $_POST['radio'];
$content = $_POST['content'];

$query = "insert into board (board_title, board_content, board_satis, id, lecture_num) values ('$title', '$content', '$satis', '$id', $lecture_num)";
$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("수강후기가 등록되었습니다.");location.href="../index.php?mode=list";</script>';
}else{
    echo $query;
}
?>