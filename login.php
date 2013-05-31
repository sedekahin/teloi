<?php include('info.php');
session_start();

// menghapus session username
unset($_SESSION['username']);
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $storeName;?>: <?php echo $storeDesc;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="robots" content="no-index, no-follow">

    <!-- Le styles -->
    <link href="assets/bootstrap-combined.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">   


</head>
<body>
<div class="container" id="container">
<div class="hero-unit" style="background-color:white; width:320px; margin:0 auto; padding:20px;"> 
<div style="padding:10px">
<h2>Admin Login</h2>
<hr>
<form method="post" action="loginsubmit.php">
  <table border="0" width="200">
    <tr>
      <td style="padding-right:20px;">Username</td>
      <td style="padding-right:20px;"><input name="username" type="text"></td>
    </tr>
    <tr>
      <td>Password </td>
      <td><input name="pass" type="password"></td>
    </tr>
    <tr>
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
