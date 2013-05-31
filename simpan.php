<?php
include "cek.php"; 
// membaca value dari form
$user = $_POST['user'];
$pass = $_POST['pass'];
$amazonAWSAccessKeyId = $_POST['amazonAWSAccessKeyId'];
$amazonSecretAccessKey = $_POST['amazonSecretAccessKey'];
$amazonAssociateTag = $_POST['amazonAssociateTag'];
$storeName = $_POST['storeName'];
$storeDesc = $_POST['storeDesc'];
$domain = $_POST['domain'];
$viglink_api = $_POST['viglink_api'];
$banner = $_POST['banner'];
$footer = $_POST['footer'];

// membuat baris yang akan ditulis ke file config.php
// untuk setiap value misal: $user = "#FFFFFF";

$user = "\$user = \"".$user."\";\n";
$pass = "\$pass = \"".$pass."\";\n";
$amazonAWSAccessKeyId = "\$amazonAWSAccessKeyId = \"".$amazonAWSAccessKeyId."\";\n";
$amazonSecretAccessKey = "\$amazonSecretAccessKey = \"".$amazonSecretAccessKey."\";\n";
$amazonAssociateTag = "\$amazonAssociateTag = \"".$amazonAssociateTag."\";\n";
$storeName = "\$storeName = \"".$storeName."\";\n";
$storeDesc = "\$storeDesc = \"".$storeDesc."\";\n";
$domain = "\$domain = \"".$domain."\";\n";
$viglink_api = "\$viglink_api = \"".$viglink_api."\";\n";
$banner = "\$banner = '$banner';\n";
$footer = "\$footer = '$footer';\n";

// nama file yang akan dibaca

$file = "info.php";

// membaca file dan menyatakan isi file ke dalam array

$arrayRead = file($file);

// mengubah isi setiap elemen array dengan nilai yang baru

$arrayRead[1] = $user;
$arrayRead[2] = $pass;
$arrayRead[3] = $amazonAWSAccessKeyId;
$arrayRead[4] = $amazonSecretAccessKey;
$arrayRead[5] = $amazonAssociateTag;
$arrayRead[6] = $storeName;
$arrayRead[7] = $storeDesc;
$arrayRead[8] = $domain;
$arrayRead[9] = $viglink_api;
$arrayRead[10] = $banner;
$arrayRead[11] = $footer;

// menyimpan kembali isi array yang baru ke file
$simpan = file_put_contents($file, implode($arrayRead));

if ($simpan)  {
      echo "<h2>Update Success <a href='manage.php'>Back</a></h2>";
}
else echo "<h2>Update Failed</h2>";

?>
