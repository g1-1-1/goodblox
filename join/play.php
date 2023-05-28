<?php if($_GET['accountcode'] == 'Guest') {include('guestplay.php'); die();} ?>
dofile("http://madblxx.ga/join/JoinServer.php?<?php echo $_SERVER["QUERY_STRING"]; ?>&")
dofile("http://madblxx.ga/join/character.php?<?php echo $_SERVER["QUERY_STRING"]; ?>&")
