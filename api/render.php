<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");

if($isloggedin !== 'yes') {
    header('location: /');
}
$sql = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $_USER['id'], PDO::PARAM_INT);
$stmt->bindValue(':type', "tshirt", PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();

if (count($result) > 0 || $row['type'] == 'tshirt') {
    foreach ($result as $row) {
        $itemq = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq->bindValue(':itemid', $row['itemid'], PDO::PARAM_INT);
        $itemq->bindValue(':type', $row['type'], PDO::PARAM_INT);
        $itemq->execute();
        $item = $itemq->fetch(PDO::FETCH_ASSOC);
        if ($row['type'] == 'tshirt'){ $echothing = $echothing . "" .  $item['filename'] . ""; }
    }
}
  
$sql1 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt1 = $conn->prepare($sql);
$stmt1->bindValue(':id', $_USER['id'], PDO::PARAM_INT);
$stmt1->bindValue(':type', "shirt", PDO::PARAM_INT);
$stmt1->execute();
$result1 = $stmt1->fetchAll();

if (count($result1) > 0 || $row1['type'] == 'shirt') {
    foreach ($result1 as $row1) {
        $itemq1 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq1->bindValue(':itemid', $row1['itemid'], PDO::PARAM_INT);
        $itemq1->bindValue(':type', $row1['type'], PDO::PARAM_INT);
        $itemq1->execute();
        $item1 = $itemq1->fetch(PDO::FETCH_ASSOC);
        if ($row1['type'] == 'shirt'){ $echothing1 = $echothing1 . "" .  $item1['filename'] . ""; }
        if(empty($echothing1)){ $echothing1 = "rbxasset://studs.png"; }
    }
}
if (count($result1) < 1){
    $echothing1 = "rbxasset://studs.png";
}
  
$sql2 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt2 = $conn->prepare($sql2);
$stmt2->bindValue(':id', $_USER['id'], PDO::PARAM_INT);
$stmt2->bindValue(':type', "pants", PDO::PARAM_INT);
$stmt2->execute();
$result2 = $stmt2->fetchAll();

if (count($result2) > 0 || $row2['type'] == 'pants') {
    foreach ($result2 as $row2) {
        $itemq2 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq2->bindValue(':itemid', $row2['itemid'], PDO::PARAM_INT);
        $itemq2->bindValue(':type', $row2['type'], PDO::PARAM_INT);
        $itemq2->execute();
        $item2 = $itemq2->fetch(PDO::FETCH_ASSOC);
        if ($row2['type'] == 'pants'){ $echothing2 = $echothing2 . "" .  $item2['filename'] . ""; }
    }
}
  

$sql3 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt3 = $conn->prepare($sql3);
$stmt3->bindValue(':id', $_USER['id'], PDO::PARAM_INT);
$stmt3->bindValue(':type', "face", PDO::PARAM_INT);
$stmt3->execute();
$result3 = $stmt3->fetchAll();

if (count($result3) > 0 || $row3['type'] == 'face') {
    foreach ($result3 as $row3) {
        $itemq3 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq3->bindValue(':itemid', $row3['itemid'], PDO::PARAM_INT);
        $itemq3->bindValue(':type', $row3['type'], PDO::PARAM_INT);
        $itemq3->execute();
        $item3 = $itemq3->fetch(PDO::FETCH_ASSOC);
        if ($row3['type'] == 'face'){ $echothing3 = $echothing3 . "" .  $item3['filename'] . ""; }
    }
}
  
if ($echothing3 == ''){
    $echothing3 = "rbxasset://textures/face.png";
}

$sql4 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4 = $conn->prepare($sql4);
$stmt4->bindValue(':id', $_USER['id'], PDO::PARAM_INT);
$stmt4->bindValue(':type', "hat", PDO::PARAM_INT);
$stmt4->execute();
$result4 = $stmt4->fetchAll();

if (count($result4) > 0 || $row4['type'] == 'hat') {
    foreach ($result4 as $row4) {
        $itemq4 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4->bindValue(':itemid', $row4['itemid'], PDO::PARAM_INT);
        $itemq4->bindValue(':type', $row4['type'], PDO::PARAM_INT);
        $itemq4->execute();
        $item4 = $itemq4->fetch(PDO::FETCH_ASSOC);
        if ($row4['type'] == 'hat'){ $echothing4 = "
local Hat = game:GetObjects('".$item4["filename"]."')[1]
Hat.Parent = plr.Character 
Hat.Handle.Mesh.MeshId = '".$item4["hatmesh"]."'
Hat.Handle.Mesh.TextureId = '".$item4["hattexture"]."'                                     
"; 
  break;
       }  
    }
}
  
if ($echothing4 == ''){
    $echothing4 = "";
}
  
$sql45 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt45 = $conn->prepare($sql45);
$stmt45->bindValue(':id', $_USER['id'], PDO::PARAM_STR);
$stmt45->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt45->execute();
$result45 = $stmt45->fetchAll();

if (count($result45) > 1 || $row45['type'] == 'hat') {
        $row45 = $result45[1];
        $itemq45 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq45->bindValue(':itemid', $row45['itemid'], PDO::PARAM_INT);
        $itemq45->bindValue(':type', $row45['type'], PDO::PARAM_STR);
        $itemq45->execute();
        $item45 = $itemq45->fetch(PDO::FETCH_ASSOC);
        if ($row45['type'] == 'hat'){ $echothing45 = "
local Hat = game:GetObjects('".$item45["filename"]."')[1]
Hat.Parent = plr.Character
Hat.Handle.Mesh.MeshId = '".$item45["hatmesh"]."'
Hat.Handle.Mesh.TextureId = '".$item45["hattexture"]."'                                     
";
       }  
    }

if ($echothing45 == ''){
  $echothing45 = "";
}
  
$sql455 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt455 = $conn->prepare($sql455);
$stmt455->bindValue(':id', $_USER['id'], PDO::PARAM_STR);
$stmt455->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt455->execute();
$result455 = $stmt455->fetchAll();

if (count($result455) > 2 || $row455['type'] == 'hat') {
        $row455 = $result455[2];
        $itemq455 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq455->bindValue(':itemid', $row455['itemid'], PDO::PARAM_INT);
        $itemq455->bindValue(':type', $row455['type'], PDO::PARAM_STR);
        $itemq455->execute();
        $item455 = $itemq455->fetch(PDO::FETCH_ASSOC);
        if ($row455['type'] == 'hat'){ $echothing455 = "
local Hat = game:GetObjects('".$item455["filename"]."')[1]
Hat.Parent = plr.Character
Hat.Handle.Mesh.MeshId = '".$item455["hatmesh"]."'
Hat.Handle.Mesh.TextureId = '".$item455["hattexture"]."'                                     
";
       }  
    }

if ($echothing455 == ''){
  $echothing455 = "";
}
  
$sql4555 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4555 = $conn->prepare($sql4555);
$stmt4555->bindValue(':id', $_USER['id'], PDO::PARAM_STR);
$stmt4555->bindValue(':type', "head", PDO::PARAM_STR);
$stmt4555->execute();
$result4555 = $stmt4555->fetchAll();

if (count($result4555) > 0 || $row4555['type'] == 'head') {
        $row4555 = $result4555[0];
        $itemq4555 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4555->bindValue(':itemid', $row4555['itemid'], PDO::PARAM_INT);
        $itemq4555->bindValue(':type', $row4555['type'], PDO::PARAM_STR);
        $itemq4555->execute();
        $item4555 = $itemq4555->fetch(PDO::FETCH_ASSOC);
        if ($row4555['type'] == 'head'){ $echothing4555 = '
plr.Character.Head["Mesh"].MeshId = "'.$item4555['filename'].'"
                                    
';
       }  
    }

if ($echothing4555 == ''){
  $echothing4555 = "";
}

$script = 'game:GetService("ContentProvider"):SetBaseUrl("https://www.madblxx.ga/")
game:GetService("ScriptContext").ScriptsDisabled = false

local plr = game.Players:CreateLocalPlayer(1)
--plr.CharacterAppearance = "https://www.madblxx.gq/api/charapp.php?id='.(int)$_USER["id"].'"
plr:LoadCharacter(false)

plr.Character.Torso.BrickColor = BrickColor.new("'.$_USER["torsocolor"].'")
plr.Character.Head.BrickColor = BrickColor.new("'.$_USER["headcolor"].'")
plr.Character["Right Leg"].BrickColor = BrickColor.new("'.$_USER["rightlegcolor"].'")
plr.Character["Right Arm"].BrickColor = BrickColor.new("'.$_USER["rightarmcolor"].'")
plr.Character["Left Leg"].BrickColor = BrickColor.new("'.$_USER["leftlegcolor"].'")
plr.Character["Left Arm"].BrickColor = BrickColor.new("'.$_USER["leftarmcolor"].'")

game:GetService("Lighting")
--game.Players.LocalPlayer.Character.Humanoid:Destroy()
game.Lighting.Outlines = false
game.Lighting.TimeOfDay = "14:45:00"
  
plr.Character.Head.Material = Enum.Material.SmoothPlastic;

plr.Character.Torso.Material = Enum.Material.SmoothPlastic;
  
plr.Character["Right Leg"].Material = Enum.Material.SmoothPlastic;
  
plr.Character["Right Arm"].Material = Enum.Material.SmoothPlastic;
  
plr.Character["Left Leg"].Material = Enum.Material.SmoothPlastic;
  
plr.Character["Left Arm"].Material = Enum.Material.SmoothPlastic;
  
plr.Character.Head.Material = Enum.Material.SmoothPlastic;
 
'.$echothing4.'
'.$echothing45.'
'.$echothing455.'

local Face = plr.Character.Head.face
Face.Texture = "'.$echothing3.'"

local Pant = Instance.new("Pants", game.Players.LocalPlayer.Character)
Pant.PantsTemplate = "'.$echothing2.'"

local Shirt = Instance.new("Shirt", game.Players.LocalPlayer.Character)
Shirt.ShirtTemplate = "'.$echothing1.'"

local TShirt = Instance.new("Decal")
TShirt.Parent = plr.Character.Torso
TShirt.Texture = "'.$echothing.'"
  
'.$echothing4555.'

print("'.$_USER['username'].' just rendered!")

local result = game:GetService("ThumbnailGenerator"):Click("PNG", 420, 420, true)
return result';

$render = $RCCServiceSoap->execScript($script, rand(1,getrandmax()), 120);
if(empty($render)) {
    die('Sorry, looks like RCC is off.');
}

$stmt = $conn->prepare("UPDATE users SET thumbnail = :render WHERE id = :user_id");
$stmt->bindParam(':render', $render, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $_USER["id"], PDO::PARAM_INT);
$stmt->execute();

//echo "<a href='data:image/png;base64,".$render."'>right click > open in a new tab</a>";


?>
<script>
history.go(-1)  
</script>