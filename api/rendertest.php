<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");

if($isloggedin !== 'yes') {
    header('location: /');
}

$script = 'game:GetService("ContentProvider"):SetBaseUrl("https://www.madblxx.ga/")
game:GetService("ScriptContext").ScriptsDisabled = false

local plr = game.Players:CreateLocalPlayer(1)
--plr.CharacterAppearance = "https://www.madblxx.gq/api/charapp.php?id='.(int)$_USER["id"].'"
plr:LoadCharacter(false)
plr.Character.Torso.BrickColor = BrickColor.new("White")
plr.Character.Head.BrickColor = BrickColor.new("White")
plr.Character["Right Leg"].BrickColor = BrickColor.new("White")
plr.Character["Right Arm"].BrickColor = BrickColor.new("White")
plr.Character["Left Leg"].BrickColor = BrickColor.new("White")
plr.Character["Left Arm"].BrickColor = BrickColor.new("White")

game:GetService("Lighting")
--game.Players.LocalPlayer.Character.Humanoid:Destroy()
game.Lighting.Outlines = false
game.Lighting.TimeOfDay = "14:45:00"

local Shirt = Instance.new("Shirt", game.Players.LocalPlayer.Character)
Shirt.ShirtTemplate = "http://madblxx.ga/api/shirts/Daco_4937397.png"

local Pants = Instance.new("Pants", game.Players.LocalPlayer.Character)
Pants.PantsTemplate = "rbxasset://studs.png"

local result = game:GetService("ThumbnailGenerator"):Click("PNG", 420, 420, true)
  
return result';

$render = $RCCServiceSoap->execScript($script, rand(1,getrandmax()), 120);
if(empty($render)) {
    die('Sorry, looks like RCC is off.');
}

echo "<a href='data:image/png;base64,".$render."'>right click > open in a new tab</a>";

?>