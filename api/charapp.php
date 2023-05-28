<?php
require_once($_SERVER['DOCUMENT_ROOT']."/inc/config.php");

$id = (int)$_GET["id"];
$echothing = "";
$sql = "SELECT * FROM wearing WHERE userid=:id;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();

if (count($result) > 0) {
    foreach ($result as $row) {
        $itemq = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid");
        $itemq->bindValue(':itemid', $row['itemid'], PDO::PARAM_INT);
        $itemq->execute();
        $item = $itemq->fetch(PDO::FETCH_ASSOC);
        $echothing = $echothing . "http://madblxx.gq/asset?id=" . $item['assetid'] . ";";
    }
}
$echothing = $echothing . "http://madblxx.gq/asset/BodyColors.ashx?userId=" . $id;
echo $echothing;
?>
