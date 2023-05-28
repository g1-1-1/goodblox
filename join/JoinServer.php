<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
$stmt = $conn->prepare("SELECT * FROM users WHERE accountcode=:accountcode");
$stmt->bindParam(':accountcode', $_GET['accountcode']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM games WHERE id=:id");
$stmt->bindParam(':id', $_GET['placeid'], PDO::PARAM_INT);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("INSERT INTO gamesvisits (gameid, visitorid) VALUES (:gameid, :visitorid)");
$stmt->bindParam(':gameid', $game['id'], PDO::PARAM_INT);
$stmt->bindParam(':visitorid', $user['id'], PDO::PARAM_INT);
$stmt->execute();
$ip = $game['ip'];
$port = $game['port'];
$userid = (int)$user['id'];
$username = $user['username'];
$customerrorenabled = 'no';
$customerror = '';
if(!$user) {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Invalid Account Code.';
}
if($user['bantype'] == 'Reminder') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Reminder on your account.';
    //header("Location: /", true, 403);
} elseif($user['bantype'] == 'Warning') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Warning on your account.';
    //header("Location: /", true, 403);
} elseif($user['bantype'] == 'Ban') {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: Account Banned.';
    //header("Location: /", true, 403);
}
if ($ipbansresultCheck > 0) {
    while ($ipbansrow = mysqli_fetch_assoc($ipbansresult)) {
    $ip = '0.0.0.0';
    $customerrorenabled = 'yes';
    $customerror = 'Connection failed: IP Banned.';
    //header("Location: /", true, 403);
}

}
?>

local server = "<?php echo $ip; ?>" 
local serverport = <?php echo $port; ?> 
local clientport = 0 
local playername = "<?php echo $username; ?>" 
game:SetMessage("<?php if($customerrorenabled == 'yes') {echo $customerror;} ?>") 
function dieerror(errmsg) 
game:SetMessage(errmsg) 
wait(math.huge) 
end 
local suc, err = pcall(function() 
client = game:GetService("NetworkClient") 
local player = game:GetService("Players"):CreateLocalPlayer(0) 
player:SetSuperSafeChat(false) 
pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble) end) 
game:GetService("Visit") 
player.Name = playername 
player.userId = <?php echo $userid; ?> 
game:ClearMessage() 
end) 
if not suc then 
dieerror(err) 
end 
function connected(url, replicator) 
local suc, err = pcall(function() 
local marker = replicator:SendMarker() 
end) 
if not suc then 
dieerror(err) 
end 
marker.Recieved:wait() 
local suc, err = pcall(function() 
game:ClearMessage() 
end) 
if not suc then 
dieerror(err) 
end 
end 
function rejected() 
dieerror("<?php if($customerrorenabled == 'yes') {echo $customerror;} else {echo 'Connection failed: Rejected by server.';} ?>") 
end 
function failed(peer, errcode, why) 
dieerror("<?php if($customerrorenabled == 'yes') {echo $customerror.'"';} else {echo 'Failed [".. peer.. "], ".. errcode.. ": ".. why';} ?>) 
end 
local suc, err = pcall(function() 
client.ConnectionAccepted:connect(connected) 
client.ConnectionRejected:connect(rejected) 
client.ConnectionFailed:connect(failed) 
client:Connect(server, serverport, clientport, 20) 
local funeeplayr = game.Players:FindFirstChild("<?php echo $username; ?>") 
--funeeplayr.CharacterAppearance = "https://www.god.ct8.pl/api/charapp.php?id=<?php echo $_USER['id']; ?>"
end) 
if not suc then 
local x = Instance.new("Message") 
x.Text = err 
x.Parent = workspace 
wait(math.huge) 
end 
while true do 
wait(0.001) 
replicator:SendMarker() 
function onDisconnection(peer, lostConnection)  
  if lostConnection then  
    showErrorWindow("You have lost connection", "LostConnection", "LostConnection")  
  else  
    showErrorWindow("This game has been shutdown", "Kick", "Kick")  
  end  
end
replicator.Disconnection:connect(onDisconnection)
end 
