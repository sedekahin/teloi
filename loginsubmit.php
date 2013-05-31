<?php
ob_start();
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
<div class="hero-unit" style="background-color:white; width:600px; margin:0 auto; padding:20px;"> 


<div style="padding:10px">
<?php
if (!empty($_POST['username'])&&!empty($_POST['pass']))
{
session_start();
// mengecek ada tidaknya session untuk username

$username = $_POST['username'];
$password = $_POST['pass'];

if (($password == $pass)&&($username == $user))
{
    // jika sesuai, maka buat session untuk username
    $_SESSION['username'] = $username;

	echo '<h2>Admin Menu</h2><hr>
	<a href="manage.php">Config</a> <br> <a href="submit.php">Submit ASIN</a> <br> <a href="build-sitemap.php">XML Builder</a> <br> <a href="login.php">Logout</a>';
}
else echo "<h2>Login Failed <br><a href='login.php'>back</a></h2>";
}
else
{
echo "harus login";
}
?>	

</div>
</div>
</div>


	
  </body>
</html>


