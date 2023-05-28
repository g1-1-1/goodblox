<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';
if($isloggedin !== 'yes') {header('location: /login.aspx');}
$msg = $conn->query("SELECT * FROM friends WHERE user_to='{$_USER['id']}' AND arefriends='0' ORDER BY id DESC") or die($conn->errorInfo()[2]);
?>
<div id="Body">
<div id="UserContainer">
  <div id="LeftBank">
    <div>
      <div id="ProfilePane">
        <table width="100%" bgcolor="lightsteelblue" cellpadding="6" cellspacing="0">
          <tbody><tr>
            <td>
              <span class="Title">Welcome, <?php echo $_USER['username']; ?>!</span><br>
            </td>
          </tr>
          <tr>
            <td>
              <span>Your <?=$sitename ?>:</span><br>
              <a href="/User.aspx?ID=<?php echo $_USER['id']; ?>">https://www.god.ct8.pl/User.aspx?ID=<?php echo $_USER['id']; ?></a>
              <br>
              <br>
              <div style="left: 0px; float: left; position: relative; top: 0px;margin-top:67px;margin-left:10px">
                <a disabled="disabled" onclick="return false" style="display:inline-block;height:220px;width:180px;">
                  <img src="data:image/png;base64, <?php echo $_USER['thumbnail'] ?>" width="200" height="200">
                </a>
                <br>
              </div>
            <div style="float:right;text-align:left;width:210px;">
              <p><a href="/My/Inbox.aspx">Inbox</a>&nbsp;</p>
              <p><a href="/My/Character.aspx">Change Character</a></p>
              <p><a href="/My/Settings.aspx">Edit Profile</a></p>
              <p><a href="/Upgrades/BuildersClub.aspx">Account Upgrades</a></p>
              <p><a href="/My/Balance.aspx">Account Balance</a></p>
              <p><a href="/User.aspx?ID=<?php echo $_USER['id']; ?>">View Public Profile</a></p>
              <p>
                                <a href="/My/CreatePlace.aspx">Create New Place</a>              </p>
              <p><a href="#">Share <?=$sitename;?></a></p>
              <p><a href="/Upgrades/Robux.aspx">Buy <?=$robuxname;?></a></p>
              <p><a href="#">Trade Currency</a></p>
              <p><a href="#">Ad Inventory</a></p>
              <p><a href="/info/TermsOfService.aspx">Terms, Conditions, and Rules</a></p>
              </div>
            </td>
            
          </tr>
        </tbody></table>
        <?php if($_USER['BC'] == 'BC') {    ?>
        <div class="Header">
                <h4>Builders Club Member until <?php echo $_USER['BCExpire'];?></h4>
           </div>
        <?php } ?>
              </div>
    </div>
       

    <div>  <div id="UserBadgesPane">
      <div id="UserBadges">
        <h4><a href="/Badges">Badges</a></h4>
        <table cellspacing="0" border="0" align="Center">
          <tbody>
          <td>
      <?php if($_USER['USER_PERMISSIONS'] == 'Administrator') {    ?> 
      <div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/Badges/Administrator-75x75.png" title="This badge identifies an account as belonging to a <?php echo $sitename ?> administrator. Only official <?php echo $sitename ?> administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter's account." alt="Administrator-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges">Administrator</a>
                </div>
              </div>
      <?php } ?>
      <?php if($_USER['BC'] == 'BC') {    ?>
              <td><td><div class="Badge">
                <div class="BadgeImage">
                  <img src="/images/Badges/BuildersClub-75x75.png" title="This badge is given to builders club members on the site." alt="BuildersClub-75x75"><br>
                  <div class="BadgeLabel"><a href="/Badges">Builders Club</a>
                </div>
              </div>
      <?php } ?>
      </tr>
</tbody></table>

