<?php
session_start(); 
$id = session_id();

?>
<!DOCTYPE html>

<html lang="el">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>NTUA L&IC - Patron:Search</title> <!-- Τίτλος μέχρι 60 χαρακτήρες -->
  
		<meta name="description" content="Αναζήτηση χρηστών User search-trace"> <!-- Περιγραφή μέχρι 160 χαρακτήρες -->
		<link rel="stylesheet" href="site.css" type="text/css" media="all">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

		</head>
	<body >
	<div class="container-fluid">
	<header>
<?php

include "smenu.php";
?>
        </header>	
<!-- modal -->
   <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Confirm Logout</h4>
                </div>
            
                <div class="modal-body">
                    <p>Πρόκειται να διαγράψετε το αρχείο και να γυρίσετε στην Αρχική Σελίδα. Αυτή η κίνηση δεν ακυρώνεται. </p><p>Εάν έχετε αποθηκεύσει το αρχείο στον σκληρό δίσκο επιλέξτε <em style="color:red;">Continue</em>. </p><p>Εάν δεν έχετε αποθηκεύσει το αρχείο επιλέξτε  <em>Cancel</em>.</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok nav-link" href="close.php" >Continue</a>
                </div>
            </div>
        </div>
    </div>

<?php
if (isset($_POST["fid"])){
?>
	
		
		<div class="row">
<?php	
//dimiourgia header sto file
$filename  = 'file\\'.$id.'mm.csv';
$file_to_read = @fopen($filename, "r");
$old_text = @fread($file_to_read, 1024); // max 1024
@fclose($file_to_read);
$file_to_write = fopen($filename, "w");
fwrite($file_to_write, "Loc ci,Barcode,ΝΑΜΕ,Exp.Date,E-mail,PhoneType,Phone,Loc,Time,status,status-msg
".$old_text);

?>

<br>
<div class ="col-12 ">
<h3>Επιλέξτε Download για να κατεβάσετε το αρχείο τοπικά</h3>
<br>
<form action="downld.php" method="post">

<input type="submit" class="btn btn-info btn-block " name="fid" value = "DOWNLOAD" style = "">


</form>
</div>
</div>
<br>
<br>
<div class="row">
<div class ="col-12">
<h3>Επιλέξτε Upload για να ανοίξετε τη διεύθυνση στον φυλλομετρητή όπου θα ανεβάσετε το αρχείο</h3>
<br>
<form action="downld.php" method="post">
<a href="https://script.google.com/macros/s/XXXXXXXXXX/exec" target="_blank" type = "button" class="btn btn-info btn-block" style = "background:#FFCA08">  <span class="glyphicon glyphicon-share" aria-hidden="true"></span>  UPLOAD </a>

</form>
</div>
<?php
}
else {
		
echo '<div class="col-12">';
echo "<em>Επιλέξτε από το menu Logout</em>";
echo '</div>';}
?>
</div>
</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>




</body>
</html>