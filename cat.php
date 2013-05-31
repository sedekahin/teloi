<div class="hero-unit" style="background-color:white;"> 
<?php
$folder="asin";//--> Nama Folder

if (!empty($_GET['cat']))
{
	$kat = $_GET['cat'];
    $dir=opendir($folder); //membuka folder
    //$no=1;
    while($file=readdir($dir)){    
	if ($file=="." or $file=="..")continue;
    
	$cat = str_replace(".txt","",$file);
	$cats = str_replace("-"," ",$cat);
	$cate = ucwords($cats);
	
	if ($kat==$cat)
	{
		
		$txt_file    = file_get_contents($folder."/".$file);
		$arr         = explode("\n", $txt_file);
		foreach ($arr as $asin)
		{
		echo $asin."<br>";
		}
		//echo $cate;		
	}
	
	
	//$no++;
    }
	closedir($dir); //menutup folder
}

else
{
	$dir=opendir($folder); //membuka folder
    $no=1;
    while($file=readdir($dir)){    
	if ($file=="." or $file=="..")continue;
    
	$cat = str_replace(".txt","",$file);
	$cats = str_replace("-"," ",$cat);
	$cate = ucwords($cats);
	
	echo "$cate<br />";
	$no++;
    }
	closedir($dir);

}
//echo "----------------------------------------------";
?>
</div>