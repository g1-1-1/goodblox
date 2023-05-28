<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';
$id = $_GET['id'] ?? 0;
if($isloggedin !== 'yes') {header('location: /login.aspx');}
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    $content = $_POST["content"];
    $sql = "INSERT INTO comments (id, userid, assetid, content, time_posted) VALUES (NULL, '".$_USER['id']."', '".$id."', '".$content."', ".time().")";
    if ($conn->query($sql) === TRUE) {
      echo "Succesfully posted a comment!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
die("<script>document.location = \"item.aspx?id=$id\"</script>");
?>