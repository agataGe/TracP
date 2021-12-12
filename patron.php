<?php
if (!isset($_SESSION)) { session_start(); }
$id = session_id();

//$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/TracP/";

$secret_key = hex2bin('UR secretkey...');

$ubarcodeO = (isset($_POST["itemno"]) ? trim($_POST["itemno"]) : "");
$ubarcode = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($ubarcodeO))))));
echo $ubarcodeO;
?>
<!DOCTYPE html>

<html lang="el">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>NTUA L&amp;IC - Patron:Search</title> <!-- Τίτλος μέχρι 60 χαρακτήρες -->
  
		<meta name="description" content="Αναζήτηση χρηστών User search-trace"> <!-- Περιγραφή μέχρι 160 χαρακτήρες -->
		<link rel="stylesheet" href="site.css" type="text/css" media="all">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

		</head>
	<body>
		<div class="container-fluid">	
<!-- modal -->
   <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
<!--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                    <h4 class="modal-title" id="myModalLabel">Confirm Logout</h4>
                </div>
            
                <div class="modal-body">
                    <p>Πρόκειται να διαγράψετε το αρχείο και να γυρίσετε στην Αρχική Σελίδα. Αυτή η κίνηση δεν ακυρώνεται. </p><p>Εάν θέλετε να συμβεί αυτό επιλέξτε <em style="color:red;">Continue</em>. </p><p>Εάν όχι επιλέξτε <em>Cancel</em>.</p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok nav-link" href="close.php" >Continue</a>
                </div>
            </div>
        </div>
    </div>

		<?php 
		include "////.php"; // menu file here

if (isset($_GET['psearch']) && !empty($_GET['psearch'])){
	
	$getcsid = urldecode($_GET['psearch']);
	$colId7 = openssl_decrypt($getcsid,"AES-128-ECB",$secret_key);
//	var_dump ($colId7);
	$colId=trim ($colId7);

//prepare for send sto del-page
$getcsidfetback = urlencode(openssl_encrypt($colId,"AES-128-ECB",$secret_key));

}
else {

header('location:index.php');
}
//}
//--------- check location
$filename  = 'files\\'.$id.'mm.csv';
$c=csv_to_array($filename);
//var_dump( $c);
if (file_exists($filename)){
	$res = array_column($c, 0);
//print_r( $res);
	$last_rowz = array_pop($res);
//echo last_rowz;

        if ($last_rowz !== $colId) {
			header('location:index.php');           
		}
}
//----------

?>

	
	<section class="search-block">

<div class="container">	
	<div class="row">
		<div class="col-4 ">
		    <h2 class="text-center login-sec" >Search Now</h2>
		    <form class="" action="" method="post">
			<div class="form-group">
				
				<input type="text" class="form-control" name="itemno" placeholder="Insert User Barcode" autofocus >
			</div>

		<div class="form-group">
<label for="" class="text-uppercase">User Barcode</label>
			<button type="submit" class="btn-search float-right">S u b m i t</button>
		</div>
  	</form>

		</div>
		<div class="col-8">
		
		
<?php

if ($ubarcode != "" && (strlen($ubarcode) == 6 || strlen($ubarcode) == 12 || strlen($ubarcode) == 7)) {
//search & fetch ston user to apotelesma
		$obj = showPReport($ubarcode, $colId);
//		var_dump ($obj);
		$locsheet = $obj['sheetrow'];
		$barcode = $obj['barcode'];
		$loc = $obj['library'];
		$call = $obj['E-mail'];
		$due = $obj['Exp-Date'];
		$titl = $obj['NAME'];
		$phonecode = $obj['phone1'];
		$phones = $obj['phone2'];
		$status = $obj['status'];
		$status_mes = $obj['status_msg'];

?>
<div class = "panel panel-default ">
  <!-- Default panel contents -->


<?php
//errors in red - BOOM

$error = "";
echo '<table class="table table-hover" >';
echo '<thead>';

echo '<tr>';
echo '<th style="text-align:center;">barcode</th>';
echo '<th style="text-align:center;">name</th>';
echo '<th style="text-align:center;">status</th>';
echo '<th style="text-align:center;">Message</th>';
echo '</tr>';
echo '</thead>';
		echo "\n<tbody>\n<tr>";
		if ($status!=="PASS")$error.='error';
		 switch($error) {
                                case "error":
                                    echo '<td class="error" style="text-align:center;">'.$barcode.'</td>';

                                    echo '<td class="error" style="text-align:center;">'.$titl.'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$status.'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$status_mes.'</td>';
                                    break;
                                default:
                                    echo '<td style="text-align:center;">'.$barcode.'</td>';
                                    echo '<td style="text-align:center;">'.$titl.'</td>';
                                    echo '<td style="text-align:center;">'.$status.'</td>';
                                    echo '<td style="text-align:center;">'.$status_mes.'</td>';
                       
    }    
		 echo "</tr>\n";
		 echo "\n</tbody></table></div>";
    

//write se arxeio
$f = fopen('files/'.$id.'mm.csv', 'a'); // Configure fOpen to create, open and write only.
fputcsv($f, $obj);
fclose($f);

		}
		else {
			
			
			echo '<br><br><div class="alert alert-info alert-dismissible text-center fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>To barcode πρέπει να έχει μήκος <strong>12, 7</strong> ή <strong>6</strong> ψηφία. </div>';

		}
