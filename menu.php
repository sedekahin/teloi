<?php
$folder="asin";//--> Nama Folder
include('info.php');
?>
<div class="navbar">
      <div class="navbar-inner">
        <div class="container"><div class="span8" style="margin-left:0px;">
          
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
         
		 
		 
          <div class="nav-collapse">
           <ul role="navigation" class="nav">
		      <li><a href="http://<?php echo $domain; ?>/home">Home</a></li>
                    <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="category" id="drop1">Category <b class="caret"></b></a>
                      <ul aria-labelledby="drop1" role="menu" class="dropdown-menu">
					  
					<?php
					$dir=opendir($folder); //membuka folder
					$no=1;
					while($file=readdir($dir)){    
					if ($file=="." or $file=="..")continue;
					
					$cat = str_replace(".txt","",$file);
					$cats = str_replace("-"," ",$cat);
					$cate = ucwords($cats);
					
					echo "<li role='presentation'><a tabindex='-1' role='menuitem' href=http://".$domain."/category-".$cat.">$cate</a></li>";
					$no++;
					}
					closedir($dir);
					  ?>
					 <!-- 
                        <li role="presentation"><a href="http://google.com" tabindex="-1" role="menuitem">Action</a></li>
                        <li role="presentation"><a href="#anotherAction" tabindex="-1" role="menuitem">Another action</a></li>
                        <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Something else here</a></li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Separated link</a></li>
                     --> 
					  </ul>
                    </li>
              <li><a data-toggle="modal" href="#about">About</a></li>
              <li><a data-toggle="modal" href="#privacy">Privacy Policy</a></li>
     
                  </ul>
			
			
			
          </div><!--/.nav-collapse --></div>
        </div>
      </div>
    </div>