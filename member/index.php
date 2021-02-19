<?php
$mode = $_GET['mode'];
if($mode=='index'){
    header("Location: /../index.html");
    exit();
}else if($mode=='step_01'){
    header("Location: /member/step_01.html");
    exit();
}else if($mode=='step_02'){
    header("Location: /member/step_02.html");
    exit();
}
else if($mode=='step_03'){
    header("Location: /member/step_03.html");
    exit();
}
else if($mode=='complete'){
    header("Location: /member/complete.html");
    exit();
}else if($mode =='find_id'){
    header("Location: /member/find_id.html");
    exit();
}
else if($mode =='find_pass'){
    header("Location: /member/find_complete.html");
    exit();
}
else if($mode =='modify'){
    header("Location: /member/modify.html");
    exit();
}
?>