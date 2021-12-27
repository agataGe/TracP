<?php
session_start();
//$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/TracP/";
$id = session_id();
if (isset($_POST["fid"])){


ignore_user_abort(true);
  // output headers so that the file is downloaded 
  header('Content-Encoding: UTF-8');
  header('Content-type: text/csv; charset=UTF-8');
  header('Content-disposition: attachment; filename = '.$id.'mm.csv');
  readfile('\file\\'. $id.'mm.csv');
  unlink('\file\\'. $id.'mm.csv');

}
else {
	header('location:index.php');
	}
?>