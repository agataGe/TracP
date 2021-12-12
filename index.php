<?php
if (!isset($_SESSION)) { session_start(); }
$id = session_id();
//created for ntua library needs Sep2020&updatedFeb2021 -AG4ntua@2020-Agathi G.
// +----------------------------------------------------------------------+
// | PHP Version 7.X - sierra api 5                                                        |
// +----------------------------------------------------------------------+
// | Creative Commons Licence                                |
// +----------------------------------------------------------------------+

$secret_key = hex2bin('put ur secret key here');
?>
<html lang="el">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>NTUA L&amp;IC - Patron:Search-Trace</title> <!-- Τίτλος μέχρι 60 χαρακτήρες -->
  
		<meta name="description" content="Αναζήτηση χρηστών User search-trace"> <!-- Περιγραφή μέχρι 160 χαρακτήρες -->
		<link rel="stylesheet" href="site.css" type="text/css" media="all">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

		</head>

<body>
	<div class="container-fluid">
	<header>
<?php include "////.php"; // menu file here ?>
</header>
<section class="search-block">
    <div class="container">
	<div class="row">
		<div class="col-6 search-sec text-center">
										<br>
		    <h2 class="text-center">Επιλέξτε Βιβλιοθήκη</h2>
						<form action="patron.php?psearch=" method="get">

								<br>
								
								<label for="orgs" class="text-uppercase" >Library</label>
								<select name="psearch" id="orgs" style="margin-left: 13%">
									<option value="<?php $a10="XXXXX"; echo urlencode(openssl_encrypt($a10,"AES-128-ECB",$secret_key));?>">Lib1</option>
									<option value="<?php $a10="XXXXX"; echo urlencode(openssl_encrypt($a10,"AES-128-ECB",$secret_key));?>">Lib2</option>
									<option value="<?php $a10="XXXXX"; echo urlencode(openssl_encrypt($a10,"AES-128-ECB",$secret_key));?>">Lib3</option>
								</select>
								<br>
								<br>
								<br>
								
								
								<input type="submit" class="btn btn-info btn-block" value = "&nbsp;&nbsp;S u b m i t&nbsp;&nbsp;" name="submit" style="" >
	
						</form>
		</div>
		<div class="col-6 bann">
		 <img src="image/20200619_144030.jpg" >
	</div>
</div>
</section>
<div class="text-secondary">
<small>AG4ntua@2020</small>
</div>
</div>
</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script>
// ---------Responsive-navbar-active-animation-found-on-internet-dont remmbr where.. sorry! :( ->if anybody -----------
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
</body>
</html>