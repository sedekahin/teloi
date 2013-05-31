<?php
if (!empty($_GET['asin'])&&!empty($_GET['cat']))
{
$asin = $_GET['asin'];
$cat = $_GET['cat'];
$cats = str_replace("-"," ",$cat);
$cate = ucwords($cats);

$opr = 'Lookup';
include('lib.php');
include('info.php');
include('function.php');


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?> | <?php echo $storeName;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?php echo $title;?>,<?php echo $storeDesc;?>">

    <!-- Le styles -->
    <link href="http://<?php echo $domain; ?>/assets/bootstrap-combined.min.css" rel="stylesheet">
	<link href="http://<?php echo $domain; ?>/style.css" rel="stylesheet">   

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
<script type="text/javascript">
        (function() {
            $("[rel=popover]").popover();
        })();
    </script>

  </head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


    <div class="container">
<div class="span3" style="margin-left:0px; margin-bottom:20px;">
<h2 style="font-size:30px; margin-bottom:10px;"><?php echo $storeName; ?></h2>
<p><?php echo $storeDesc;?></p>
</div>
<div class="span8" style="float:left; overflow:hidden; text-align:right; margin-bottom:20px; width:665px">
<?php echo $banner; ?>
</div>
<div style="clear:both;"></div>
	    <?php include('menu.php');  ?>	 
<?php

$delimiter = '&rsaquo;';
$home = 'Home';

echo '<div xmlns:v="http://rdf.data-vocabulary.org/#">';
echo ' <span typeof="v:Breadcrumb">
<a rel="v:url" property="v:title" href="http://'.$domain.'/home">'.$home.'</a>
</span> ';
echo $delimiter . "<span typeof=\"v:Breadcrumb\">
<a rel=\"v:url\" property=\"v:title\" href=http://$domain/category-$cat >$cate</a>
</span>"; 
echo $delimiter."".$title;
echo '</div>';

?>

      <div class="hero-unit" style="background-color:white;">      
        
      <div style="margin:20px 20px 20px 0px;">
        <div class="span5">
        <a data-toggle="modal" href="#larger"><img src="<?php echo $large_image;?>" title="&laquo; Click to Enlarge &raquo;"></a>
        </div>
        <div class="span4">
		<h1><?php echo $title; ?></h1>
		<hr>
         <p style="font-size:14px; line-height:25px"><?php echo $konten. ' '.$konten1; ?><?php // echo $url; ?></p>
        <p><a class="btn btn-warning btn-large" href="<?php echo $beli;?>" target="_blank"><font color="black">Buy NOW from Amazon &raquo;</font></a></p>
      </div>
     <div style="clear:both;"></div>
	  
	  <div class="row" style="margin-left:20px; margin-top:30px;">
		  <h2>Product Descriptions</h2>
		  <hr>
             <p><?php echo $keterangan;?></p> 
		     <div class="alert alert-success">
		     <a class="close" data-dismiss="alert" href="#">×</a>
		     <h4 class="alert-heading">Warranty:</h4>
		     <p><?php echo $garansi;?></p>
		     </div>
		<h2>Related Product</h2>
		<hr>

    <div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
    <!-- Carousel items -->
    <div class="carousel-inner">
    <div class="active item">
	<?php echo $kontent_sim; ?>
	<?php echo $kontent_sim1; ?>
	</div>
    <div class="item">
	<?php echo $kontent_sim2; ?>
	<?php echo $kontent_sim3; ?>
	</div>
    <div class="item">
	<?php echo $kontent_sim4; ?>
	<?php echo $kontent_sim5; ?>
	</div>

    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>

		
		<hr>
		 <h2>Customer Review</h2>
		  <hr>
		 <p><iframe width="100%" height="400px" frameborder="0" src="<?php echo $review;?>"></iframe></p> 	 
       </div>
	  
<div id="larger" class="modal hide fade">
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
	  
      </div>

	</div>



	
    </div> <!-- /container -->
	<?php include('footer.php');  ?>
<?php
}
?>	
  </body>
</html>