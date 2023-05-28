<?php
header("Content-type: text/json");
include "../core/config.php";
include "../core/util_func.php";

if (!isset($_GET['id'])) {
  die('{"Error":"ID not set"}');
}

$id = intval($_GET['id']);

$detailsq = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'") or die('{"Error":"'. mysqli_error($conn) .'"}');
$usr = mysqli_fetch_assoc($detailsq) or die('{"Error":"Invalid ID"}');
$id = $usr['id'];

$avatarq = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'") or die('{"Error":"'. mysqli_error($conn) .'"}');
$details = mysqli_fetch_assoc($avatarq);
$headcolor = RobloxToHex($details['headcolor']);
$torsocolor = RobloxToHex($details['torsocolor']);
$leftarmcolor = RobloxToHex($details['leftarmcolor']);
$rightarmcolor = RobloxToHex($details['rightarmcolor']);
$leftlegcolor = RobloxToHex($details['leftlegcolor']);
$rightlegcolor = RobloxToHex($details['rightlegcolor']);

echo '{"BodyColors":{"head":"'. $headcolor .'","torso":"'. $torsocolor .'","leftarm":"'. $leftarmcolor .'","rightarm":"'. $rightarmcolor .'","leftleg":"'. $leftlegcolor .'","rightleg":"'. $rightlegcolor .'"}'
?>
