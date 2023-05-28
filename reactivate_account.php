<?php
include($_SERVER['DOCUMENT_ROOT']."/inc/config.php");
if($_USER['bantype'] == 'Ban') {header('location: /'); die();}
$unbanq = $conn->prepare("UPDATE `users` SET `bantype` = 'None', `banreason` = '' WHERE `users`.`username` = :username");
$unbanq->bindParam(':username', $_USER["username"], PDO::PARAM_STR);
$unbanq->execute();

header('location: /');
?>
