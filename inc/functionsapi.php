<?php



function discord_user_log($username, $message) {
  //d
}

function UpdateObjData($id) {
  if (file_exists("/opt/htdocs/assets/catalog/$id.obj")) {
    $obj = file("/opt/htdocs/assets/catalog/$id.obj");
    $obj_text = "";
    foreach ($obj as $line) {
      if (strpos($line, 'mtllib') === 0) {
         $line = "mtllib $id.mtl\n";
      }
      $obj_text .= $line;
    }
    file_put_contents("/opt/htdocs/assets/catalog/$id.obj", $obj_text);


    $mtl = file("/opt/htdocs/assets/catalog/$id.mtl");
    $mtl_text = "";

    foreach ($mtl as $line) {
      if (strpos($line, 'map_Kd') === 0) {
         $line = "map_Kd $id.png\n";
      }

      $mtl_text .= $line;
    }

    file_put_contents("/opt/htdocs/assets/catalog/$id.mtl", $mtl_text);
  }
}

$RobloxColors = array(
    1,          //1
    208,        //2
    194,        //3
    199,        //4
    26,         //5
    21,         //6
    24,         //7
    226,        //8
    23,         //9
    107,        //10
    102,        //11
    11,         //12
    45,         //13
    135,        //14
    106,        //15
    105,        //16
    141,        //17
    28,         //18
    37,         //19
    119,        //20
    29,         //21
    151,        //22
    38,         //23
    192,        //24
    104,        //25
    9,          //26
    101,        //27
    5,          //28
    153,        //29
    217,        //30
    18,         //31
    125         //32
);

$RobloxColorsHtml = array(
    "#F2F3F2",  //1
    "#E5E4DE",  //2
    "#A3A2A4",  //3
    "#635F61",  //4
    "#1B2A34",  //5
    "#C4281B",  //6
    "#F5CD2F",  //7
    "#FDEA8C",  //8
    "#0D69AB",  //9
    "#008F9B",  //10
    "#6E99C9",  //11
    "#80BBDB",  //12
    "#B4D2E3",  //13
    "#74869C",  //14
    "#DA8540",  //15
    "#E29B3F",  //16
    "#27462C",  //17
    "#287F46",  //18
    "#4B974A",  //19
    "#A4BD46",  //20
    "#A1C48B",  //21
    "#789081",  //22
    "#A05F34",  //23
    "#694027",  //24
    "#6B327B",  //25
    "#E8BAC7",  //26
    "#DA8679",  //27
    "#D7C599",  //28
    "#957976",  //29
    "#7C5C45",  //30
    "#CC8E68",  //31
    "#EAB891"   //32
);

function GenerateHashFromCache($avatar) {
  $hash = md5("". $avatar['head_color'] . ";". $avatar['torso_color'] . ";". $avatar['leftarm_color'] . ";". $avatar['rightarm_color'] . ";". $avatar['leftleg_color'] . ";". $avatar['rightleg_color'] . ";". $avatar['hatid1'] . ";". $avatar['hatid2'] . ";". $avatar['hatid3'] . ";". $avatar['faceid'] . ";". $avatar['toolid'] . ";". $avatar['shirtid'] . ";". $avatar['pantsid'] . "");

  return $hash;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime;
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function ValidateUsername($username, $has_membership = false) {
  $regex = "/^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9_]+(?<![_.])$/";
  if ($has_membership === true) {
    $regex = "/^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";
  }

  return preg_match($regex, $username);
}

function time_remaining_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . '' : 'just now';
}

function jsredir($url) {
  die ("<script>document.location = \"$url\"</script>");
}

function discord($message, $username)
{
  //d
}


function notify($message)
{
  $data = array(
    "content" => $message,
    "username" => "Catalog Notifier"
  );
  $curl = curl_init("https://discord.com/api/webhooks/729443762165776564/pVRcZ2dOJvPOl4f3pKqJNZotY6BaPJnK4feUwbIV_o4Jjlr0xkz0ao5FPndJFLUjkX-A");
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  return curl_exec($curl);
}


function StoreCachedAvatar($avatar) {
  include("config.php");
  $hash = GenerateHashFromCache($avatar);
  $stmt = "INSERT INTO `avatar_cache`(`id`, `hash`, `head_color`, `torso_color`, `leftarm_color`,`rightarm_color`, `leftleg_color`, `rightleg_color`, `hatid1`,`hatid2`, `hatid3`, `faceid`, `toolid`, `shirtid`, `pantsid`) VALUES (NULL,'$hash','".$avatar['head_color']."','".$avatar['torso_color']."','".$avatar['leftarm_color']."','".$avatar['rightarm_color']."','".$avatar['leftleg_color']."','".$avatar['rightleg_color']."','".$avatar['hatid1']."','".$avatar['hatid2']."','".$avatar['hatid3']."','".$avatar['faceid']."','".$avatar['toolid']."','".$avatar['shirtid']."','".$avatar['pantsid']."')";

  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `avatar_cache` WHERE `hash`='$hash'")) < 1) {
    $stmt = $conn->prepare("INSERT INTO `avatar_cache` (`hash`) VALUES (:hash)");
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();
    GenerateAvatarThumbnail($hash);
}

  return $hash;
}

