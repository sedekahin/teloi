<?php 
include "cek.php"; 
include('info.php'); 
?> 
<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <title><?php echo $storeName;?>: <?php echo $storeDesc;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="robots" content="index, follow">
    <meta name="description" content="">

    <!-- Le styles -->
    <link href="assets/bootstrap-combined.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">   

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 

</head>
<body>
<div class="container" id="container">
<div class="hero-unit" style="background-color:white; width:800px; margin:0 auto; padding:20px;"> 
<div style="padding:10px">
<a href="manage.php">Config</a> | <a href="submit.php">Submit ASIN</a> | <a href="build-sitemap.php">XML Builder</a> | <a href="login.php">Logout</a>
<hr>
<p>
See your sitemap <a href="sitemap.xml" target="_blank">here</a><br>
Delete All URL  <a href="hapus_sitemap.php">here</a>
</p>
<hr>

<?php
// set file to read
$filename = "sitemap.txt";

$newdata = ' ';

// open file
$fw = fopen($filename, 'w') or die('Could not open file!');
// write to file
// added stripslashes to $newdata
$fb = fwrite($fw,stripslashes($newdata)) or die('Could not write to file');

echo "<font color=red>All URL deleted.</font> <a href='build-sitemap.php'>Create new sitemap</a>";
// close file
fclose($fw);

?>

	</div>
	</div>
	</div>	
  </body>
</html>
