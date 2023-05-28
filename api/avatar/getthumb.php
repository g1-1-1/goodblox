<?php
require_once($_SERVER['DOCUMENT_ROOT']."/inc/config.php");
$id = (int) addslashes($_GET["id"]);
$userl = $conn->query("SELECT * FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
echo '<img src="data:image/gif;base64,' . $userl['thumbnail'] . '" width="170" height="170" / >';
?>
