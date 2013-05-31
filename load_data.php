<?php
include('lib.php');
include('info.php');
?>
<div class="span3" style="margin-left:0px; margin-bottom:20px;">
<h1><?php echo $storeName; ?></h1>
<p><?php echo $storeDesc;?></p>
</div>
<div class="span8" style="float:left; overflow:hidden; text-align:right; margin-bottom:20px; width:665px">
<?php echo $banner; ?>
</div>
<div style="clear:both;"></div>
<?php
include('menu.php');

$txt_file    = file_get_contents('data.txt');
$arr         = explode(",", $txt_file);
$selected = array();  
 // Per page
$page = $_GET['page'];
$cur_page = $page;
$perpage = 10;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
  
// Count your array values
$count = count($arr)-1;
  
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
<?php  
// Show all the selected values
$no=1;
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
}
else
{		    
	$item = $xml->Items->Item;  	
	$item_asin = $item[0]->ASIN;
	$item_url = "http://www.amazon.com/gp/product/$asin/?tag=$amazonAssociateTag";
	$medium_image = $item[0]->MediumImage->URL;
	$large_image = $item[0]->LargeImage->URL;  

	$title = $item[0]->ItemAttributes->Title;
	
	$item_color = $item[0]->ItemAttributes->Color;
	$item_unit = $item[0]->OfferSummary->TotalNew;
	$item_brand = $item[0]->ItemAttributes->Brand;
	$item_binding = $item[0]->ItemAttributes->Binding;
	$item_warranty= $item[0]->ItemAttributes->Warranty;
	$item_node = $item[0]->BrowseNodes->BrowseNode->BrowseNodeId;
	
	if (empty($item_brand))
	{
		$link_node= "";
	}
	else
	{
		$link_node = 'Vendor : <strong>'.$item_brand.'</strong>';
	}
		
	//featured  
	$item_feat = $item[0]->ItemAttributes->Feature[0];  
	$item_feat1 = $item[0]->ItemAttributes->Feature[1];  
	$item_feat2 = $item[0]->ItemAttributes->Feature[2];  
	$item_feat3 = $item[0]->ItemAttributes->Feature[3];  
	$item_feat4 = $item[0]->ItemAttributes->Feature[4]; 
	
	if(!empty($item[0]->Offers->Offer->OfferListing->Availability))
	{
		$item_avail = $item[0]->Offers->Offer->OfferListing->Availability;  
	}
	$item_cust = $item[0]->CustomerReviews->IFrameURL;  
	
	if(!empty($item[0]->EditorialReviews->EditorialReview->Content))
	{
	$item_edit = $item[0]->EditorialReviews->EditorialReview->Content;  
	}
	
	if(!empty($item[0]->EditorialReviews->EditorialReview[1]->Content))
	{
		$item_edit1	= $item[0]->EditorialReviews->EditorialReview[1]->Content; 
	}
	
	if(!empty($item[0]->SimilarProducts->SimilarProduct[0]->ASIN))
	{
		$item_sim = $item[0]->SimilarProducts->SimilarProduct[0]->ASIN;  
	}
	if(!empty($item[0]->SimilarProducts->SimilarProduct[1]->ASIN))
	{
		$item_sim1 = $item[0]->SimilarProducts->SimilarProduct[1]->ASIN;      
	}
	
	
	
	$item_lists = $item[0]->ItemAttributes->ListPrice->FormattedPrice;
	$item_list = "<span class='disc'>".$item_lists."</span>";
	
	
	if(!empty($item[0]->OfferSummary->LowestNewPrice->FormattedPrice))
	{
			
		$item_low_price = $item[0]->OfferSummary->LowestNewPrice->FormattedPrice; 
			
	}
	if(!empty($item[0]->Offers->Offer->OfferListing->Price->FormattedPrice))
	{
		$item_price = $item[0]->Offers->Offer->OfferListing->Price->FormattedPrice;
	}
	 
	if ($item_color='') 
	{ 
		$konten = ''.$link_node.' <br> Color Option : '.strtolower($item_color).''; 
	} 
	else 
	{ 
		$konten = $link_node; 
	}
	
	if ($item_unit>1) 
	{ 
	$konten1 = '<br><font color="green"><strong>Only '.$item_unit.' left in stock</strong></font>.
	<br>Price : '.$item_list.' <strong>'.$item_price.'</strong> <br><small>('.strtolower($item_avail).')</small>'; 
	} 
	if ($item_unit<1) 
	{ 
		$konten1 = '<br><font color="red"><strong>This awesome product currently in stocks</strong></font>
		<br>See pricing information on amazon'; 
	}
	else{
	$konten1 = '<br><font color="green"><strong>Only '.$item_unit.' left in stock</strong></font>.
	<br>Price : '.$item_list.' <strong>'.$item_price.'</strong> <br><small>('.strtolower($item_avail).')</small>'; 
	}
	  
if ($item_warranty!='') { 
	$garansi = $item_brand.' give '.strtolower($item_warranty); 
} else { 
	$garansi = 'Currently no specific warranty for this products'; 
}  
$feat = $item_feat.'<br>'.$item_feat1.'<br>'.$item_feat2.'<br>'.$item_feat3.'<br>'.$item_feat4;    

if(!empty($item[0]->EditorialReviews->EditorialReview->Content))
{ 
	$keterangan = substr(strip_tags($item_edit), 0, 600); 
} 
else { 
	$keterangan = 'Currently no descriptions for this product and will be added soon.'; 
}  
$review = $item_cust;  
$beli = $item_url; 
	
?>

<!--<div class="row">-->


<div class="span6" <?php if ($no%2==1){ echo 'style="margin-right:10px;"'; } ?>>
<div class="span2">
<a data-toggle="modal" href="#larger-<?php echo $item_asin; ?>"><img src="<?php echo $medium_image;?>" title="&laquo; Click to Enlarge &raquo;"></a>
</div>
<div class="span3">
  <h2><a href="http://<?php echo $domain."/category/featured/".SEO($title)."-asin-".$asin.".html"; ?>"><?php echo $title; ?></a></h2>
  <p><?php echo $konten. ' '.$konten1; ?></p>
  <p><a class="btn btn-warning" href="<?php echo $beli;?>" target="_blank">Buy From Amazon &raquo;</a>
  <a class="btn btn-inverse" href="http://<?php echo $domain."/category/featured/".SEO($title)."-asin-".$asin.".html"; ?>"><font color="white">See Detail &raquo;</font></a></p>
   <?php //echo $url; ?>    
</div>
</div>

<div id="larger-<?php echo $item_asin; ?>" class="modal hide fade">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3><?php echo $title;?></h3>
			</div>
			<div class="modal-body" style="text-aligment: center;">
				<p align="center">
			<img src="<?php echo $large_image;?>"></p>
			</div>
			<div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
</div>


<!--</div>-->
<?php

if ($no%2==0)
{
echo '<div style="clear:both;"></div>';
}

$no++;
}
}
?>
</div>
</div>

<?php
/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
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

/* ----------------------------------------------------------------------------------------------------------- */
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

?>