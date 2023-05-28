<?php
require_once('../inc/config.php');
$gameid = $_GET['gameid'];
$q = $conn->prepare("UPDATE games SET `players` = `players` - '1' WHERE id=:id");
$q->bindParam(':id', $gameid);
$q->execute();
?>