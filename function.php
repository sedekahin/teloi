<?php

  
if ($opr=='Lookup')	{ 
	$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
	$url .= "&Version=2011-08-01";    
	$url .= "&Operation=ItemLookup";    
	$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
	$url .= "&AssociateTag=".$amazonAssociateTag;    
	$url .= "&ResponseGroup=Large";    
	$url .= "&IncludeReviewsSummary=True";    
	$url .= "&ItemId=".$asin;    
	$url = amazonSign($url,$amazonSecretAccessKey);    
	$xml = simplexml_load_file($url);    
	$item = $xml->Items->Item;  
}
  	
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
	if (!empty($item[0]->BrowseNodes->BrowseNode->BrowseNodeId))
	{
		$item_node = $item[0]->BrowseNodes->BrowseNode->BrowseNodeId;
	}
	else
	{
		$item_node = "";
	}
	
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
	<br>List Price : '.$item_list.' <br>
	Price : <strong>'.$item_price.'</strong> <br><small>('.strtolower($item_avail).')</small>'; 
	} 
	if ($item_unit<1) 
	{ 
		$konten1 = '<br><font color="red"><strong>This awesome product currently in stocks</strong></font>
		<br>See pricing information on amazon'; 
	}
	else{
	$konten1 = '<br><font color="green"><strong>Only '.$item_unit.' left in stock</strong></font>.
	<br>List Price : '.$item_list.' <br>
	Price : <strong>'.$item_price.'</strong> <br><small>('.strtolower($item_avail).')</small>'; 
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


	if (!empty($item[0]->SimilarProducts->SimilarProduct[0]->ASIN))
	{
		$item_sim = $item[0]->SimilarProducts->SimilarProduct[0]->ASIN;
		$judul_sim = $item[0]->SimilarProducts->SimilarProduct[0]->Title;
		
		$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
		$url .= "&Version=2011-08-01";    
		$url .= "&Operation=ItemLookup";    
		$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
		$url .= "&AssociateTag=".$amazonAssociateTag;    
		$url .= "&ResponseGroup=Large";    
		$url .= "&IncludeReviewsSummary=True";    
		$url .= "&ItemId=".$item_sim;    
		$url = amazonSign($url,$amazonSecretAccessKey);    
		$xml = simplexml_load_file($url);    
		$item = $xml->Items->Item;  
	
		$medium_images = $item[0]->SmallImage->URL;
		
		$kontent_sim = '<div class="span5"><div class="span1">
		<a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim).'-asin-'.$item_sim.'.html" class="thumbnail">
		<img src="'.$medium_images.'" title="&laquo; Click to Enlarge &raquo;"></a>
		</div>
		<div class="span3">
		<h2><a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim).'-asin-'.$item_sim.'.html">'.$judul_sim.'</a></h2>
		<br>
  		<a class="btn btn-inverse" href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim).'-asin-'.$item_sim.'.html">
		<font color="white">See Detail &raquo;</font></a>
		
		</p></div></div>';

		
	}
	else
	{
		$kontent_sim = "";
	}


	if (!empty($item[0]->SimilarProducts->SimilarProduct[1]->ASIN))
	{
		$item_sim1 = $item[0]->SimilarProducts->SimilarProduct[1]->ASIN;
		$judul_sim1 = $item[0]->SimilarProducts->SimilarProduct[1]->Title;
		
		$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
		$url .= "&Version=2011-08-01";    
		$url .= "&Operation=ItemLookup";    
		$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
		$url .= "&AssociateTag=".$amazonAssociateTag;    
		$url .= "&ResponseGroup=Large";    
		$url .= "&IncludeReviewsSummary=True";    
		$url .= "&ItemId=".$item_sim1;    
		$url = amazonSign($url,$amazonSecretAccessKey);    
		$xml = simplexml_load_file($url);    
		$item = $xml->Items->Item;  
	
		$medium_images = $item[0]->SmallImage->URL;
		
		$kontent_sim1 = '<div class="span5"><div class="span1">
		<a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim1).'-asin-'.$item_sim1.'.html" class="thumbnail">
		<img src="'.$medium_images.'" title="&laquo; Click to Enlarge &raquo;"></a>
		</div>
		<div class="span3">
		<h2><a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim1).'-asin-'.$item_sim1.'.html">'.$judul_sim1.'</a></h2>
		<br>
  		<a class="btn btn-inverse" href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim1).'-asin-'.$item_sim1.'.html">
		<font color="white">See Detail &raquo;</font></a>
		</p></div></div>';

	}
	else
	{
		$kontent_sim1 = "";
	}

	if (!empty($item[0]->SimilarProducts->SimilarProduct[2]->ASIN))
	{
		$item_sim2 = $item[0]->SimilarProducts->SimilarProduct[2]->ASIN;
		$judul_sim2 = $item[0]->SimilarProducts->SimilarProduct[2]->Title;
		
		$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
		$url .= "&Version=2011-08-01";    
		$url .= "&Operation=ItemLookup";    
		$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
		$url .= "&AssociateTag=".$amazonAssociateTag;    
		$url .= "&ResponseGroup=Large";    
		$url .= "&IncludeReviewsSummary=True";    
		$url .= "&ItemId=".$item_sim2;    
		$url = amazonSign($url,$amazonSecretAccessKey);    
		$xml = simplexml_load_file($url);    
		$item = $xml->Items->Item;  
	
		$medium_images = $item[0]->SmallImage->URL;
		
		$kontent_sim2 = '<div class="span5"><div class="span1">
		<a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim2).'-asin-'.$item_sim2.'.html" class="thumbnail">
		<img src="'.$medium_images.'" title="&laquo; Click to Enlarge &raquo;"></a>
		</div>
		<div class="span3">
		<h2><a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim2).'-asin-'.$item_sim2.'.html">'.$judul_sim2.'</a></h2>
		<br>
  		<a class="btn btn-inverse" href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim2).'-asin-'.$item_sim2.'.html">
		<font color="white">See Detail &raquo;</font></a>
		</p></div></div>';
		
	}
	else
	{
		$kontent_sim2 = "";
	}

	if (!empty($item[0]->SimilarProducts->SimilarProduct[3]->ASIN))
	{
		$item_sim3 = $item[0]->SimilarProducts->SimilarProduct[3]->ASIN;
		$judul_sim3 = $item[0]->SimilarProducts->SimilarProduct[3]->Title;
		
		$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
		$url .= "&Version=2011-08-01";    
		$url .= "&Operation=ItemLookup";    
		$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
		$url .= "&AssociateTag=".$amazonAssociateTag;    
		$url .= "&ResponseGroup=Large";    
		$url .= "&IncludeReviewsSummary=True";    
		$url .= "&ItemId=".$item_sim3;    
		$url = amazonSign($url,$amazonSecretAccessKey);    
		$xml = simplexml_load_file($url);    
		$item = $xml->Items->Item;  
	
		$medium_images = $item[0]->SmallImage->URL;
		
		$kontent_sim3 = '<div class="span5"><div class="span1">
		<a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim3).'-asin-'.$item_sim3.'.html" class="thumbnail">
		<img src="'.$medium_images.'" title="&laquo; Click to Enlarge &raquo;"></a>
		</div>
		<div class="span3">
		<h2><a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim3).'-asin-'.$item_sim3.'.html">'.$judul_sim3.'</a></h2>
		<br>
  		<a class="btn btn-inverse" href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim3).'-asin-'.$item_sim3.'.html">
		<font color="white">See Detail &raquo;</font></a>
		</p></div></div>';

		
	}
	else
	{
		$kontent_sim3 = "";
	}
		
	if (!empty($item[0]->SimilarProducts->SimilarProduct[4]->ASIN))
	{
		$item_sim4 = $item[0]->SimilarProducts->SimilarProduct[4]->ASIN;
		$judul_sim4 = $item[0]->SimilarProducts->SimilarProduct[4]->Title;
		
		$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
		$url .= "&Version=2011-08-01";    
		$url .= "&Operation=ItemLookup";    
		$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
		$url .= "&AssociateTag=".$amazonAssociateTag;    
		$url .= "&ResponseGroup=Large";    
		$url .= "&IncludeReviewsSummary=True";    
		$url .= "&ItemId=".$item_sim4;    
		$url = amazonSign($url,$amazonSecretAccessKey);    
		$xml = simplexml_load_file($url);    
		$item = $xml->Items->Item;  
	
		$medium_images = $item[0]->SmallImage->URL;
		
		$kontent_sim4 = '<div class="span5"><div class="span1">
		<a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim4).'-asin-'.$item_sim4.'.html" class="thumbnail">
		<img src="'.$medium_images.'" title="&laquo; Click to Enlarge &raquo;"></a>
		</div>
		<div class="span3">
		<h2><a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim4).'-asin-'.$item_sim4.'.html">'.$judul_sim4.'</a></h2>
		<br>
  		<a class="btn btn-inverse" href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim4).'-asin-'.$item_sim4.'.html">
		<font color="white">See Detail &raquo;</font></a>
		</p></div></div>';

	}
	else
	{
		$kontent_sim4 = "";
	}
		
	if (!empty($item[0]->SimilarProducts->SimilarProduct[5]->ASIN))
	{
		$item_sim5 = $item[0]->SimilarProducts->SimilarProduct[5]->ASIN;
		$judul_sim5 = $item[0]->SimilarProducts->SimilarProduct[5]->Title;
	
		$url  = "http://webservices.amazon.com/onca/xml?Service=AWSECommerceService";    
		$url .= "&Version=2011-08-01";    
		$url .= "&Operation=ItemLookup";    
		$url .= "&AWSAccessKeyId=".$amazonAWSAccessKeyId;    
		$url .= "&AssociateTag=".$amazonAssociateTag;    
		$url .= "&ResponseGroup=Large";    
		$url .= "&IncludeReviewsSummary=True";    
		$url .= "&ItemId=".$item_sim5;    
		$url = amazonSign($url,$amazonSecretAccessKey);    
		$xml = simplexml_load_file($url);    
		$item = $xml->Items->Item;  
	
		$medium_images = $item[0]->SmallImage->URL;
		
		$kontent_sim5 = '<div class="span5"><div class="span1">
		<a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim5).'-asin-'.$item_sim5.'.html" class="thumbnail">
		<img src="'.$medium_images.'" title="&laquo; Click to Enlarge &raquo;"></a>
		</div>
		<div class="span3">
		<h2><a href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim5).'-asin-'.$item_sim5.'.html">'.$judul_sim5.'</a></h2>
		<br>
  		<a class="btn btn-inverse" href="http://'.$domain.'/category/'.$cat.'/'.SEO($judul_sim5).'-asin-'.$item_sim5.'.html">
		<font color="white">See Detail &raquo;</font></a>
		</p></div></div>';

	}
	else
	{
		$kontent_sim5 = "";
	}
		







function curPageURL() { 
	$pageURL = 'http'; 
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://"; 
	if ($_SERVER["SERVER_PORT"] != "80") {  
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
	} else {  
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
	} 
	return 
	$pageURL;
}
?>