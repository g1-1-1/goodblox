<?php
header("Content-type: image/png");
include "../core/conn.php";
include "../core/util_func.php";

$uid = $_GET['id'] ?? 0;
$uid = intval($uid);

$detailsq = mysqli_query($connect, "SELECT * FROM users WHERE id='$uid'") or die('{"Error":"'. mysqli_error($connect) .'"}');

if (mysqli_num_rows($detailsq) < 1) {
  echo file_get_contents("/images/unavail.png");
  die();
}

$us = mysqli_fetch_assoc($detailsq);

echo file_get_contents("/assets/thumbnails/avatars/{$us['avatar_hash']}.png");
?>
