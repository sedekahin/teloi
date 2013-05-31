<?php 
include "cek.php"; 
include "info.php"; 
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


</head>
<body>
<div class="container" id="container">
<div class="hero-unit" style="background-color:white; width:800px; margin:0 auto; padding:20px;"> 
<div style="padding:10px">
<a href="manage.php">Config</a> | <a href="submit.php">Submit ASIN</a> | <a href="build-sitemap.php">XML Builder</a> | <a href="login.php">Logout</a>
<hr>
<h2>Upload ASIN for Featured Product</h2>
<p>File name must : data.txt</p>
<hr />





    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    <input type="file" name="userfile" data-bfi-disabled  /><br />
    <input type="submit" name="kirim" id="button" value="Submit" class="btn" />
    </form>
<hr />
<h2>Upload ASIN for Categories</h2>
<p>File Examle: kitchen-set.txt</p>

    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    <input type="file" name="userfile" data-bfi-disabled /><br />
    <input type="submit" name="submit" id="button" value="Submit" class="btn" />
    </form>

    <?php
    if(isset($_POST['submit']))
	{

	$extensionList = array("txt");
	
	$fileName = $_FILES['userfile']['name'];
	$pecah = explode(".", $fileName);
	$ekstensi = $pecah[1];
	
	$namaDir = 'asin/';
	
	$pathFile = $namaDir . $fileName;
	
	if (in_array($ekstensi, $extensionList))
	{

    	$tmpName  = $_FILES['userfile']['tmp_name'];

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile))
		{
			echo "<font color='green'>Upload success.</font>";
		}
    
		else
		{
			 echo "<font color='red'>Upload failed.</font>";
		}
	}

	else echo "<font color='red'>Unkonwon file extention!</font>";

    }
    ?>
	
<?php
    if(isset($_POST['kirim']))
	{

	$extensionList = "data.txt";
	
	$fileName = $_FILES['userfile']['name'];
	$pecah = explode(".", $fileName);
	$ekstensi = $pecah[1];
	
	
	$namaDir = '';
	
	$pathFile = $namaDir . $fileName;
	
	if ($fileName == $extensionList)
	{

    	$tmpName  = $_FILES['userfile']['tmp_name'];

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile))
		{
			 echo "<font color='green'>Upload success.</font>";
		}
    
		else
		{
			 echo "<font color='red'>Upload failed.</font>";
		}
	}

	else echo "<font color='red'>File should be named : data.txt</font>";

    }
    ?>

<h5>Category List</h5>
<?php
	$dir=opendir("asin"); //membuka folder
    while($file=readdir($dir))
	{    
	if ($file=="." or $file=="..")continue;    
	$cat = str_replace(".txt","",$file);
	$cats = str_replace("-"," ",$cat);
	$cate = ucwords($cats);
	
	echo "<a href='delete_category.php?remove=$cat' title='remove'>x</a> ".$cate."<br>"; // sesuaikan dengan tabel artikel Anda
    }
	closedir($dir);
?>	

</div>
</div>
</div>


	
  </body>
</html>
	