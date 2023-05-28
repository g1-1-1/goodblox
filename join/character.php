<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
$stmt = $conn->prepare("SELECT * FROM users WHERE accountcode=:accountcode");
$stmt->execute(array(':accountcode'=>$_GET['accountcode']));
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM games WHERE id=:id");
$stmt->execute(array(':id'=>(int)$_GET['placeid']));
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $user['id'], PDO::PARAM_INT);
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
$stmt1->bindValue(':id', $user['id'], PDO::PARAM_INT);
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
    }
}
  
$sql2 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt2 = $conn->prepare($sql2);
$stmt2->bindValue(':id', $user['id'], PDO::PARAM_INT);
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
$stmt3->bindValue(':id', $user['id'], PDO::PARAM_INT);
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
$stmt4->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt4->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt4->execute();
$result4 = $stmt4->fetchAll();

if (count($result4) > 0 || $row4['type'] == 'hat') {
        $row4 = $result4['0'];
        $itemq4 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4->bindValue(':itemid', $row4['itemid'], PDO::PARAM_INT);
        $itemq4->bindValue(':type', $row4['type'], PDO::PARAM_STR);
        $itemq4->execute();
        $item4 = $itemq4->fetch(PDO::FETCH_ASSOC);
        if ($row4['type'] == 'hat'){ $echothing4 = "".$item4['filename'].""; }
}

$sql45 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt45 = $conn->prepare($sql45);
$stmt45->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt45->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt45->execute();
$result45 = $stmt45->fetchAll();

if (count($result45) > 0 || $row45['type'] == 'hat') {
        $row45 = $result45['1'];
        $itemq45 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq45->bindValue(':itemid', $row45['itemid'], PDO::PARAM_STR);
        $itemq45->bindValue(':type', $row45['type'], PDO::PARAM_STR);
        $itemq45->execute();
        $item45 = $itemq45->fetch(PDO::FETCH_ASSOC);
        if ($row45['type'] == 'hat'){ $echothing45 = "".$item45['filename'].""; }
}
  
$sql455 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt455 = $conn->prepare($sql455);
$stmt455->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt455->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt455->execute();
$result455 = $stmt455->fetchAll();

if (count($result455) > 0 || $row455['type'] == 'hat') {
        $row455 = $result455['2'];
        $itemq455 = $conn->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq455->bindValue(':itemid', $row455['itemid'], PDO::PARAM_STR);
        $itemq455->bindValue(':type', $row455['type'], PDO::PARAM_STR);
        $itemq455->execute();
        $item455 = $itemq455->fetch(PDO::FETCH_ASSOC);
        if ($row455['type'] == 'hat'){ $echothing455 = "".$item455['filename'].""; }
}
  
if (count($result4) > 0){
$hatthing = '
local Hat = game:GetObjects("'.$echothing4.'")[1]
Hat.Parent = player
Hat.Handle.Mesh.MeshId = "'.$item4['hatmesh'].'"
Hat.Handle.Mesh.TextureId = "'.$item4['hattexture'].'"
';
}else{
$hatthing = '';
}
if (count($result45) > 0){
$hatthing2 = '
local Hat2 = game:GetObjects("'.$echothing45.'")[1]
Hat2.Parent = player
Hat2.Handle.Mesh.MeshId = "'.$item45['hatmesh'].'"
Hat2.Handle.Mesh.TextureId = "'.$item45['hattexture'].'"
';
}else{
$hatthing2 = '';
}
if (count($result455) > 0){
$hatthing3 = '
local Hat3 = game:GetObjects("'.$echothing455.'")[1]
Hat3.Parent = player
Hat3.Handle.Mesh.MeshId = "'.$item455['hatmesh'].'"
Hat3.Handle.Mesh.TextureId = "'.$item455['hattexture'].'"
';
}else{
$hatthing3 = '';
}

if (count($result1) > 0) {
$shirtthing = '
local Shirt = Instance.new("Shirt", game.Players.LocalPlayer.Character)
Shirt.ShirtTemplate = "'.$echothing1.'"';
}else{
$shirtthing = '';
}
 
if (count($result3) > 0) {
$facething = '
local Face = player.Head.face
Face.Texture = "'.$echothing3.'"';
}else{
$facething = '';
}
  
if (count($result2) > 0) {
$pantthing = '
local Pant = Instance.new("Pants", game.Players.LocalPlayer.Character)
Pant.PantsTemplate = "'.$echothing2.'"';
}else{
$pantthing = '';
}
?>
local hasLoaded = false
function character()
local player = game.Workspace:FindFirstChild("<?php echo $user['username']; ?>")
if player~=nil and hasLoaded == false then
wait(1)
--game.Players.LocalPlayer.CharacterAppearance = "http://www.madblxx.gq/api/charapp.php?id=<?php echo $user['id']; ?>"
player.Head.BrickColor = BrickColor.new("<?php echo $user['headcolor']; ?>")
player.Torso.BrickColor = BrickColor.new("<?php echo $user['torsocolor']; ?>")
player["Right Leg"].BrickColor = BrickColor.new("<?php echo $user['rightlegcolor']; ?>")
player["Right Arm"].BrickColor = BrickColor.new("<?php echo $user['rightarmcolor']; ?>")
player["Left Leg"].BrickColor = BrickColor.new("<?php echo $user['leftlegcolor']; ?>")
player["Left Arm"].BrickColor = BrickColor.new("<?php echo $user['leftarmcolor']; ?>")
<?php echo $facething; ?>
<?php echo $shirtthing; ?>
<?php echo $pantthing; ?>
<?php echo $facething; ?>
local TShirt = Instance.new("Decal")
TShirt.Parent = player.Torso
TShirt.Texture = "<?php echo $echothing; ?>"
<?php echo $hatthing; ?>
<?php echo $hatthing2; ?>
<?php echo $hatthing3; ?>

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