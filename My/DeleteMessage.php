<?php
require_once("../inc/header.php");
require_once("../inc/nav.php");
  
$id = $_GET['ID'];

$stmt = $conn->prepare("SELECT * FROM messages WHERE id = :id");
$stmt->execute(['id' => $id]);
$fpost = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fpost) {
  die("Invalid ID.");
}

if ($fpost['user_to'] != $_USER['id']) {
  die("This message wasn't sent to you.");
}

if ($fpost['readto'] != '0') {
  die("This message was already read.");
}

$stmt = $conn->prepare("UPDATE messages SET readto = 1 WHERE id = :id");
$stmt->execute(['id' => $fpost['id']]);

header('location: /My/Inbox.aspx');

?>