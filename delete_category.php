<?php
include "cek.php"; 
if (!empty($_GET['remove']))
{
	$my_file = $_GET['remove'];
	$cats = str_replace("-"," ",$my_file);
	$cate = ucwords($cats);
	unlink("asin/".$my_file.".txt");
	
	echo "Category : ".$cate." has been removed.<br>
	<a href='submit.php'>back</a>";
}
?>