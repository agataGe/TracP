<?php
session_start();
$id = session_id();

$dir = '\file\\';
unlink($dir."". $id."mm.csv");
//kill sessions
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);

header('location:index.php');

?>