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
<a href="manage.php">Config</a> | <a href="submit.php">Submit ASIN</a> | <a href="">XML Builder</a> | <a href="login.php">Logout</a>
<hr>
<p>
See your sitemap <a href="sitemap.xml" target="_blank">here</a><br>
Delete All URL  <a href="hapus_sitemap.php" target="_blank">here</a><br>
Edit URL  <a href="sitemap.xml" target="_blank">here</a>
</p>
<hr>

<?php
// set file to read
$filename = "sitemap.txt";

if (!empty($_GET['url']))
{
$url = $_GET['url'];

	if (isset($_POST['kirim']))
	{
	$newdata = $_POST['sitemap'];
	
	$fh = fopen($filename, "r") or die("Could not open file!");
	$fw = fopen($filename, 'w') or die('Could not open file!');
	$data = fread($fh, filesize($filename)) or die("Could not read file!");
	
	$arr  = explode(",", $data);
	foreach ($arr as $urls){
		if ($urls=="$url")
		{
			//$fb = fwrite($fw,stripslashes($newdata)) or die('Could not write to file');
			$simpan = file_put_contents($filename, $newdata);
			//echo "$newdata";
		}
	}
	
	fclose($fw);
	echo "$newdata";
	}
	
?>	
<form method= 'post' >
<textarea style="width:100%" name='sitemap' cols='50%' rows='10'><?php echo $url;?></textarea><br>
<input type='submit' value='Change' name="kirim" class="btn">
</form>
<?php

}
else
{
	$fh = fopen($filename, "r") or die("Could not open file!");
	$data = fread($fh, filesize($filename)) or die("Could not read file!");
	$arr  = explode(",", $data);
	fclose($fh);
	echo "<h6>Edit Sitemap</h6>";
	foreach ($arr as $url){echo "$url <a href='edit_sitemap.php?url=$url'>edit</a><br>";}
}
?>

	</div>
	</div>
	</div>	
  </body>
</html>
