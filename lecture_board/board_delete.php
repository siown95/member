<?php
include "../db.php";
$num = $_GET['num'];
$query = "delete from board where board_num=$num";
$result = mysqli_query($conn, $query);
if($result){
    echo '<script>alert("후기가 삭제되었습니다.");location.href="../index.php?mode=list";</script>';
}else{
    echo '<script>alert("오류가 발생했습니다.");history.back();</script>';
}
?>