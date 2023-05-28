<?php
// main headers
require ("inc/header.php");
require ("inc/nav.php");
$id = $_GET['ID'] ?? 0;
$querytype = htmlspecialchars($_GET["wtype"]);

$id = intval($id);


$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  // User doesn't exist.
  die("<script>document.location = \"/Browse.aspx\"</script>");
}

if ($user['bantype'] == 'Ban') {
  header("location: error.aspx");
}

$ippv = md5($_SERVER['REMOTE_ADDR']);

$stmt = $conn->prepare("SELECT * FROM pageviews WHERE userid=? AND ip=?");
$stmt->execute([$id, $ippv]);
if ($stmt->rowCount() < 1) {
  /*
  $stmt = $conn->prepare("INSERT INTO `pageviews`(`id`, `ip`, `userid`) VALUES (NULL, ?, ?)");
  $stmt->execute([$ippv, $id]);
  */
}

/*
PLAYER STATS
*/
$page_views = $conn->query("SELECT * FROM pageviews WHERE userid='$id'")->rowCount();

$item_sales = 0;
$items = $conn->query("SELECT * FROM catalog WHERE creatorid='$id'");

while ($item = $items->fetch(PDO::FETCH_ASSOC)) {
  $item_sales = $item_sales + $item['sales'];
}

$trade_value = 0;
$asdfs = $conn->prepare("SELECT * FROM owneditems WHERE userid=?");
$asdfs->execute([$user['id']]);

while ($inv = $asdfs->fetch(PDO::FETCH_ASSOC)) {
  $stmt = $conn->prepare("SELECT * FROM catalog WHERE id=?");
  $stmt->execute([$inv['assetid']]);
  $asset = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($asset['is_limited'] == 1) {
    $totalsales = 0;
    $salesc = 0;

    $slq = $conn->prepare("SELECT * FROM limited_sales WHERE item_id=?");
    $slq->execute([$asset['id']]);
    while ($sssssss = $slq->fetch(PDO::FETCH_ASSOC)) {
      $totalsales = $totalsales + $sssssss['price'];
      $salesc++;
    }
    if ($totalsales != 0) {
      $avg_price = round($totalsales / $salesc);
    } else {
      $avg_price = 0;
    }
    $trade_value = $trade_value + $avg_price;
  }
}

$invtype = $_GET['invtype'] ?? 'hat';

$achievements = $conn->query("SELECT * FROM owned_achievements WHERE user_id='{$user['id']}'");

if ($invtype == "hat") {
    //do stuff here
} else if ($invtype == "face") {
    //do stuff here
} else if ($invtype == "shirt") {
    //do stuff here
} else if ($invtype == "pants") {
    //do stuff here
} else if ($invtype == "tool") {
    //do stuff here
} else {
    $invtype = "hat";
}

$inventory_items_per_row = 4;

$invq = $conn->query("SELECT * FROM owneditems WHERE userid='{$user['id']}' AND type='$invtype'");

$onlinetext = ($user['lastseen'] + 300 <= time()) ? "<span class=\"UserOfflineMessage\">[ Offline ]</span>" : "<span class=\"UserOnlineMessage\">[ Online: Website ]</span>";

$resultsperpage = 3;
$check = $conn->query("SELECT * FROM users");
$usercount = $check->rowCount();

$numberofpages = ceil($usercount/$resultsperpage);

if(!isset($_GET['page'])) {
    $page = 1;
}else{
    $page = $_GET['page'];
}

$thispagefirstresult = ($page-1)*$resultsperpage;

$friendq = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR (`user_to` = :user_id AND `arefriends`='1') LIMIT :limit OFFSET :offset");
$friendq->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
$friendq->bindValue(':limit', $resultsperpage, PDO::PARAM_INT);
$friendq->bindValue(':offset', $thispagefirstresult, PDO::PARAM_INT);
$friendq->execute();

$friendnew = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR (`user_to` = :user_id AND `arefriends`='1') LIMIT :limit OFFSET :offset");
$friendnew->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$friendnew->bindValue(':limit', $resultsperpage, PDO::PARAM_INT);
$friendnew->bindValue(':offset', $thispagefirstresult, PDO::PARAM_INT);
$friendnew->execute();

$friendcount = $friendnew->rowCount();

