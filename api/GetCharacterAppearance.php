<?php
header("Content-type: text/json");
include "../core/conn.php";
include "../core/util_func.php";

$username = mysqli_real_escape_string($connect, $_GET['username']);

if (startsWith($username, "Guest ")) {
  $username = "DefaultGuest";
}
if (!isset($_GET['username'])) {
  die('{"Error":"ID not set"}');
}

$detailsq = mysqli_query($connect, "SELECT * FROM users WHERE username='$username'") or die('{"Error":"'. mysqli_error($connect) .'"}');
$usr = mysqli_fetch_assoc($detailsq) or die('{"Error":"Invalid ID"}');
$id = $usr['id'];

$avatarq = mysqli_query($connect, "SELECT * FROM avatar_cache WHERE hash='{$usr['avatar_hash']}'") or die('{"Error":"'. mysqli_error($connect) .'"}');
$details = mysqli_fetch_assoc($avatarq);
$headcolor = RobloxToHex($details['head_color']);
$torsocolor = RobloxToHex($details['torso_color']);
$leftarmcolor = RobloxToHex($details['leftarm_color']);
$rightarmcolor = RobloxToHex($details['rightarm_color']);
$leftlegcolor = RobloxToHex($details['leftleg_color']);
$rightlegcolor = RobloxToHex($details['rightleg_color']);

//$headarray = array_search($headcolor, $RobloxColor);
//$torsoarray = array_search($torsocolor, $RobloxColor);
//$leftarmarray = array_search($leftarmcolor, $RobloxColor);
//$rightarmarray = array_search($rightarmcolor, $RobloxColor);
//$leftlegarray = array_search($leftlegcolor, $RobloxColor);
//$rightlegarray = array_search($rightlegcolor, $RobloxColor);

//$hats = explode(".", $details['hats']);

$hatid1 = intval($details['hatid1']);
$hatid2 = intval($details['hatid2']);
$hatid3 = intval($details['hatid3']);

echo '{"BodyColors":{"head":"'. $headcolor .'","torso":"'. $torsocolor .'","leftarm":"'. $leftarmcolor .'","rightarm":"'. $rightarmcolor .'","leftleg":"'. $leftlegcolor .'","rightleg":"'. $rightlegcolor .'"},"Wearables":{"hat1": '. $hatid1 .', "hat2": '. $hatid2 .', "hat3": '. $hatid3 .', "face": '. $details['faceid'] .', "tshirt":'. 0 .',"shirt":'. $details['shirtid'] .',"pants":'. $details['pantsid'] .'}}'
?>
