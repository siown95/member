<?php
include "../db.php";
session_start();
$num = $_GET['num'];
$id = $_SESSION['userid'];
$member_num_query = "select member_num from member where id='$id'";
$member_num_result = mysqli_query($conn, $member_num_query);
$member_num_row = mysqli_fetch_array($member_num_result);
$member_num = $member_num_row['member_num'];
$lecture_num = $_POST['lecture_num'];
$title = $_POST['title'];
$satis = $_POST['radio'];
$content = $_POST['content'];
$attach_file = $_POST['attach_file'];
$explode = explode('=', $attach_file);
$file = $explode[1];

if(isset($attach_file)){
    $query = "update board set board_title='$title', board_content='$content', board_satis='$satis', board_file='$board_file', lecture_num=$lecture_num 
    where board_num=$num and member_num='$member_num'";
}else{
    $query = "update board set board_title='$title', board_content='$content', board_satis='$satis', lecture_num=$lecture_num 
    where board_num=$num and member_num='$member_num'";
}
$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("수강후기가 수정되었습니다.");location.href="../index.php?mode=list";</script>';
}else{
    echo $query;
}
?>