$arefriends = false;

if ($isloggedin) {
    $stmt = $conn->prepare("SELECT * FROM friends WHERE user_to=:user_to AND user_from=:user_from AND arefriends='1'");
    $stmt->bindParam(':user_to', $_USER['id'], PDO::PARAM_INT);
    $stmt->bindParam(':user_from', $user['id'], PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $arefriends = true;
    }
    
    $stmt = $conn->prepare("SELECT * FROM friends WHERE user_to=:user_to AND user_from=:user_from AND arefriends='1'");
    $stmt->bindParam(':user_to', $user['id'], PDO::PARAM_INT);
    $stmt->bindParam(':user_from', $_USER['id'], PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $arefriends = true;
    }
}

if ($user['is_banned'] == 1) {
    header("Location: /error/");
}

/*
<div class="column is-one-third">
  <div class="box">
    <img src="https://via.placeholder.com/150"><br>
    <center><span style="font-size: 12px;">Crew Member</span></center>
  </div>
</div>
*/
?>
<?php if($user['BC'] == 'BC') {    ?>
        <?php if($user['BCExpire'] == $date) {
            $removebc = str_replace("'","\'",'None');
            $sql = "UPDATE `users` SET `BC` = '".$removebc."' WHERE `users`.`id` = ".$user['id'].";";
            mysqli_query($link, $sql);
        } ?>  
        <?php if($user['BCExpire'] < $date) {
            $removebc = str_replace("'","\'",'None');
            $sql = "UPDATE `users` SET `BC` = '".$removebc."' WHERE `users`.`id` = ".$user['id'].";";
            mysqli_query($link, $sql);
        } ?>  
<?php } ?>
<title>
  <?php echo $user['username']; ?>'s <?php echo $sitename; ?> Home Page
</title>
<div id="Body">
  <div id="UserContainer">
    <div id="LeftBank">
      <div id="ProfilePane">

<table width="100%" bgcolor="lightsteelblue" cellpadding="6" cellspacing="0">
    <tbody><tr>
        <td>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserName" class="Title"><?php echo htmlspecialchars($user['username']) ?></span><br>
            <?php echo $onlinetext ?>
                    </td>
    </tr>
    <tr>
        <td>
            <span id="ctl00_cphRoblox_rbxUserPane_lUserRobloxURL"><?php echo htmlspecialchars($user['username']) ?>'s <?=$sitename?>:</span><br>
            <a href="/User.aspx?ID=<?php echo $user['id'] ?>">https://god.ct8.pl/User.aspx?ID=<?php echo $user['id'] ?></a><br>
            <br>
            <div style="left: 0px; float: left; position: relative; top: 0px">
<!-- <iframe height="220" width="200" src="http://madblxx.ga/api/getAvatar.php?id=<?php echo $user['id'] ; ?>&size=180" frameborder="0" scrolling="no"></iframe> !--> <img height="220" width="220" src="data:image/png;base64, <?php echo $user['thumbnail'] ?>" frameborder="0" scrolling="no"></img>
                <div id="ctl00_cphRoblox_rbxUserPane_AbuseReportButton1_AbuseReportPanel" class="ReportAbusePanel">

    <span class="AbuseIcon"><a id="ctl00_cphRoblox_rbxUserPane_AbuseReportButton1_ReportAbuseIconHyperLink"><img src="/images/abuse.gif" alt="Report Abuse" border="0"></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_rbxUserPane_AbuseReportButton1_ReportAbuseTextHyperLink" onclick="alert('You cannot do this.');" href="#">Report Abuse</a></span>

</div>
            </div>


<p><a href="/api/sendMessage.php?id=<?php echo $user['id'] ?>">Send Message</a></p>
<?php
if (!$isloggedin) {
// none
} else {
    echo "<p><a href=\"/api/AddFriend.php?id={$user['id']}\">Send Friend Request</a></p>";
}
?>
              <p><span id="ctl00_cphRoblox_rbxUserPane_rbxPublicUser_lBlurb"><?php
    $descriptionn = htmlspecialchars($user['blurb']);
        echo "
    <span>$descriptionn</span>
    ";
  ?></span></p>
        </td>
    </tr>
