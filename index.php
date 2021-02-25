<?php
$mode = $_GET['mode'];
if($mode=='index'){
    header("Location: /index.html");
}else if($mode=='step_01'){
    header("Location: /member/step_01.html");
}else if($mode=='step_02'){
    header("Location: /member/step_02.html");
}
else if($mode=='step_03'){
    header("Location: /member/step_03.html");
}
else if($mode=='complete'){
    header("Location: /member/complete.html");
}else if($mode =='find_id'){
    header("Location: /member/find_id.html");
}
else if($mode =='find_pass'){
    header("Location: /member/find_pass.html");
}
else if($mode =='modify'){
    header("Location: /member/modify.html");
}else if($mode=='list'){
    header("Location: /lecture_board/board_list.html?page=1");
}else if($mode=='write'){
    header("Location: /lecture_board/board_insert.html");
}else if($mode=='admin'){
    header("Location: /admin/index.php?page=1");
}else if($mode=='lecture_insert'){
    header("Location: /admin/lecture_insert.html");
}
?>