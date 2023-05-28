<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
header('Content-Type:text/plain');
$id = (int)$_GET["game"];
$stmt = $conn->prepare("SELECT * FROM games WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);
?>
dofile('http://madblxx.ga/join/HostServer.php?port=<?php echo $game['port']; ?>&game=<?php echo $id; ?>') 
game:Load('http://madblxx.ga/join/gui.rbxm') 
game:FindFirstChild("Health-GUI").Parent = game.StarterGui 
