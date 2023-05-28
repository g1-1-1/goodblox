<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/config.php");
if ($isloggedin !== 'yes') {
    header('location: /');
}

$sql = "DELETE FROM `wearing` WHERE `wearing`.`itemid` = :itemid AND `userid` = :userid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':itemid', $_GET["id"], PDO::PARAM_INT);
$stmt->bindParam(':userid', $_USER["id"], PDO::PARAM_INT);
$stmt->execute();

header("location: ../api/render.php");

?>
