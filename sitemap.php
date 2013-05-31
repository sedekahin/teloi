<?php
function full_url()
{
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
$uri = $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
$segments = explode('?', $uri, 2);
$url = $segments[0];
$url2 = str_replace("/sitemap.xml","",$url);
return $url2;
}
header("Content-Type: text/xml;charset=iso-8859-1");
echo '<?xml version="1.0" encoding="utf-8"?>'."\n"; 
echo '<?xml-stylesheet type="text/xsl" href="xml-sitemap.xsl"?>'."\n"; 
?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php

	echo '<url>';
	echo' <loc>'.full_url().'/</loc>'; // sesuaikan dengan tabel artikel Anda
	echo ' <priority>0.5</priority>';
	echo ' <lastmod>'.date("Y").'-'.date("m-d").'</lastmod>';
	echo ' <changefreq>weekly</changefreq>';
	echo '</url>';

	echo '<url>';
	echo' <loc>'.full_url().'/category</loc>'; // sesuaikan dengan tabel artikel Anda
	echo ' <priority>0.5</priority>';
	echo ' <lastmod>'.date("Y").'-'.date("m-d").'</lastmod>';
	echo ' <changefreq>weekly</changefreq>';
	echo '</url>';

	$dir=opendir("asin"); //membuka folder
    while($file=readdir($dir))
	{    
	if ($file=="." or $file=="..")continue;
    
	$cat = str_replace(".txt","",$file);
	echo '<url>';
	echo' <loc>'.full_url().'/category-'.$cat.'</loc>'; // sesuaikan dengan tabel artikel Anda
	echo ' <priority>0.5</priority>';
	echo ' <lastmod>'.date("Y").'-'.date("m-d").'</lastmod>';
	echo ' <changefreq>weekly</changefreq>';
	echo '</url>';
    }
	closedir($dir);



$txt_file    = file_get_contents('sitemap.txt');
$arr         = explode(",", $txt_file);
foreach ($arr as $as)
{
	if (!empty($as))
	{
	echo '<url>';
	echo' <loc>'.$as.'</loc>'; // sesuaikan dengan tabel artikel Anda
	echo ' <priority>0.5</priority>';
	echo ' <lastmod>'.date("Y").'-'.date("m-d").'</lastmod>';
	echo ' <changefreq>weekly</changefreq>';
	echo '</url>';
	}
}
echo '</urlset>';?>
