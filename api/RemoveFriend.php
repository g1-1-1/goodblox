<?php
header("Content-type: text/plain");
include "../inc/config.php";

if (!$isloggedin) {
  die("You are not logged in!");
}


$user_from = $_USER['id'];
$user_to = intval($_GET['id']);

if ($user_to < 1) {
  die ("Invalid ID.");
}

$deleteQuery = $link->prepare("DELETE FROM friends WHERE user_to = :user_to AND user_from = :user_from");
$deleteQuery->bindValue(':user_to', $_USER['id']);
$deleteQuery->bindValue(':user_from', $user_to);
$deleteQuery->execute();

if ($_GET['from_rq_page']) {
  header("Location: /my/home.aspx");
} else {
  header("Location: /User.aspx?ID=".$user_to);
}

?>