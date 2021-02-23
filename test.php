<?php

// 파일 업로드 

$file_name = $_FILES['file_upload']['name'];                // 업로드한 파일명
$file_tmp_name = $_FILES['file_upload']['tmp_name'];   		// 임시 디렉토리에 저장된 파일명
$file_size = $_FILES['file_upload']['size'];                // 업로드한 파일의 크기
$mimeType = $_FILES['file_upload']['type'];                 // 업로드한 파일의 MIME Type

// 이미지 파일이 저장될 서버 디렉토리 지정
$save_dir = '../../../../files/';

echo $file_name.'<br>'.$file_tmp_name.'<br>'.$file_size.'<br>'.$mimeType;
// 업로드 파일 확장자 검사 (필요시 추가)


// DB에 기록할 파일 변수 (DB에 저장이 필요한 경우 아래 변수명을 기록하시면 됩니다.)
/*
	$change_file_name : 실제 서버에 업로드 된 파일명. 예: image_145736478766.gif
	$real_name : 원래 파일명. 예: 풍경사진.gif 
	$real_size : 파일 크기(byte)
*/
?>