</div>
      </div>

    <div id="UserStatisticsPane">
          <div id="UserStatistics">
            <div id="StatisticsPanel" style="transition: height 0.5s ease-out 0s; overflow: hidden; height: 200px;">
              <div class="Header">
                <h4>Statistics</h4>
                <span class="PanelToggle"></span>
              </div>
              <div style="margin: 10px 10px 150px 10px;" id="Results">
                <div class="Statistic">
                  <div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
                  <div class="Value"><span>0</span></div>
                </div>
                                <div class="Statistic">
                  <div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
                  <div class="Value"><span>0</span></div>
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
      </div>
    </div>
  </div>
  <style>
  #RightBankTest {
    float: right;
    text-align: center;
    width: 444px;
    margin-bottom: 20px;
}
</style>
<div id="RightBankTest">
    <div>
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
                    $stmt->bindParam(':creator_id', $_USER['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $usersResult = $stmt->fetchAll();
                    $thejlol = count($usersResult);
                    if ($thejlol == 0) {
                        ?>
                        <style>.thingg{display:none!important;}</style>
                        <div id="UserPlacesPane" style="border: 0px!important;">
                            <p style="padding:10px">You don't have any <?=$sitename;?> places.</p>     
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
$yourl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$launcherlink = "/Login/Default.aspx?ReturnUrl=".$yourl;
}else{
$launcherlink = $uriname."://?placeid=".$rowUser['id']."&accountcode=".$_USER['accountcode'];
}
?>
<div class="PlayOptions">
                                <a href="<?=$launcherlink;?>"><img id="MultiplayerVisitButton" class="ImageButton" src="/images/Play.png" alt="Visit Online"></a>
                                    </div>
<div class="Statistics">
<span>Visited 0 times (0 last week)</span>
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
      
    
</div></div>
      <div id="FriendsPane" style="background-color:white;">
        <div id="Friends">
            <?php
$friendnew = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR  (`user_to` = :user_id AND `arefriends`='1')");
$friendnew->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);
$friendnew->execute();
$friendcountm = $friendnew->rowCount();

?>
<h4>My friends <a href="/friends?of=<?php echo $_USER['id']; ?>">See all <?php echo $friendcountm; ?></a>
    (<a href="/friends/edit">Edit</a>)
</h4>          
<table cellspacing="0" align="Center" border="0" style="border-collapse:collapse;">
    <tbody>
        <tr>
            <?php
            $resultsperpage = 3;
            $check = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR  (`user_to` = :user_id AND `arefriends`='1')");
            $check->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);
            $check->execute();

            $usercount = $check->rowCount();
            $numberofpages = ceil($usercount/$resultsperpage);
            $page = 1;
            $thispagefirstresult = ($page-1)*$resultsperpage;

$friendq = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR (`user_to` = :user_id AND `arefriends`='1') LIMIT :pagefirstresult, :resultsperpage");
$friendq->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);
$friendq->bindParam(':pagefirstresult', $thispagefirstresult, PDO::PARAM_INT);
$friendq->bindParam(':resultsperpage', $resultsperpage, PDO::PARAM_INT);
$friendq->execute() or die(print_r($conn->errorInfo(), true));

$friendnew = $conn->prepare("SELECT * FROM friends WHERE (`user_from` = :user_id AND `arefriends`='1') OR (`user_to` = :user_id AND `arefriends`='1')");
$friendnew->bindParam(':user_id', $_USER['id'], PDO::PARAM_INT);
$friendnew->execute() or die(print_r($conn->errorInfo(), true));

$friendcount = $friendnew->rowCount();

