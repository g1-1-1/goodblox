<?php
include "../core/header.php";
$usq = mysqli_query($connect, "SELECT * FROM users");
$hashes = array();


while ($user = mysqli_fetch_assoc($usq)) {
  if (!in_array($user['avatar_hash'], $hashes)) {
    $hashes[] = $user['avatar_hash'];
  }
}
  RenderAvatarFromHash("45e834b3f75a3ef01a8ba84fe6c8af1a", true);

echo "OK";
?>