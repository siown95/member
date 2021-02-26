<?php
include "../db.php";

$kind = $_POST['kind'];
$query = "select lecture_num, lecture_title from lecture where lecture_kind = '$kind'";
$option = "";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)){
    $option = $option.'<option value="'.$row['lecture_num'].'">'.$row['lecture_title'].'</option>';
}
echo $option;
?>