<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/config.php");
$id = (int)addslashes($_GET["game"]);
$gameq = mysqli_query($link, "SELECT * FROM games WHERE id = '$id'");
$game = mysqli_fetch_assoc($gameq);
$players = (int)addslashes($_GET["players"]);
mysqli_query($link, "UPDATE games SET players = '$players' WHERE id = '$id'");
?>