?>
	</div>

	</div>
	</div>


</section>

<section>

<div class = "">
<?php


echo '<br>';

//read file and fetch ston user
echo '<table class="table table-hover table-condensed" >';
echo '<thead>';

echo '<tr>';

echo '<th >LOC c-i</th>';
echo '<th style="text-align:center;">Barcode</th>';
echo '<th style="text-align:center;">ΝΑΜΕ</th>';
echo '<th style="text-align:center;">Exp. Date</th>';
echo '<th style="text-align:center;">E-mail</th>';
echo '<th style="text-align:center;">Phone</th>';
echo '<th style="text-align:center;">Loc</th>';

echo '<th style="text-align:center;">Time</th>';
echo '<th style="text-align:center;">Status</th>';
echo '<th style="text-align:center;">Status-msg</th>';
echo '</tr>';
echo '</thead>';

		echo "\n<tbody>\n";
$row = 1;
$filename = 'files/'.$id.'mm.csv';
$handle = @fopen($filename, "r");
//var_dump($handle);
if ($handle !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$error= "";
 //       $numCol = count($data);
		echo "<tr>";
		if ($data[9]!=="PASS") $error.='error';
		 switch($error) {
                                case "error":
                                    echo '<td class="error" style="text-align:center;">'.$data[0].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[1].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[2].'</td>';
                                    echo '<td class="error">'.$data[3].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[4].'</td>';
                                //    echo '<td class="error" style="text-align:center;">'.$data[5].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[6].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[7].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[8].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[9].'</td>';
                                    echo '<td class="error" style="text-align:center;">'.$data[10].'</td>';
                                    break;
                                default:
                                    echo '<td >'.$data[0].'</td>';
                                    echo '<td style="text-align:center;">'.$data[1].'</td>';
                                    echo '<td style="text-align:center;">'.$data[2].'</td>';
                                    echo '<td style="text-align:center;">'.$data[3].'</td>';
                                    echo '<td style="text-align:center;">'.$data[4].'</td>';
                                  //  echo '<td style="text-align:center;">'.$data[5].'</td>';
                                    echo '<td style="text-align:center;">'.$data[6].'</td>';
                                    echo '<td style="text-align:center;">'.$data[7].'</td>';
                                    echo '<td style="text-align:center;">'.$data[8].'</td>';
                                    echo '<td style="text-align:center;">'.$data[9].'</td>';
                                    echo '<td style="text-align:center;">'.$data[10].'</td>';
									
									
                           

        }
		 echo "</tr>\n";
    }
    fclose($handle);
echo "\n</tbody></table>";
}
else {
	echo "\n<br><em>Δεδομένα θα εμφανιστούν εφόσον ξεκινήσετε το σκανάρισμα των barcodes</em>";
}
	echo '</div>';
	echo '<div>';
if (file_exists('files/'.$id.'mm.csv')){
	echo '<div class = "pull-center">';
	echo '<form action="preparefile.php" method="post">';
	echo '<input type="submit" class="btn btn-outline-warning btn-block" name="fid" value="P r e p a r e&nbsp;&nbsp;&nbsp;&nbsp;F i l e " >';
	echo '</form>';
	echo '</div>';
	}
