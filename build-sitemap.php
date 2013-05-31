<?php 
include "cek.php"; 
include('lib.php'); 
include('info.php'); 
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

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
		



<script type="text/javascript">
        (function() {
            $("[rel=popover]").popover();
        })();
    </script>

</head>
<body>
<?php if (!empty($_GET['target'])) { ?>
        <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                    $('#loading').html("<div id='loadings'></div><div id='image'><img src='images/loading.gif'/><br><b>Generate Sitemap</b><br>please wait....</div>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "GET",
                        url: "build_sitemap.php",
                        data: "target=<?php echo $_GET['target']; ?>&page="+page,
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
						
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
        </script>

	<div id="loading"></div>
	<div class="container" id="container">

		
		<div class="data"></div>
		
        <div class="pagination"></div>
	  
      </div>
<?php } 
else { ?>
<div class="container" id="container">
<div class="hero-unit" style="background-color:white; width:800px; margin:0 auto; padding:20px;"> 
<div style="padding:10px">
<a href="manage.php">Config</a> | <a href="submit.php">Submit ASIN</a> | <a href="">XML Builder</a> | <a href="login.php">Logout</a>
<hr>
<p>
See your sitemap <a href="sitemap.xml" target="_blank">here</a><br>
Delete All URL  <a href="hapus_sitemap.php" target="_blank">here</a>
</p>
<hr>
	<form action="build-sitemap.php" method="get">
	<table width="100%" border="0">
	  <!--<tr>
		<td valign="top" style="padding-top:5px;">Generate URL per page</td>
		<td>&nbsp;</td>
		<td><input type="text" name="perpage" value="100"  /></td>
	  </tr>-->
	  <tr>
		<td valign="top" style="padding-top:5px;"> Sitemap for </td>
		<td>&nbsp;</td>
		<td>
		<select name="target">
		<option value="data.txt">Featured Product</option>
		<?php
					$folder="asin";
					$dir=opendir($folder); //membuka folder
					$no=1;
					while($file=readdir($dir)){    
					if ($file=="." or $file=="..")continue;
					
					$cat = str_replace(".txt","",$file);
					$cats = str_replace("-"," ",$cat);
					$cate = ucwords($cats);
					
					echo "<option value=".$cat.">$cate</option></li>";
					$no++;
					}
					closedir($dir);
					  ?>
		</select>
		</td>
	  </tr>
	  <tr>
		<td colspan="3"><input class="btn btn-inverse" type="submit" value="Generate Sitemap" /></td>
	  </tr>
	</table>
	</form>
	</div>
	</div>
	</div>
<?php } ?>		
  </body>
</html>