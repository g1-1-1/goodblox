<?php require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
if($_USER['USER_PERMISSIONS'] !== 'Administrator') {header('location: /');}
include($_SERVER["DOCUMENT_ROOT"]."/inc/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/nav.php");
?>
