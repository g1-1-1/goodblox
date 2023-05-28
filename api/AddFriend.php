<?php
header("Content-type: text/plain");
include "../inc/config.php";

if ($isloggedin == 'no') {
  die("You are not logged in!");
}


$user_from = $_USER['id'];
$user_to = intval($_GET['id']);

if ($user_to < 1) {
  die ("Invalid ID.");
}

// Assuming $conn is a PDO object representing the database connection

$stmt1 = $conn->prepare("SELECT * FROM friends WHERE user_from=? AND user_to=?");
$stmt1->execute([$user_from, $user_to]);
$_1 = $stmt1->rowCount();

$stmt2 = $conn->prepare("SELECT * FROM friends WHERE user_from=? AND user_to=?");
$stmt2->execute([$user_to, $user_from]);
$_2 = $stmt2->rowCount();

$stmt3 = $conn->prepare("SELECT * FROM friends WHERE user_from=? AND user_to=? AND arefriends='1'");
$stmt3->execute([$user_to, $user_from]);
$_3 = $stmt3->rowCount();

$stmt4 = $conn->prepare("SELECT * FROM friends WHERE user_from=? AND user_to=? AND arefriends='1'");
$stmt4->execute([$user_from, $user_to]);
$_4 = $stmt4->rowCount();

if (($_1 != 0) || ($_3 != 0) || ($_4 != 0) || ($user_to == $user_from)) {
  //Friend request already sent or users are already friends: Go back to user page.
  die("You are already friend with this user. / You already sent a friend request to this user.");
  //header("Location: User?id=".$user_to);
} else if ($_2 != 0) {
  //Other user already sent friend request: Accept request.
  //die("2");
  $arefriends = 1;
  $hash = md5($user_from.$user_to.$arefriends);
  $stmtUpdate = $conn->prepare("UPDATE friends SET arefriends=?, hash=? WHERE user_from=? AND user_to=?");
  $stmtUpdate->execute([$arefriends, $hash, $user_to, $user_from]);
  SendAutomatedMessageToId("Friend request accepted", $_USER['username'] . " has accepted your friend request.", $user_to);
} else {
  //All checks completed
  //die("3");

  if ($stmtUserTo = $conn->prepare("SELECT * FROM users WHERE id=?")) {
    $stmtUserTo->execute([$user_to]);
    if ($stmtUserTo->rowCount() == 0) {
      die("Invalid ID.");
    }
  }
  $arefriends = 0;
  $hash = md5($user_from.$user_to.$arefriends);
  $stmtInsert = $conn->prepare("INSERT INTO friends (user_from, user_to, arefriends, hash) VALUES (?, ?, ?, ?)");
  $stmtInsert->execute([$user_from, $user_to, $arefriends, $hash]);
  //SendAutomatedMessageToId("Friend request from {$_USER['username']}", $_USER['username'] . " has sent you a friend request.<br><a href=\"/api/AddFriend?id=$user_from\">Accept friend request</a>", $user_to);
}


if (isset($_GET['from_rq_page'])) {
  header("Location: /Requests");
} else {
  header("Location: /User.php?id=".$user_to);
}


?>