if ($friendcount < 1) {
    echo "<p style=\"padding: 10px 10px 10px 10px;\">You don't have any $sitename friends.</p>";
} else {
    echo "<div class=\"columns\">";
    $total = 0;
    $row = 0;

    while ($friend = $friendq->fetch(PDO::FETCH_ASSOC)) {
        if ($total <= 5) {
            $friendid = 0;

            if ($friend['user_from'] == $_USER['id']) {
                $friendid = $friend['user_to'];
            } else {
                $friendid = $friend['user_from'];
            }

            $friend_online = $conn->prepare("SELECT * FROM users WHERE id=:friendid");
$friend_online->bindParam(':friendid', $friendid, PDO::PARAM_INT);
$friend_online->execute() or die(print_r($conn->errorInfo(), true));
$finfo = $friend_online->fetch(PDO::FETCH_ASSOC);

$usr = $conn->prepare("SELECT * FROM users WHERE id=:friendid LIMIT :pagefirstresult,:resultsperpage");
$usr->bindParam(':friendid', $friendid, PDO::PARAM_INT);
$usr->bindParam(':pagefirstresult', $thispagefirstresult, PDO::PARAM_INT);
$usr->bindParam(':resultsperpage', $resultsperpage, PDO::PARAM_INT);
$usr->execute() or $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$row = $usr->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

echo "<td><div class=\"Friend\">
    <div class=\"Avatar\">
        <a title=\"{$row['username']}\" href=\"/user.php?id=$friendid\" style=\"display:inline-block;max-height:100px;max-width:100px;cursor:pointer;\">
            <img src=\"data:image/png;base64, ".$row['thumbnail']."\" width=\"95\" border=\"0\" alt=\"{$row['username']}\" blankurl=\"http://t6.roblox.com:80/blank-100x100.gif\">
        </a>
    </div>
    <div class=\"Summary\">
        <span class=\"OnlineStatus\">
";  
                        
$onlinetest = ($finfo['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
echo "$onlinetest</span>

<span class=\"Name\"><a href=\"/User.php?id=$friendid\">{$row['username']}</a></span>
</div>
</div></td>";
$total++;
$row++;

if ($row >= 3) {
    echo "</div><div class=\"columns\">";
    $row = 0;
}

              }}
              echo "</div>";
            }
            ?></tr></tbody></table>

<style>
fix {
    display: table-cell;
    vertical-align: inherit;
}
</style></div>
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
                <script>
                    function getFavs(type,page)
                    {
                      if(page == undefined){ page = 1; }
                        $.post("https://error", {uid:5657,type:type,page:page}, function(data)
                        {
                          $("#FavoritesContent").empty();
                            $("#FavoritesContent").html(data);
                        })
                        .fail(function()
                        {
                            $("#FavoritesContent").html("Failed to get favourites");
                        });
                    }
                    $(function()
                    {
                        $("#FavCategories").on("change", function()
                        {
                            getFavs(this.value);
                        });
                        getFavs(0);
                    });
                </script>
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
    <br>
  <div id="FriendRequestsPane">
    <div id="FriendRequests">
      <span id="FriendRequestsHeaderLabel"><h4>My Friend Requests</h4></span>
      <table cellspacing="0" border="0" style="border-collapse:collapse;">
        <tbody><tr>
<?php
        if ($msg->rowCount() < 1) {
          die ("<p style='padding: 10px 10px 10px 10px;'>You don't have any $sitename Friend Requests.</p>");
        }
        ?>
<?php
    while ($message = $msg->fetch(PDO::FETCH_ASSOC)) {
      $stmt = $conn->prepare("SELECT * FROM users WHERE id=:user_id");
      $stmt->bindParam(':user_id', $message['user_from']);
      $stmt->execute();
      $userrrrr = $stmt->fetch(PDO::FETCH_ASSOC);
      
      $binner = "";
      $bouter = "";

      echo "<tr>
        <td><img src='../images/AvatarPlaceholder.png' width=\"95\"></td>
        <td>$binner{$userrrrr['username']}$bouter</td>
        <td><button class=\"button is-success\" onclick=\"document.location = '/api/AddFriend.php?id={$message['user_from']}&from_rq_page=true'\">Accept</button> &nbsp;<button class=\"button is-danger\" onclick=\"document.location = '/api/RemoveFriend.php?id={$message['user_from']}&from_rq_page=true'\">Decline</button></td>
      </tr>";
    }
    ?>

                                               </tr>
      </tbody></table>
    </div>
  </div>
    <div>
  </div>
</div>
<div style="clear: both;"></div>
                <?php
  include $_SERVER["DOCUMENT_ROOT"].'/inc/footer.php';
  ?>