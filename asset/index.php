<?php
  header('location: https://assetdelivery.roblox.com/v1/asset/?'.$_SERVER["QUERY_STRING"]);
  exit;
$id = (int)$_GET["id"];
if(file_exists(__DIR__."/assets/".$id.".php")) {
  // file exists REAL
  echo base64_decode(file_get_contents(__DIR__."/assets/".$id.".php"));
} else {
  $a = curl_init('https://assetdelivery.roblox.com/v1/asset/?'.$_SERVER["QUERY_STRING"]);
  curl_setopt($a, CURLOPT_RETURNTRANSFER, true);
  $result = base64_encode(str_replace('roblox.com','madblxx.ga',curl_exec($a)));
  //die(base64_decode($result));
  echo base64_decode($result);
  file_put_contents(__DIR__."/assets/".$id.".php", $result);
  exit;
}