else {
	echo '<div class = "pull-right">';
	echo '<button type="button" class="btn btn-secondary" disabled>Prepare file</button>';
	echo '</div>';
	echo '</div>';
	}

?>

</section>

<?php

//----functions area

// idea found in github (Georgetown-University-Libraries/BarcodeInventory)->adopted and rewritten for ntua library needs
function showPReport($ubarcode, $colId) {  

//include "apiconstants.php"; --statheres gia to api apo jamesmatias/api-code-examples
//include_once "config.php"; --config gia sierra
include_once "getToken.php"; //get Token file apo jamesmatias/api-code-examples on github

$status = "PASS"; //PASS, PULL, FAIL
$status_msg = "User Found.";
$hl="XX";//location code in sierra
$tstamp = 0;
$token = null ;
$token1 = getToken($token,$tstamp);
$query_string = '{
  "queries": [
    {
      "target": {
        "record": {
          "type": "patron"
        },
        "field": {
          "tag": "b"
        }
      },
      "expr": [
        {
          "op": "equals",
          "operands": [
            "' . $ubarcode . '"
          ]
        }
      ]
    }
  ]
}' ;
//$itemnos
//var_dump($query_string);

//uri that is unique to Sierra -> do query
  $uri = 'https://';
  $uri .= appServer;
  $uri .= '....../sierra-api/v'; //link to api server
  $uri .= apiVer;
  $uri .= '/.../query';//'/path2/query';
  $uri .= '?offset=' . resultOffset;
  $uri .= '&limit=' . numberOfResults; //use to limit the results
  

//build the headers - post json to the api
$headers = array(
			'Content-Type: application/json',
			'Content-Length: '.strlen($query_string),
			'Host: '.$hosturl,
			'Authorization: Bearer '.$token1,
			'User-Agent: '.$appname,
			'X-Forwarded-For: '.$webserver
);
// query the api
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//get the result 
$result = curl_exec($ch);
//var_dump($result);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$patronIdArray = json_decode($result, true);
//var_dump($patronIdArray);

//check για fail 
//	if ( $httpcode < 199 || $httpcode > 201 ) {
		//$resdata = "Αδυναμία σύνδεσης";
