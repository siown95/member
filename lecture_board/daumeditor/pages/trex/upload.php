<?php
$tmpfilename = $_FILES['upload_file']['tmp_name'];
$filename = $_FILES['upload_file']['filename'];
$filetype = $_FILES['upload_file']['type'];
$filesize= $_FILES['upload_file']['size']
$destination = '../files' . $filename;
$fileurl = "http://test.hackers.com/files" . $filename;
move_uploaded_file ( $tmpfilename, $destination );
write_into_db_filemeta($filename, $desination, $filesize, $filetype, $fileurl);
?>

<script type="text/javascript"> 
var _opener = PopupUtil.getOpener();
var _attacher = getAttacher('file', _opener);
registerAction(_attacher);

if (typeof(execAttach) == 'undefined') { 
    //Virtual Function return; 
} 
var _mockdata = { 
    'attachurl': '<?=$fileurl?>', 
    'filemime': '<?=$filetype?>', 
    'filename': '<?=$filename?>', 
    'filesize': <?=$filesize?> 
}; 
execAttach(_mockdata); 
closeWindow(); 
</script>

