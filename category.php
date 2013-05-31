<!DOCTYPE html>
<html lang="en">
<head>
<?php include('lib.php'); ?>
<?php include('info.php'); ?>   
    <meta charset="utf-8">
    <title><?php echo $storeName;?>: <?php echo $storeDesc;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="robots" content="index, follow">
    <meta name="description" content="">

    <!-- Le styles -->
    <link href="http://<?php echo $domain; ?>/assets/bootstrap-combined.min.css" rel="stylesheet">
	<link href="http://<?php echo $domain; ?>/style.css" rel="stylesheet">   

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
		
        <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                    $('#loading').html("<div id='loadings'></div><div id='image'><img src='http://<?php echo $domain; ?>/images/loading.gif'/><br><b>Loading Content....</b></div>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "GET",
                        url: "load_category.php",
                        data: "cat=<?php echo $_GET['cat']; ?>&page="+page,
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



<script type="text/javascript">
        (function() {
            $("[rel=popover]").popover();
        })();
    </script>

</head>
<body>
<div id="loading"></div>
<?php //include('menu.php');  ?>	   

    <div class="container" id="container">

		
		<div class="data"></div>
		
        <div class="pagination"></div>
	  
      </div>


    </div></div>
	<?php include('footer.php');  ?>		
  </body>
</html>