<?php
include "../db.php";
$num = $_GET['num'];
$select_query = "select board_file from board where board_num=$num";
$select_result = mysqli_query($conn, $select_query);
$row = mysqli_fetch_array($select_result);
if($row==0){
    $query = "delete from board where board_num=$num";
    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("후기가 삭제되었습니다.");location.href="../index.php?mode=list";</script>';
    }else{
        echo '<script>alert("오류가 발생했습니다.");history.back();</script>';
    }
}else{
    $file = $row['board_file'];
    $file_dir = '../files/board_img/'.$file;
    unlink($file_dir);
    $query = "delete from board where board_num=$num";
    $result = mysqli_query($conn, $query);
    if($result){
        echo '<script>alert("후기가 삭제되었습니다.");location.href="../index.php?mode=list";</script>';
    }else{
        echo '<script>alert("오류가 발생했습니다.");history.back();</script>';
    }
}


?>