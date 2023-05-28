<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
header('Content-Type:text/plain');
$id = (int)$_GET["game"];
$stmt = $conn->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

?>
Port = <?php if(isset($_GET['port'])) {echo (int)$_GET['port'];} else {echo 53640;} ?> 
Server =  game:GetService("NetworkServer") 
HostService = game:GetService("RunService")Server:Start(Port,20) 
game:GetService("RunService"):Run() 
print("Rowritten server started!") 
function onJoined(NewPlayer) 
print("New player found: "..NewPlayer.Name.."")
NewPlayer:LoadCharacter(true) 
while wait() do 
if NewPlayer.Character.Humanoid.Health == 0 then
wait(5) 
NewPlayer:LoadCharacter(true)
elseif NewPlayer.Character.Parent  == nil then 
wait(5) 
NewPlayer:LoadCharacter(true)
end 
end 
end 
game.Players.PlayerAdded:connect(onJoined) 
game.Players.PlayerAdded:connect(function(PlayerAdded)

game:httpGet("http://madblxx.ga/api/addplayer?gameid=<?php echo $id;?>")

end)
game.Players.PlayerRemoving:connect(function(PlayerRemoved)

game:httpGet("http://madblxx.ga/api/removeplayer?gameid=<?php echo $id;?>")

end)


