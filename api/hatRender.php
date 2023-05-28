<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");

if($isloggedin !== 'yes') {
    header('location: /');
}

$script = 'game:GetService("ContentProvider"):SetBaseUrl("https://www.madblxx.ga/")
game:GetService("ScriptContext").ScriptsDisabled = false

local Hat = game:GetObjects("http://madblxx.ga/api/hats/BeautifulHairForBeautifulPeople.rbxm")[1]
Hat.Parent = game.Workspace
Hat.Handle.Mesh.MeshId = "http://madblxx.ga/api/hats/hats/fonts/1037158.mesh"
Hat.Handle.Mesh.TextureId = "http://madblxx.ga/api/hats/hats/textures/10630446.png"

local result = game:GetService("ThumbnailGenerator"):Click("PNG", 420, 420, true)
return result';

$render = $RCCServiceSoap->execScript($script, rand(1,getrandmax()), 120);
if(empty($render)) {
    die('Sorry, looks like RCC is off.');
}

echo "<a href='data:image/png;base64,".$render."'>right click > open in a new tab</a>";

?>