</tbody></table>
<?php if($user['BC'] == 'BC') {    ?>
        <div class="Header">
                <h4>Builders Club Member until <?php echo $user['BCExpire'];?></h4>
           </div>
        <?php } ?>
      </div>
      <div id="UserBadgesPane">
      <div id="UserBadges">
        <h4><a href="/Badges">Badges</a></h4>
        <table cellspacing="0" border="0" align="Center">
          <tbody>
          <td>
      <?php
  $i = 0;

  while ($ownedachievement = $achievements->fetch(PDO::FETCH_ASSOC)) {
    $stmt = $conn->prepare("SELECT * FROM achievements WHERE id=?");
    $stmt->execute([$ownedachievement['achievement_id']]);
    $achievement = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<div class=\"Badge\">
      <div class=\"BadgeImage\">
      <img src=\"/images/Badges/{$achievement['name_file']}.png\" title=\"{$achievement['description']}\" alt=\"{$achievement['name_file']}\"><br>
      <div class=\"BadgeLabel\"><a href=\"/Badges\">{$achievement['name']}</a>
      </div>
      </div>
      <td><td>";
  $i += 1;
  
  if ($i >= 3) {
      echo "";
      $i = 0;
    }
}
?>
                  <?php if($user['USER_PERMISSIONS'] == 'Administrator') {    ?>
      <div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/Badges/Administrator-75x75.png" title="This badge identifies an account as belonging to a <?php echo $sitename ?> administrator. Only official <?php echo $sitename ?> administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter's account." alt="Administrator-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges">Administrator</a>
                </div>
              </div>
      <?php } ?>
      <?php if($user['BC'] == 'BC') {    ?>
              <td><td><div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/Badges/BuildersClub-75x75.png" title="This badge is given to builders club members on the site." alt="BuildersClub-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges">Builders Club</a>
                </div>
              </div>
      <?php } ?>
                
                <?php
  if($user['BC'] !== 'BC') {
    if($user['USER_PERMISSIONS'] !== 'Administrator') {
      echo '<span style="margin: 10px">This user has no badges</span>';
      }
    }
  ?>
  </tr>
</tbody></table>

</div>
      </div>
      <div id="UserStatisticsPane" style="margin-bottom: 10px">
            <div id="UserStatistics">
              <div id="StatisticsPanel" style="transition: height 0.5s ease-out 0s; overflow: hidden; height: 200px;">
                <div class="Header">
                  <h4>Statistics</h4>
                  <span class="PanelToggle"></span>
                </div>
                <div style="margin: 10px 10px 150px 10px;" id="Results">
                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
                    <div class="Value"><span><?php echo $friendcount ?></span></div>
                  </div>
                                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of posts this user has made to the <?=$sitename?> forum.">Forum Posts</acronym>:</div>
                    <div class="Value"><span><?php //echo number_format($numPosts); ?>0</span></div>
                  </div>
                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
                    <div class="Value"><span><?php echo number_format($page_views) ?></span></div>
                  </div>
                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</div>
                    <div class="Value"><span>0</span></div>
                  </div>
                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of times this user's models have been viewed - unfinished.">Model Views</acronym>:</div>
                    <div class="Value"><span>0</span></div>
                  </div>
                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of times this user's character has destroyed another user's character in-game.">Knockouts</acronym>:</div>
                    <div class="Value"><span>0</span></div>
                  </div>
                  <div class="Statistic">
                    <div class="Label"><acronym title="The number of times this user's character has been destroyed in-game.">Wipeouts</acronym>:</div>
                    <div class="Value"><span>0</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div id="RightBank">
    <div id="UserPlacesPane">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
            <script src="/ajax.js" type="text/javascript"></script>
            <script src="/ajaxcommon.js" type="text/javascript"></script>
            <script src="/ajaxtimer.js" type="text/javascript"></script>
            <script src="/ajaxanimations.js" type="text/javascript"></script>
            <script src="/ajaxextenderbase.js" type="text/javascript"></script>
            <script src="/accordian.js" type="text/javascript"></script>

            <script>
