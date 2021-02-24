<?php
include "../db.php";
session_start();
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
$date = date('Y-m-d H:i:s');
$count = 0;
if(isset($attach_file)){
    $query = "insert into board (board_title, board_content, board_satis, board_file, board_date, board_count, member_num, lecture_num) 
    values ('$title', '$content', '$satis', '$file', '$date', $count, $member_num, $lecture_num)";
}else{
    $query = "insert into board (board_title, board_content, board_satis, board_date, board_count, member_num, lecture_num) 
    values ('$title', '$content', '$satis', '$date', $count, $member_num, $lecture_num)";
}

$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("수강후기가 등록되었습니다.");location.href="../index.php?mode=list";</script>';
}else{
    echo $query;
}

?>