<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
if($isloggedin !== 'yes') {header('location: /');}
  
$sqls = "SELECT * FROM owned_items WHERE ownerid=:ownerid AND itemid=:itemid";
$stmts = $conn->prepare($sqls);
$stmts->bindParam(':ownerid', $_USER["id"]);
$stmts->bindParam(':itemid', $_GET["id"]);
$stmts->execute();
$isowner = $stmts->rowCount();
  
if($isowner < 1){
die("Can't wear a non equiped item");
}

if($_GET['id'] == '0'){
die("Can't wear a invalid item.");
}

$sql1 = "SELECT * FROM wearing WHERE itemid = :itemid AND userid = :userid AND type = :type;";
$stmt1 = $conn->prepare($sql1);
$stmt1->bindParam(':itemid', $_GET["id"]);
$stmt1->bindParam(':type', $_GET["wtype"]);
$stmt1->bindParam(':userid', $_USER["id"]);
$stmt1->execute();
$resultCheck1 = $stmt1->rowCount();
  
$sql2 = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmt2 = $conn->prepare($sql2);
$stmt2->bindParam(':type', $_GET["wtype"]);
$stmt2->bindParam(':userid', $_USER["id"]);
$stmt2->execute();
$resultCheck2 = $stmt2->rowCount();
  
$sqlshirt = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmtshirt = $conn->prepare($sqlshirt);
$stmtshirt->bindValue(':type', 'shirt');
$stmtshirt->bindParam(':userid', $_USER["id"]);
$stmtshirt->execute();
$shirtID = $stmtshirt->fetch();
  
$sqltshirt = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmttshirt = $conn->prepare($sqltshirt);
$stmttshirt->bindValue(':type', 'tshirt');
$stmttshirt->bindParam(':userid', $_USER["id"]);
$stmttshirt->execute();
$tshirtID = $stmttshirt->fetch();
  
$sqlhat = "SELECT * FROM wearing WHERE userid = :userid AND type = :type;";
$stmthat = $conn->prepare($sqlhat);
$stmthat->bindValue(':type', 'hat');
$stmthat->bindParam(':userid', $_USER["id"]);
$stmthat->execute();
$hatID = $stmthat->fetch();

if($_GET['wtype'] !== 'hat'){
if ($resultCheck2 > 0) {
    $deleteQuery3 = $conn->prepare("DELETE FROM wearing WHERE userid=:id AND type = :type");
    $deleteQuery3->bindValue(':id', $_USER['id']);
    $deleteQuery3->bindValue(':type', $_GET['wtype']);
    $deleteQuery3->execute();
}
}
if($_GET['wtype'] == 'hat'){
if ($resultCheck2 > 2) {
    $deleteQuery4 = $conn->prepare("DELETE FROM wearing WHERE userid=:id AND type=:type AND id=(SELECT MAX(id) FROM wearing WHERE userid=:id AND type=:type)");
    $deleteQuery4->bindValue(':id', $_USER['id']);
    $deleteQuery4->bindValue(':type', $_GET['wtype']);
    $deleteQuery4->execute();
}
}

$randomNumber = rand(1, 999999) * -1;
$randomNumber21 = rand(999999, 999999999999) * -1;
$randomNumber12 = rand(999999, 999999999999) * 1;
$randomNumber13 = rand(999999999999, 1366573283722) * 1;
$randomNumber14 = rand(999999999999, 1366573283722) * -1;
$randomNumber2 = rand(1, 999999) * 1;
$sql = "INSERT INTO `wearing` (`id`, `userid`, `itemid`, `type`) VALUES (:id, :userid, :itemid, :type); ";
$stmt = $conn->prepare($sql);
if ($_GET['wtype'] == 'shirt'){ 
$itemthing = 0 + $randomNumber14;
}
if ($_GET['wtype'] == 'pants'){
$itemthing = $shirtID['id'] + $randomNumber13;
}
if ($_GET['wtype'] == 'hat'){
$itemthing = $randomNumber2 + $randomNumber12 + $randomNumber13;
}
if ($_GET['wtype'] == 'tshirt'){
$itemthing = $hatID['id'] + $randomNumber;
}
if ($_GET['wtype'] == 'face'){
$itemthing = $randomNumber12;
}
if ($_GET['wtype'] == 'head'){
$itemthing = $randomNumber12;
}
$stmt->bindParam(':id', $itemthing);
$stmt->bindParam(':userid', $_USER["id"]);
$stmt->bindParam(':itemid', $_GET["id"]);
$stmt->bindParam(':type', $_GET["wtype"]);
$stmt->execute();
header("location: ../api/render.php");

?> 