Sys.Application.add_init(function() {
    $create(Sys.Extended.UI.AccordionBehavior, {"ClientStateFieldID":"AccordionExtender_ClientState","FramesPerSecond":40,"HeaderCssClass":"AccordionHeader","id":"ShowcasePlacesAccordion_AccordionExtender"}, null, null, $get("ShowcasePlacesAccordion"));
});
</script>

            <div id="UserPlaces">
                <h4 class="thingg">Showcase</h4>
                <div id="ShowcasePlacesAccordion" style="height: auto; overflow: auto;">
                    <input type="hidden" name="AccordionExtender_ClientState" id="AccordionExtender_ClientState" value="0">

                    <?php
                    $usersQuery = "SELECT * FROM games WHERE creator_id = :creator_id ORDER BY id DESC LIMIT 10";
                    $stmt = $conn->prepare($usersQuery);
                    $stmt->bindParam(':creator_id', $user['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $usersResult = $stmt->fetchAll();
                    $thejlol = count($usersResult);
                    if ($thejlol == 0) {
                        ?>
                        <style>.thingg{display:none!important;}</style>
                        <div id="UserPlacesPane" style="border: 0px!important;">
                            <p style="padding:10px">This person doesn't have any <?=$sitename;?> places.</p>     
                        </div>
                    <?php }
                    foreach ($usersResult as $rowUser) { ?>
<div class="AccordionHeader"><?=htmlentities($rowUser['name']);?></div>
<div style="height: 0px; overflow: hidden; display: none;"><div style="display: block; height: auto; overflow: hidden;">
<div class="Place" style="background:white;">
<div class="PlayStatus">
                <span id="BetaTestersOnly" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/tinybeta.png" style="border-width:0px;">&nbsp;Beta testers only</span>
                <span id="FriendsOnlyLocked" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/unlocked.png" style="border-width:0px;">&nbsp;Friends-only: You have access</span>
                <span id="FriendsOnlyUnlocked" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/locked.png" style="border-width:0px;">&nbsp;Friends-only</span>
                <span id="Public" style="display:inline;"><img src="/images/public.png" style="border-width:0px;">&nbsp;Public</span>
</div>
<br>
<?php
if($_SESSION["loggedin"] != 'true'){
$launcherlink = "/login.aspx";
}else{
$launcherlink = $uriname."://?placeid=".$rowUser['id']."&accountcode=".$_USER['accountcode'];
}
?>
<div class="PlayOptions">
                                <a href="<?=$launcherlink;?>"><img id="MultiplayerVisitButton" class="ImageButton" src="/images/Play.png" alt="Visit Online"></a>
                                    </div>
<div class="Statistics">
<span>Visited idk times (idk last week)</span>
</div>
<div class="Thumbnail">
<a disabled="disabled" title="<?=htmlentities($rowUser['name']);?>" href="/PlaceItem.aspx?ID=<?=$rowUser['id'];?>" style="display:inline-block;">
<img src="/Thumbs/Games/show.php?id=<?=$rowUser['id'];?>" id="img" alt="<?=htmlentities($rowUser['name']);?>" border="0" style="height: 230px; width: 421px;">
</a>
</div>
                            <div>
<div class="Description">
<span><?=htmlentities($rowUser['description']);?></span>
</div>
</div>
                          </div>
</div></div>
<? $lolcount++; }?>

                  </div>      
      
    
</div></div>      <div id="FriendsPane">
          <div id="Friends">
              <h4><?php echo $user['username'] ?>'s friends
                                                <?php
            if ($friendcount < 1) {
             
            } else {
echo"<a href=\"/friends?of={$user['id']}\">See all $friendcount</a>";
}
  ?>
  </h4>
                                                <!--<p style="padding: 10px 10px 10px 10px;">This person doesn't have any <?=$sitename?> friends.</p>-->
                                                <table cellspacing="0" align="Center" border="0" style="border-collapse:collapse;">
          <tbody><tr>
                                                <tr>
                                                <?php
if ($friendcount < 1) {
  echo "<p style=\"padding: 10px 10px 10px 10px;\">This person doesn't have any $sitename friends.</p>";
} else {
  echo "<div class=\"columns\">";
  $total = 0;
  $row = 0;

  while ($friend = $friendq->fetch(PDO::FETCH_ASSOC)) {
    if ($total <= 5) {
      $friendid = 0;

      if ($friend['user_from'] == $user['id']) {
        $friendid = $friend['user_to'];
      } else {
        $friendid = $friend['user_from'];
      }

      $friend_online = $conn->prepare("SELECT * FROM users WHERE id=:friendid");
      $friend_online->bindParam(':friendid', $friendid, PDO::PARAM_INT);
      $friend_online->execute();
      
      $finfo = $friend_online->fetch(PDO::FETCH_ASSOC);

      // <iframe height=\"100\" width=\"100\" src=\"http://voblox.ga/api/getAvatar.php?id={$friendid}&size=85\" frameborder=\"0\" scrolling=\"no\"></iframe>

      $usr = $conn->prepare("SELECT * FROM users WHERE id=:friendid LIMIT :thispagefirstresult,:resultsperpage");
      $usr->bindParam(':friendid', $friendid, PDO::PARAM_INT);
      $usr->bindParam(':thispagefirstresult', $thispagefirstresult, PDO::PARAM_INT);
      $usr->bindParam(':resultsperpage', $resultsperpage, PDO::PARAM_INT);
      $usr->execute();
      
      $usr = $usr->fetch(PDO::FETCH_ASSOC);
      echo "<td><div class=\"Friend\">
              <div class=\"Avatar\">
                <a title=\"{$usr['username']}\" href=\"/User.php?id=$friendid\" style=\"display:inline-block;max-height:100px;max-width:100px;cursor:pointer;\">
                  <img src='data:image/png;base64, ".$usr['thumbnail']."' width='100'>
                </a>
              </div>
              <div class=\"Summary\">
                <span class=\"OnlineStatus\">";
      $onlinetest = ($finfo['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
      echo"$onlinetest</span>
                <span class=\"Name\"><a href=\"/User.php?id=$friendid\">{$usr['username']}</a></span>
              </div>
            </div></td>";
      $total++;
      $row++;

      if ($row >= 3) {
        echo "</div><div class=\"columns\">";
        $row = 0;
      }
    }
  }
  echo "</div>";
}
?></tr>
            <tr>
                                                <?php
    echo "<div class=\"columns\">";
    $total = 0;
    $row = 0;

    $resultsperpage = 3;

    $numberofpages = ceil($usercount / $resultsperpage);

    if (!isset($_GET['page'])) {
        $page = 2;
    } else {
        $page = $_GET['page'];
    }

    $thispagefirstresult = ($page - 1) * $resultsperpage;

    $friendpage = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR (`user_to` = :user_id AND `arefriends`='1') LIMIT :start, :limit");
    $friendpage->bindParam(":user_id", $user['id'], PDO::PARAM_INT);
    $friendpage->bindParam(":start", $thispagefirstresult, PDO::PARAM_INT);
    $friendpage->bindParam(":limit", $resultsperpage, PDO::PARAM_INT);
    $friendpage->execute();

    while ($friend = $friendpage->fetch(PDO::FETCH_ASSOC)) {
        if ($total <= 5) {
            $friendid = 0;

            if ($friend['user_from'] == $user['id']) {
                $friendid = $friend['user_to'];
            } else {
                $friendid = $friend['user_from'];
            }

            $friend_online = $conn->prepare("SELECT * FROM users WHERE id=:friend_id");
            $friend_online->bindParam(":friend_id", $friendid, PDO::PARAM_INT);
            $friend_online->execute();
            $finfo = $friend_online->fetch(PDO::FETCH_ASSOC);

            $uesr = $conn->prepare("SELECT * FROM users WHERE id=:friend_id");
            $uesr->bindParam(":friend_id", $friendid, PDO::PARAM_INT);
            $uesr->execute();
            $uesr = $uesr->fetch(PDO::FETCH_ASSOC);

            echo "<td><div class=\"Friend\">
                <div class=\"Avatar\">
                    <a title=\"{$uesr['username']}\" href=\"/User.php?id=$friendid\" style=\"display:inline-block;max-height:100px;max-width:100px;cursor:pointer;\">
                        <img src='data:image/png;base64, ".$uesr['thumbnail']."' width='100'>
                    </a>
                </div>
                <div class=\"Summary\">
                    <span class=\"OnlineStatus\">";
            $onlinetest = ($finfo['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
            echo "$onlinetest</span>
                    <span class=\"Name\"><a href=\"/User.php?ID=$friendid\">{$uesr['username']}</a></span>
                </div>
            </div></td>";
            $total++;
            $row++;

            if ($row >= 3) {
                echo "</div><div class=\"columns\">";
                $row = 0;
            }
        }
    }
    echo "</div>";
?></tr></tbody></table>
                      </div>
        </div>
        <div id="FavoritesPane" style="clear: right; margin: 10px 0 0 0; border: solid 1px #000;">
            <div>
                    <style>
                        #FavoritesPane #Favorites h4
                        {
                              background-color: #ccc;
                              border-bottom: solid 1px #000;
                              color: #333;
                              font-family: Comic Sans MS,Verdana,Sans-Serif;
                              margin: 0;
                              text-align: center;
                          }
                          #Favorites .PanelFooter
                          {
                    background-color: #fff;
                    border-top: solid 1px #000;
                    color: #333;
                    font-family: Verdana,Sans-Serif;
                    margin: 0;
                    padding: 3px;
                    text-align: center;
                }
                #UserContainer #AssetsContent .HeaderPager, #UserContainer #FavoritesContent .HeaderPager
                {
                    margin-bottom: 10px;
                }
                #UserContainer #AssetsContent .HeaderPager, #UserContainer #FavoritesContent .HeaderPager, #UserContainer #AssetsContent .FooterPager, #UserContainer #FavoritesContent .FooterPager {
                    margin: 0 12px 0 10px;
                    padding: 2px 0;
                    text-align: center;
                }
                      </style>
              <div id="Favorites">
                <h4>Favorites</h4>
                <div id="FavoritesContent">This user does not have any favorites for this type</div>
                <div class="PanelFooter">
                  Category:&nbsp;
                  <select id="FavCategories">
                    <option value="7">Heads</option>
                    <option value="8">Faces</option>
                    <option value="2">T-Shirts</option>
                    <option value="5">Shirts</option>
                    <option value="6">Pants</option>
                    <option value="1">Hats</option>
                    <option value="4">Decals</option>
                    <option value="3">Models</option>
                    <option selected="selected" value="0">Places</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
    </div>
<div id="ctl00_cphRoblox_pUserAssets">

      <div id="UserAssetsPane">
        <div id="ctl00_cphRoblox_rbxUserAssetsPane_upUserAssetsPane">
    
    <div id="UserAssets">
      <h4>Stuff</h4>
      <div id="AssetsMenu">
        
      <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'head') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'head') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=head">Heads</a>
    </div>
                  
       <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'face') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'face') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=face">Faces</a>
    </div>
       
      <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'hat') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'hat') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=hat">Hats</a>
    </div>
         
       <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'tshirt') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'tshirt') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=tshirt">T-Shirts</a>
    </div>
        
            <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'shirt') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'shirt') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=shirt">Shirts</a>
    </div>
      
      <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'pants') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'pants') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=pants">Pants</a>
    </div>
                  
      <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'decal') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'decal') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=decal">Decals</a>
    </div>
                  
                 
      <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'model') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'model') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=model">Models</a>
    </div>
                  
       <div id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelectorPanel" class="<?php if($_GET['wtype'] == 'place') { ?>
        AssetsMenuItem_Selected
        <?php }else{ echo"AssetsMenuItem"; ?>
                <? } ?>">
      <a id="ctl00_cphRoblox_rbxUserAssetsPane_AssetCategoryRepeater_ctl01_AssetCategorySelector" class="<?php if($_GET['wtype'] == 'place') { ?>
        AssetsMenuButton_Selected
        <?php }else{ echo"AssetsMenuButton"; ?>
                <? } ?>" href="/User.php?ID=<?php echo $user['id'] ?>&wtype=place">Places</a>
    </div>
     
          
      </div>
      <div id="AssetsContent">
       <div id="HeaderPager">
          <span id="ctl00_cphRoblox_rbxUserAssetsPane_HeaderPagesPanel">
            <span class="Label">Pages:</span>
            
            <a id="ctl00_cphRoblox_rbxUserAssetsPane_HeaderPageSelector_Next" class="PageSelector" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$HeaderPageSelector_Next','')">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
          </span>
        </div>
        <table id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList" cellspacing="0" border="0">
      <tr>
       
           <?php
                  $itemsq = $conn->query("SELECT * FROM owned_items WHERE ownerid='".$user["id"]."' AND type='".$querytype."'");
