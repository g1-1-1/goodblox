<?php
  require_once('db.php');
  require_once($_SERVER["DOCUMENT_ROOT"]."/Assemblies/Roblox/Grid/Rcc/RCCServiceSoap.php");
                        
  $sitename = 'GoodBlox';
  $sitedomain = 'madblxx.ga';
  $siteurl = 'https://www.'. $sitedomain;
  $title = $sitename. ': A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics';
  
  session_start();
  // Fetch global data
$stmt = $conn->prepare("SELECT * FROM global WHERE id = ?");
$stmt->execute([1]);
$_GLOBAL = $stmt->fetch(PDO::FETCH_ASSOC);

$iphash = hash('sha512',$_SERVER["REMOTE_ADDR"]);

$_USERID = $_SESSION["id"];

// Update user's IP hash
$stmt = $conn->prepare("UPDATE users SET ip = ? WHERE id = ?");
$stmt->execute([$iphash, $_USERID]);
  $_USERQ = $conn->query("SELECT * FROM users WHERE id='$_USERID'");
  $_USER = $_USERQ->fetch(PDO::FETCH_ASSOC);
  if($_SESSION["loggedin"] == 'true') {$isloggedin = 'yes';} else {$isloggedin = 'no';}
  
  if (!$isloggedin) {
  // none for now
} else {
  $currenttime = time();

  $q = $conn->prepare("UPDATE users SET `lastseen` = :currenttime WHERE id=:id");
  $q->bindParam(':currenttime', $currenttime);
  $q->bindParam(':id', $_USER['id']);
  $q->execute();

  if ($_USER['next_tix_reward'] < time()) {
    $dailyreward = 15;
    $nextrew = time() + 86400;

    $q = $conn->prepare("UPDATE users SET `tix` = `tix` + :dailyreward, `next_tix_reward` = :nextrew WHERE id=:id");
    $q->bindParam(':dailyreward', $dailyreward);
    $q->bindParam(':nextrew', $nextrew);
    $q->bindParam(':id', $_USER['id']);
    $q->execute();
  }
}

if (!$isloggedin) {
  // none for now
} else {
  if ($_USER['membership_type'] != "NONE") {
    if ($_USER['next_bricks_award'] < time()) {
      switch($_USER['membership_type']) {
        case "LEVEL_1":
          $bricksrew = 15;
          break;
        default:
          $bricksrew = 0;
      }

      $nextrew2 = time() + 86400;

      $q = $conn->prepare("UPDATE users SET `robux` = `robux` + :bricksrew, `next_bricks_award` = :nextrew2 WHERE id=:id");
      $q->bindParam(':bricksrew', $bricksrew);
      $q->bindParam(':nextrew2', $nextrew2);
      $q->bindParam(':id', $_USER['id']);
      $q->execute();
    }
  }
}
  

$RCCServiceSoap = new RCCServiceSoap("147.185.221.211",57643,$sitedomain);
  
$stmt = $conn->prepare("SELECT COUNT(*) FROM messages WHERE readto = '0' AND user_to = :user_to");
$stmt->execute(['user_to' => $_USER['id']]);
$unreadmsg = $stmt->fetchColumn();
$_GLOBALQ = $conn->query("SELECT * FROM global WHERE id='1'") or die($conn->errorInfo()[2]);
$_GLOBAL = $_GLOBALQ->fetch(PDO::FETCH_ASSOC);

if($isloggedin == 'yes'){
  if($_USER['thumbnail'] == ''){
    header("location: /api/render");
  }
}

  
function metatag($title, $description, $image) {
    global $sitename;
    echo '<meta property="og:site_name" content="'.$sitename.'">
<meta property="og:title" content="'.$title.'">
<meta property="og:description" content="'.$description.'">
<meta property="og:image" content="'.$image.'">';
}

?>