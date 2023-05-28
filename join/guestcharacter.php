<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
$guestnum = $_GET['guestnum'];
?>
local hasLoaded = false
function character()
local player = game.Workspace:FindFirstChild("Guest <?php echo $guestnum; ?>")
if player~=nil and hasLoaded == false then
wait(1)
player.Head.BrickColor = BrickColor.new("White")
player.Torso.BrickColor = BrickColor.new("Really black")
player["Right Leg"].BrickColor = BrickColor.new("Really black")
player["Right Arm"].BrickColor = BrickColor.new("Really black")
player["Left Leg"].BrickColor = BrickColor.new("Really black")
player["Left Arm"].BrickColor = BrickColor.new("Really black")
local Shirt = Instance.new("Shirt", game.Players.LocalPlayer.Character)
Shirt.ShirtTemplate = "http://madblxx.ga/api/shirts/8412.png";
player.Humanoid.Died:connect(function()
   if hasLoaded == true then
       wait(5)
       hasLoaded = false
   end
end)
hasLoaded = true
end
end
workspace.ChildAdded:connect(character)  