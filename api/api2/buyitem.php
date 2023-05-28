<?php
header("Content-type: text/plain");
require("../include/conn.php");
require("../include/logged_in.php");
require("../include/util_func.php");


if (!$isloggedin) {
  die("ERR:loggedout");
}

if (!isset($_GET['id'])) {
  die("ERR:invid");
}

$assetid = intval($_GET['id']);
$assetq = mysqli_query($connect, "SELECT * FROM assets WHERE id='$assetid'") or die("ERR:".mysqli_error($connect));

if (mysqli_num_rows($assetq) < 1) {
  die("ERR:invitem");
}
$asset = mysqli_fetch_assoc($assetq);
$assetcreator = $connect->query("SELECT * FROM users WHERE id='{$asset['creator']}'")->fetch_assoc() or die($connect->error);
$profitpercentage = 0.65;
if ($assetcreator['membership_type'] != "NONE") {
  $profitpercentage = 0.9;
}
if ($asset['type'] == "hat" || $asset['type'] == "tool" || $asset['type'] == "face") {
  $profitpercentage = 1;
}
$profits = floor($asset['price'] * $profitpercentage);
//$asset['currency'] = "Tickets";
$currency = strtolower($asset['currency']);

if ($asset['is_limited'] == 1) {
  if ($asset['sales'] >= $asset['total_stock']) {
    die("ERR:soldout");
  }
}

if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM owneditems WHERE assetid='$assetid' AND userid='$CURRENT_USER_ID'")) > 0) {
  die("ERR:alreadyowned");
} else {
  if ($asset['price'] < 0) {
    die("ERR:offsale");
  } else {
    if ($_USER[$currency] < $asset['price']) {
      die("ERR:nofunds");
    } else if ($asset['onsale_until'] < time() && $asset['onsale_until'] != 0) {
      die("ERR:offsale");
    } else {
      $update_funds = mysqli_query($connect, "UPDATE users SET `$currency` = `$currency` - '". $asset['price'] ."' WHERE id='$CURRENT_USER_ID'") or die(mysqli_error($connect));
      $update_funds_creator = mysqli_query($connect, "UPDATE users SET `$currency` = `$currency` + '". $profits ."' WHERE id='". $asset['creator'] ."'") or die(mysqli_error($connect));


      $lastq = mysqli_query($connect, "SELECT * FROM owneditems WHERE assetid='$assetid' ORDER BY id DESC") or die(mysqli_error($connect));
      $serial = 1;
      if (mysqli_num_rows($lastq) > 0) {
        $last = mysqli_fetch_assoc($lastq);

        $serial = $last['serial'] + 1;
      }

      $add_to_inv = mysqli_query($connect, "INSERT INTO `owneditems`(`id`, `assetid`, `userid`, `type`, `serial`) VALUES (NULL,'$assetid','$CURRENT_USER_ID','". $asset['type'] ."', '$serial')") or die(mysqli_error($connect));
      $incr_sales = mysqli_query($connect, "UPDATE assets SET `sales` = `sales` + '1' WHERE id='{$asset['id']}'") or die(mysqli_error($connect));
    }
  }
}

die("success");
?>
