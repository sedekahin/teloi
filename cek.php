<?php

session_start();

// mengecek ada tidaknya session untuk username
if (!isset($_SESSION['username']))
{
	echo "<h1>Forbidden!</h1>";
	exit;
}

?>
