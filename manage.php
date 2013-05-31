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

<form method="post" action="simpan.php">
  <table width="100%"  border="0">
    <tr>
      <td>Username </td>
      <td><input name="user" type="text" value="<?php echo $user; ?>"></td>
    </tr>
    <tr>
      <td>Password </td>
      <td><input name="pass" type="text" value="<?php echo $pass; ?>"></td>
    </tr>
    <tr>
      <td>URL </td>
      <td><input name="domain" type="text" size="3" value="<?php echo $domain; ?>"></td>
    </tr>
	 <tr>
      <td>Amazon Associate ID </td>
      <td><input name="amazonAssociateTag" type="text" size="3" value="<?php echo $amazonAssociateTag; ?>"></td>
    </tr>
    <tr>
      <td>Amazon Access Key </td>
      <td><input name="amazonAWSAccessKeyId" type="text" value="<?php echo $amazonAWSAccessKeyId; ?>"></td>
    </tr>
	 <tr>
      <td>Amazon Secret Key </td>
      <td><input name="amazonSecretAccessKey" type="text" value="<?php echo $amazonSecretAccessKey; ?>"></td>
    </tr>
	 <tr>
      <td>Store Name </td>
      <td><input name="storeName" type="text" value="<?php echo $storeName; ?>"></td>
    </tr>
	 <tr>
      <td>Store Desc </td>
      <td><input name="storeDesc" type="text" value="<?php echo $storeDesc; ?>"></td>
    </tr>
	 <tr>
      <td>Viglink API (Optional) </td>
      <td><input name="viglink_api" type="text" value="<?php echo $viglink_api; ?>"></td>
    </tr>
	 <tr>
      <td valign="top">Header Banner (Optional) </td>
      <td><textarea name="banner" style="width:300px; height:200px;"><?php echo $banner; ?></textarea></td>
    </tr>
	 <tr>
      <td valign="top">Footer </td>
      <td><textarea name="footer" style="width:300px; height:200px;"><?php echo $footer; ?></textarea></td>
    </tr>
	


   



      <td>&nbsp;</td>
      <td><input class="btn" type="submit" name="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
</div>
</div>
</div>


	
  </body>
</html>

