<?php
include('lib.php');
include('info.php');

 // Per page
$target = $_GET['target'];
if ($target=="data.txt")
{
	$txt_file    = file_get_contents('data.txt');
	$dir = "featured";
}
else
{
	$txt_file    = file_get_contents('asin/'.$target.".txt");
	$dir = $target;
}
$arr         = explode(",", $txt_file);
$count = count($arr)-1;
$count2 = count($arr);
$selected = array();  
 // Per page
$page = $_GET['page'];
$cur_page = $page;
//$perpage = $_GET['perpage'];
$perpage = $count2;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
  
// Count your array values

  
// Set page
$current_page = (@$_GET['page']) ? (abs($_GET['page']) > ceil((count($arr) / $perpage)) || !is_numeric($_GET['page'])) ? 1 : abs($_GET['page']) : 1;
  
// Settings and calculations
 
$amount_pages = ceil($count / $perpage) + 1;
$show_values_b = ($current_page - 1) * $perpage;
$show_values_e = ($current_page - 1) * $perpage + $perpage;
  
// Loop through the array containing your values
for ($i = 0; $i <= $count; $i++)
{
    // Get values according to pages
    if ($i >= $show_values_b && $i < $show_values_e)
	
        $selected[] = $arr[$i];
		
}
?>
<div class="hero-unit" style="background-color:white;"> 
<div style="margin-left:20px; margin-top:20px; margin-bottom:20px;">
<h1>Sitemap Generator</h1>
<hr />
<a href="manage.php">Config</a> | <a href="submit.php">Submit ASIN</a> | <a href="build-sitemap.php">XML Builder</a> | <a href="login.php">Logout</a>

<hr />

<?php  
// Show all the selected values
foreach ($selected as $asin)
{
    
	$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
	$url .= "&Version=2011-08-01";    
	$url .= "&Operation=ItemLookup";    
	$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
	$url .= "&AssociateTag=".$amazonAssociateTag;    
	$url .= "&ResponseGroup=Large";    
	$url .= "&IncludeReviewsSummary=True";    
	$url .= "&ItemId=".$asin;    
	$url = amazonSign($url,$amazonSecretAccessKey); 
	$xml = @simplexml_load_file($url);

if ($xml === false)
{
	//echo "<font color=red>Can't generate sitemap for this url</font><br>";
}

else
{
	
	if (!empty($xml->Items->Item))
	{    
		$item = $xml->Items->Item;  	
	}
	if (!empty($item[0]->ItemAttributes->Title))
	{
		$title = $item[0]->ItemAttributes->Title;
	}

	$seourl = SEO($title);
	$a = "http://".$domain."/category/".$dir."/".SEO($title)."-asin-".$asin.".html";
	$sitemap = "sitemap.txt";

	$find_sitemap    = file_get_contents($sitemap);
	//$array_sitemap   = explode("\n", $find_sitemap);

	$fh = fopen($sitemap, 'a') or die("can't open file");
	$stringData = $a.",";
	fwrite($fh, $stringData);
	fclose($fh);
	echo "<font color='green'>".$a."----added</font><br>";	
?>

<?php
	}
}
/*	
	$robots = "robots.txt";
	$frobots = fopen($robots, 'a') or die("can't open file");
	$filexml = "\n\n"."Sitemap: http://".$domain."/sitemap.xml"."\n";
	fwrite($frobots, $filexml);
	fclose($frobots);
*/

?>
</div>
</div>

<?php
/* ---------------Calculating the starting and endign values for the loop----------------------------------- 
if ($cur_page >= 10) {
    $start_loop = $cur_page - 5;
    if ($amount_pages > $cur_page + 5)
        $end_loop = $cur_page + 5;
    else if ($cur_page <= $amount_pages && $cur_page > $amount_pages - 9) {
        $start_loop = $amount_pages - 9;
        $end_loop = $amount_pages;
    } else {
        $end_loop = $amount_pages;
    }
} else {
    $start_loop = 1;
    if ($amount_pages > 10)
        $end_loop = 10;
    else
        $end_loop = $amount_pages;
}

/* ----------------------------------------------------------------------------------------------------------- 
echo  "<div class='row'><div class='pagination span8 offset2'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    echo  "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    echo  "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    echo  "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    echo  "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        echo  "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        echo  "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $amount_pages) {
    $nex = $cur_page + 1;
    echo  "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    echo  "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $amount_pages) {
    echo  "<li p='$amount_pages' class='active'>Last</li>";
} else if ($last_btn) {
    echo  "<li p='$amount_pages' class='inactive'>Last</li>";
}
*/
?>