while($row = $itemsq->fetch(PDO::FETCH_ASSOC)) {
    $itemq = $conn->query("SELECT * FROM catalog WHERE id='".$row['itemid']."'");

    $item = $itemq->fetch(PDO::FETCH_ASSOC);

    $thumburl = $item['thumbnail'];

    $iteml = $conn->query("SELECT * FROM users WHERE id='".$item['creatorid']."'");

    $user = $iteml->fetch(PDO::FETCH_ASSOC);

                  



                  $id = htmlspecialchars($row['assetid']);
                  $name = htmlspecialchars($item['name']);
                    $price = htmlspecialchars($item['price']); 
                     $css = htmlspecialchars($item['price']);                 
                  $creator = htmlspecialchars($user['username']);
                   $creatorid = htmlspecialchars($user['id']);                  
                  if ($item['buywith'] == "tix") {
            $cssprice = "PriceInTickets";
          }else{
             if ($item['buywith'] == "robux") {
            $cssprice = "PriceInRobux";
          }
     }
                                        if ($item['buywith'] == "tix") {
            $pricename = "Tx";
          }else{
             if ($item['buywith'] == "robux") {
            $pricename = "R$";
          }
     }
                  echo"<td class=\"Asset\" valign=\"top\" style=\"display:inline-block;cursor:pointer;\">
              <div style=\"display:inline-block;cursor:pointer;\">
            <div class=\"AssetThumbnail\">
              <a id=\"ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetThumbnailHyperLink\" title=\"The Crimson Catseye\" href=\"/item.php?id={$item['id']}\" style=\"display:inline-block;cursor:pointer;\"><img width=100px src=\"$thumburl\" border=\"0\" id=\"img\" alt=\"The Crimson Catseye\" blankurl=\"http://t6.roblox.com:80/blank-110x110.gif\"/></a>
            </div>
            <div class=\"AssetDetails\">
              <div class=\"AssetName\"><a id=\"ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_AssetNameHyperLink\" href=\"item.php?id={$item['id']}\">$name</a></div>
              <div class=\"AssetCreator\"><span class=\"Label\">Creator:</span> <span class=\"Detail\"><a id=\"ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl00_GameCreatorHyperLink\" href=\"/User.php?id=$creatorid\">$creator</a></span></div>
              
                <div class=\"AssetPrice\"><span class=\"$cssprice\">$pricename: $price</span></div>
            </div>";
                  

                                  }
                                  ?>
                