function GenerateAvatarThumbnail($hash) {
  require("config.php");
  $hash = htmlspecialchars($_GET['hash']);

$stmt = $conn->prepare("SELECT * FROM `avatar_cache` WHERE `hash`=:hash");
$stmt->bindParam(":hash", $hash);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  RenderAvatarFromHash($hash, false);
}

}

function LogUserAction($_USER, $type, $info) {
  require "config.php";
  $valid_actions = array(
    'REGISTER',
    'LOGIN',
    'PURCHASE_ITEM',
    'UPDATE_AVATAR',
    'POST_COMMENT',
    'POST_FORUM_THREAD',
    'POST_FORUM_REPLY',
    'CREATE_GAME',
    'CREATE_ASSET',
    'ADD_FRIEND',
    'SEND_MESSAGE',
    'CHANGE_PASSWORD',
    'CHANGE_USERNAME',
    'CHANGE_DESCRIPTION',
    'RECOVERED_ACCOUNT',
    'RECOVERED_ACCOUNT_COMPROMISED',
    'CONVERTED_CURRENCY',
    'JOINED_ORGANIZATION',
    'CREATED_ORGANIZATION',
    'CREATED_ROLE_ORGANIZATION',
    'MODIFIED_ROLE_ORGANIZATION',
    'MODIFIED_USER_ORGANIZATION'
  );

  if (!in_array($type, $valid_actions)) {
    echo "Couldn't save action: invalid type \"$type\"";
  } else {
    $info = $conn->real_escape_string(htmlspecialchars($info));
    $time = time();
    $ip = md5($_SERVER['REMOTE_ADDR']);
    $conn->query("INSERT INTO `user_action_log`(`user_id`, `action_type`, `info`, `ip_address`, `time`) VALUES ('{$_USER['id']}', '$type', '$info', '$ip', '$time')") or die($conn->error);
  }
  //echo "<script>alert(123)</script>";
}

function FilterString($string) {
  $words = array_values(array_filter(file($_SERVER["DOCUMENT_ROOT"] . "/api/profanity_filter_v1", FILE_IGNORE_NEW_LINES)));
  foreach ($words as $word) {
    if (preg_match("/(".$word.")/i", $string)) {
        return $word;
      }
    }
    return "OK";
}

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function GenerateAssetFileName($id) {
  return md5($id . "WPXCXJEAOYXGFMNFSVKQ");
}

function RobloxToHex($RobloxColor) {
  $RobloxColors = array(
    1,          //1
    208,        //2
    194,        //3
    199,        //4
    26,         //5
    21,         //6
    24,         //7
    226,        //8
    23,         //9
    107,        //10
    102,        //11
    11,         //12
    45,         //13
    135,        //14
    106,        //15
    105,        //16
    141,        //17
    28,         //18
    37,         //19
    119,        //20
    29,         //21
    151,        //22
    38,         //23
    192,        //24
    104,        //25
    9,          //26
    101,        //27
    5,          //28
    153,        //29
    217,        //30
    18,         //31
    125,
    666         //32
);

$RobloxColorsHtml = array(
    "#F2F3F2",  //1
    "#E5E4DE",  //2
    "#A3A2A4",  //3
    "#635F61",  //4
    "#1B2A34",  //5
    "#C4281B",  //6
    "#F5CD2F",  //7
    "#FDEA8C",  //8
    "#0D69AB",  //9
    "#008F9B",  //10
    "#6E99C9",  //11
    "#80BBDB",  //12
    "#B4D2E3",  //13
    "#74869C",  //14
    "#DA8540",  //15
    "#E29B3F",  //16
    "#27462C",  //17
    "#287F46",  //18
    "#4B974A",  //19
    "#A4BD46",  //20
    "#A1C48B",  //21
    "#789081",  //22
    "#A05F34",  //23
    "#694027",  //24
    "#6B327B",  //25
    "#E8BAC7",  //26
    "#DA8679",  //27
    "#D7C599",  //28
    "#957976",  //29
    "#7C5C45",  //30
    "#CC8E68",  //31
    "#EAB891",
    "#000000"   //32
);
  return $RobloxColorsHtml[array_search($RobloxColor, $RobloxColors)];
}

function hexToRgb($hex, $alpha = false) {
   $hex      = str_replace('#', '', $hex);
   $length   = strlen($hex);
   $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
   $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
   $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
   if ( $alpha ) {
      $rgb['a'] = $alpha;
   }
   return $rgb;
}

function SendAutomatedMessageToId($subject, $content, $uid) {
  include "config.php";
  $currenttimelol = time();
  $stmt = "INSERT INTO `messages`
  (`id`, `user_from`, `user_to`, `subject`, `content`, `datesent`) VALUES (
    NULL,
    '1',
    '$uid',
    '$subject',
    '$content',
    '$currenttimelol')";
                  //echo ($stmt);
                 $stmt = $conn->prepare($stmt);
$stmt->execute() or die(print_r($stmt->errorInfo(), true));

}



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function timeAgo($time_ago)
{
    // $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "Today";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "Today";
        }
        else{
            return "Today";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "Today";
        }else{
            return "Today";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "Yesterday";
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Years
    else{
        if($years==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
}

function forumtime($ts)
{
    $clock = $ts;
        $ts = strtotime($ts);
        return timeAgo($clock)." @ ".date("h:i A",$clock);

} // die(forumtime(time()));
?>
