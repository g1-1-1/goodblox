<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';
//sets the item id
$id = (int)$_GET["id"];
// Fetch item from catalog
$sql = "SELECT * FROM catalog WHERE id = :id;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$item = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch owned item
$sql = "SELECT * FROM owned_items WHERE itemid = :itemid AND ownerid = :ownerid;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':itemid', $id, PDO::PARAM_INT);
$stmt->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
$stmt->execute();
$owneditems = $stmt->fetch(PDO::FETCH_ASSOC);

//set $owned yes/no
if($owneditems) {$owned = 'yes';} else {$owned = 'no';}
//check if user already owns item, if yes then redirect
if($owned == 'yes') {header('location: /item.aspx?id='.$id); die();}

//do transaction
if($item['buywith'] == 'tix') {$currency = 'tix';} else {$currency = 'robux';}
if($currency == 'tix') {
    if($_USER['tix'] >= $item['price']) {
        $tixafterpurchase = $_USER['tix'] - $item['price'];
        // Update tix for user
$sql = "UPDATE users SET tix = :tixafterpurchase WHERE id = :userid;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':tixafterpurchase', $tixafterpurchase, PDO::PARAM_INT);
$stmt->bindValue(':userid', $_USER['id'], PDO::PARAM_INT);
$stmt->execute();

// Insert into owned_items
$sql = "INSERT INTO owned_items (itemid, ownerid, type) VALUES (:itemid, :ownerid, :type);";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':itemid', $id, PDO::PARAM_INT);
$stmt->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
$stmt->bindValue(':type', $item['type'], PDO::PARAM_STR);
$stmt->execute();

    } else {
        die('<h1>You don\'t have enough Tickets!</h1>');
    }
} else {
    if($_USER['robux'] >= $item['price']) {
        $buxafterpurchase = $_USER['robux'] - $item['price'];
        // Update robux for user
$sql = "UPDATE users SET robux = :buxafterpurchase WHERE id = :userid;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':buxafterpurchase', $buxafterpurchase, PDO::PARAM_INT);
$stmt->bindValue(':userid', $_USER['id'], PDO::PARAM_INT);
$stmt->execute();

// Insert into owned_items
$sql = "INSERT INTO owned_items (itemid, ownerid, type) VALUES (:itemid, :ownerid, :type);";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':itemid', $id, PDO::PARAM_INT);
$stmt->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
$stmt->bindValue(':type', $item['type'], PDO::PARAM_STR);
$stmt->execute();

    } else {
        die('<h1>You don\'t have enough GOODBUX!</h1>');
    }
}
header('location: /Item.aspx?id='.$id);
?>