<?php 
$checkt = $conn->prepare("SELECT * FROM owned_items WHERE ownerid=:ownerid AND type=:querytype");
$checkt->bindParam(':ownerid', $user["id"]);
$checkt->bindParam(':querytype', $querytype);
$checkt->execute();
if($checkt->rowCount() == 0) {
if($querytype == "pants") {
echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='display:inline-block;cursor:pointer;'></div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
}
  ?>
              <?php
  if(is_null($_GET["wtype"])) {
    $querytype = "item";
    }
  if($querytype == "tshirt") {
    echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='display:inline-block;cursor:pointer;'></div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
    }
     if($querytype !== "pants") {
     if($querytype !== "tshirt") {
         
echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='display:inline-block;cursor:pointer;'></div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
}
  }
                   }
    
          
                                    
     ?>
              <?php
       if(is_null($_GET["wtype"])) {
    echo"<tr>
        <td class='tablebody'>
            <div id='wardrobe' style='display:inline-block;cursor:pointer;'>Please select a category.</div>
        <div style='clear:both;'></div>
      </td>
    </tr>";
      }
    
                                  ?>
          </div>
          </div>
        </div>

      </div>
      </tr>
    </table>
        <div id="FooterPager">
          <span id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagesPanel">
            <span class="Label">Pages:</span>
            
            <a id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPageSelector_Next" class="PageSelector" href="javascript:__doPostBack('ctl00$cphRoblox$rbxUserAssetsPane$FooterPageSelector_Next','')">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
          </span>
        </div>
      </div>
      <div style="clear:both;"></div>
    </div>
  
  </div>
      </div>
    
</div>
  </div>
  

        </div>
<div style="clear:both"></div>
    <?php
    require ("inc/footer.php");
    ?>