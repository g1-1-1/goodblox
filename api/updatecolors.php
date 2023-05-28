<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/inc/config.php";

$head = $_POST["head"];
$torso = $_POST["torso"];
$larm = $_POST["larm"];
$lleg = $_POST["lleg"];
$rarm = $_POST["rarm"];
$rleg = $_POST["rleg"];
$currentid = $_USER['id'];

$sql = "UPDATE users SET headcolor=:head, torsocolor=:torso, leftarmcolor=:larm, leftlegcolor=:lleg, rightarmcolor=:rarm, rightlegcolor=:rleg WHERE id=:id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':head', $head);
$stmt->bindParam(':torso', $torso);
$stmt->bindParam(':larm', $larm);
$stmt->bindParam(':lleg', $lleg);
$stmt->bindParam(':rarm', $rarm);
$stmt->bindParam(':rleg', $rleg);
$stmt->bindParam(':id', $currentid);

if ($stmt->execute()) {
    echo "<span style='color: green; font-family: verdana'>Successfully updated character</span>";
    echo "<script>window.history.back()</script>";
} else {
    echo "Error: " . $pdo->errorInfo()[2];
}
header("location: render.php");

?>

