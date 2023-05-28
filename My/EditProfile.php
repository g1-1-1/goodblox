<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';
if($isloggedin !== 'yes') {header('location: /login.aspx');}
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $desiredblurb = $_POST["desc"];
    $desiredblurb = str_replace("'","\'",$desiredblurb);
    
    $stmt = $conn->prepare("UPDATE users SET blurb = :blurb WHERE id = :id");
    $stmt->execute(['blurb' => $desiredblurb, 'id' => $_USER['id']]);
}


header('location: /My/Settings.aspx');
?>