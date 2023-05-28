<?php
include "../core/header.php";
$avq = mysqli_query($connect, "SELECT * FROM avatar_cache");

while ($cache = mysqli_fetch_assoc($avq)) {
  RenderAvatarFromHash($cache['hash'], true);
}

echo "OK";
?>