//	    echo  $resdata;


	if ($httpcode < 199 || $httpcode > 201 ) {
		$timestbef = new DateTime();
        $timest = $timestbef->format('Y-m-d H:i:s');
	    $resdata["sheetrow"] = $colId ;
	    $resdata["barcode"] = substr(md5(microtime()),rand(0,26),12);
	    $resdata["NAME"] = "**";
	    $resdata["Exp-Date"] = "**";
	    $resdata["E-mail"] = "**";
	    $resdata["phone1"] = "**";
	    $resdata["phone2"] = "***";
	    $resdata["library"] = "**";
	    $resdata["timestamp"] = $timest;
	    $resdata["status"] = "FAIL";
	    $resdata["status_msg"] = "* No connection available. Try later *";

	    return $resdata;

	 }
	 else {
		 $patronIdArray1 = $patronIdArray["entries"];
		 $dataBack = $patronIdArray["total"];
//print_r ($patronIdArray1);
		if ($dataBack == 0) {
//			echo "no barcode";
			$timestbef = new DateTime();
			$timest = $timestbef->format('Y-m-d H:i:s');
			$resdata["sheetrow"] = $colId;
			$resdata["barcode"] = $ubarcode;
			$resdata["NAME"] = "no name";
			$resdata["Exp-Date"] = "**";
			$resdata["E-mail"] = "**";
			$resdata["phone1"] = "--";
			$resdata["phone2"] = "--";
			$resdata["library"] = "--";
			$resdata["timestamp"] = $timest;
			$resdata["status"] = "FAIL";
			$resdata["status_msg"] = "Barcode does not exist in db";

			return $resdata;
		}
		else 
		{
			foreach ($patronIdArray1 as $thisId){
				$data = stripped($thisId['link']);
}
//echo "--->" . $data;


$getItemsUrl = $apiurl."patrons/?limit=2000&offset=0&id=" . $data . "&fields=put fields here";
//e.g. barcodes%2Cnames etc do according to the following foreach"es"... 
	$ch1 = curl_init($getItemsUrl);
	curl_setopt_array($ch1,array(
			CURLOPT_HTTPGET => TRUE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
					'Host: '.$hosturl,
					'Authorization: Bearer '.$token1,
					'User-Agent: '.$appname,
					'X-Forwarded-For: '.$webserver
			)
	));

	// Execute  GET 
	$response1 = curl_exec($ch1);
	$httpcode = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
	curl_close($ch1);
	$patronData1 = json_decode($response1, true);
//	var_dump ($response1);
//	var_dump ($patronData1);
	

	$howmanyb = $patronData1['entries'];	
//	var_dump ($howmanyb);	

	foreach ($howmanyb as $a) {

    $patronID = $a['id'];
//	echo $patronID;
    $authNames = $a['names'];
	foreach ($authNames as $authName){
		//echo $authName ."<br>";		
	}

    $uexpdate = $a['expirationDate'];
		//echo $uexpdate ."--";		
    $homelib = $a['homeLibraryCode'];
		//echo $homelib ."--";			
	

    $authbarcodes = $a['barcodes'];
	foreach ($authbarcodes as $authbarcode){
		//echo $authbarcode ."--";		
	}

    $authemails = $a['emails'];
	foreach ($authemails as $authemail){
	//	echo $authemail."--";		
	}

    $authphones = $a['phones'];
	foreach ($authphones as $authphone){
		$authphone2 = $authphone ['number'];
		$authphone1 = $authphone ['type'];
	//	print $authphone1 .": ";		
		//print $authphone2 ." ";
	}
	}
	

//--- run for errors

        if (trim($hl) != trim($homelib)) {
        $status = ($status == "PASS") ? "PR-LOC" : "PULL-MULT";
        $status_msg .= "Home Library is ".$homelib.". ";             
		}
       
		$timestbef = new DateTime();
        $timest = $timestbef->format('Y-m-d H:i:s');
		$resdata = array(
 	      "sheetrow"         => $colId,
 	      "barcode"          => $authbarcode,
 	      "NAME"    => $authName,
 	      "Exp-Date"      => $uexpdate,
	      "E-mail"            => $authemail,
 	      "phone1"    => $authphone1,
 	      "phone2"    => $authphone2,
 	      "library"    => $homelib,
	      "timestamp"        => $timest,
  	      "status"           => $status,  
  	      "status_msg"       => $status_msg,
 	    );
	//}  
		
	return $resdata;
}
}
}//function

///------------


function csv_to_array($filename)
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000)) !== FALSE)
        {
                $data[] = $row;
        }
        fclose($handle);
    }
    return( $data);
}
	
///------------	

function stripped($fatId) {
    $lastSlash = strrpos($fatId, '/');
    $strippedId = substr($fatId, $lastSlash + 1, strlen($fatId));
    return $strippedId;
}


?>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</div>
<script>
// ---------Responsive-navbar-active-animation-----------
function test(){
  var tabsNewAnim = $('#navbarSupportedContent');
  var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
  var activeItemNewAnim = tabsNewAnim.find('.active');
  var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
  var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
  var itemPosNewAnimTop = activeItemNewAnim.position();
  var itemPosNewAnimLeft = activeItemNewAnim.position();
  $(".hori-selector").css({
    "top":itemPosNewAnimTop.top + "px", 
    "left":itemPosNewAnimLeft.left + "px",
    "height": activeWidthNewAnimHeight + "px",
    "width": activeWidthNewAnimWidth + "px"
  });
  $("#navbarSupportedContent").on("click","li",function(e){
    $('#navbarSupportedContent ul li').removeClass("active");
    $(this).addClass('active');
    var activeWidthNewAnimHeight = $(this).innerHeight();
    var activeWidthNewAnimWidth = $(this).innerWidth();
    var itemPosNewAnimTop = $(this).position();
    var itemPosNewAnimLeft = $(this).position();
    $(".hori-selector").css({
      "top":itemPosNewAnimTop.top + "px", 
      "left":itemPosNewAnimLeft.left + "px",
      "height": activeWidthNewAnimHeight + "px",
      "width": activeWidthNewAnimWidth + "px"
    });
  });
}
$(document).ready(function(){
  setTimeout(function(){ test(); });
});
$(window).on('resize', function(){
  setTimeout(function(){ test(); }, 500);
});
$(".navbar-toggler").click(function(){
  setTimeout(function(){ test(); });
});
</script>

<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
    });
</script>


</body>
</html>