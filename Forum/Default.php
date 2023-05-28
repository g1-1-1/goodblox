<?php
require ("../inc/header.php");
require ("../inc/nav.php");
$topic = $_GET['t'] ?? 1;

$topic = intval($topic);


$stmt = $conn->prepare("SELECT * FROM forum WHERE category = ? AND reply_to = 0 ORDER BY time_posted DESC");
$stmt->execute([$topic]);
$fq = $stmt->fetchAll(PDO::FETCH_ASSOC);

$forumnow = date('M j, g:i A', time());

?>

<link rel="stylesheet" href="/forumsapi/skins/default/style/default.css" type="text/css">
<div id="Body">
          
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody><tr>
          <td>
            
          </td>
        </tr>
        <tr valign="bottom">
          <td>
            <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
              <tbody><tr valign="top">
                <!-- left column -->
                <td class="LeftColumn">&nbsp;&nbsp;&nbsp;</td>
                <td id="ctl00_cphRoblox_LeftColumn" nowrap="nowrap" width="180" class="LeftColumn">
                  <p>
                    <span id="ctl00_cphRoblox_SearchRedirect">

</span></p><table class="tableBorder" cellspacing="1" cellpadding="3" width="100%">
  <tbody><tr>
    <th class="tableHeaderText" align="left" colspan="2">
      &nbsp;Search <?=$sitename;?> Forums
    </th>
  </tr>
  <tr>
    <td class="forumRow" align="left" valign="top" colspan="2">
      <table cellspacing="1" border="0" cellpadding="2">
        <tbody><tr>
          <td>
            <input name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchText" type="text" maxlength="50" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchText" size="10">
          </td>

          <td align="right" colspan="2">
            <input type="submit" name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchButton" value="Search" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchButton">
          </td>
        </tr>
      </tbody></table>
      <span class="normalTextSmall">
      <br>
      <a href="Search/default.aspx">More search options</a>
      </span>
    </td>
  </tr>
</tbody></table>




                    <br>
                    
                    <br>
                </td><td class="LeftColumn">&nbsp;&nbsp;&nbsp;</td>
                <!-- center column -->
                <td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
                <td id="ctl00_cphRoblox_CenterColumn" width="95%" class="CenterColumn">
                  <span id="ctl00_cphRoblox_NavigationMenu2">
<table width="100%" cellspacing="1" cellpadding="0">
  <tbody><tr>
    <td align="right" valign="middle">
      <a id="ctl00_cphRoblox_NavigationMenu2_ctl00_HomeMenu" class="menuTextLink" href="/Forum/Default.aspx"><img src="/forumsapi/skins/default/images/icon_mini_home.gif" border="0">Home &nbsp;</a>
      <a id="ctl00_cphRoblox_NavigationMenu2_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx"><img src="/forumsapi/skins/default/images/icon_mini_search.gif" border="0">Search &nbsp;</a>
      
      <?php if(!$_USER){?> 
      <a id="ctl00_cphRoblox_NavigationMenu2_ctl00_RegisterMenu" class="menuTextLink" href="/Forum/User/CreateUser.aspx"><img src="/forumsapi/skins/default/images/icon_mini_register.gif" border="0">Register &nbsp;</a>
      <?}else{?>
      <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_ProfileMenu" class="menuTextLink" href="/Forum/User/EditUserProfile.aspx"><img src="/forumsapi/skins/default/images/icon_mini_profile.gif" border="0">Profile &nbsp;</a>

      <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_MyForumsMenu" class="menuTextLink" href="/Forum/User/MyForums.aspx"><img src="/forumsapi/skins/default/images/icon_mini_myforums.gif" border="0">MyForums &nbsp;</a>
<?}?>
      
      
      
    </td>
  </tr>
</tbody></table>
</span>
                  <br>
                  <table cellpadding="0" cellspacing="2" width="100%">
                    <tbody><tr>
                      <td align="left">
                        <span class="normalTextSmallBold">Current time: </span><span class="normalTextSmall"><?=$forumnow;?></span>
                      </td>
                      <td align="right">
                        
                      </td>
                    </tr>
                  </tbody></table>
                  <table cellpadding="2" cellspacing="1" border="0" width="100%" class="tableBorder"><tbody><tr>
  <th class="tableHeaderText" colspan="2" height="20">Forum</th><th class="tableHeaderText" width="50" nowrap="nowrap">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th><th class="tableHeaderText" width="50" nowrap="nowrap">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th><th class="tableHeaderText" width="135" nowrap="nowrap">&nbsp;Last Post&nbsp;</th>
</tr>





<?

$groupium1 = $conn->query("SELECT * FROM forumgroups ORDER BY id ASC");
while($groupium = $groupium1->fetch(PDO::FETCH_ASSOC)){
?>

<tr id="ctl00_cphRoblox_ForumGroupRepeater1_ctl01_ForumGroup">
  <td class="forumHeaderBackgroundAlternate" colspan="5" height="20"><a id="ctl00_cphRoblox_ForumGroupRepeater1_ctl01_GroupTitle" class="forumTitle" href="ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$groupium['name'];?></a></td>
</tr>

<?
$cat1sql = $conn->query("SELECT * FROM topics WHERE category = '".$groupium['id']."' ORDER BY id ASC");
while($cat1 = $cat1sql->fetch(PDO::FETCH_ASSOC)){

$catthreads = $conn->query("SELECT * FROM forum WHERE category='".$cat1['id']."' AND reply_to='0'")->rowCount();
$catreplies = $conn->query("SELECT * FROM forum WHERE category='".$cat1['id']."'")->rowCount();

$lp7q = $conn->query("SELECT * FROM forum WHERE category='".$cat1['id']."' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$lp7a = $conn->query("SELECT * FROM users WHERE id='{$lp7q['author']}'")->fetch(PDO::FETCH_ASSOC);
?>
<tr>
  <td class="forumRow" align="center" valign="top" width="34" nowrap="nowrap"><img src="/forumsapi/skins/default/images/forum_status.gif" width="34" border="0"></td><td class="forumRow" width="80%"><a class="forumTitle" href="ShowForum.aspx?ForumID=<?=htmlentities($cat1['id']);?>"><?=htmlentities($cat1['name']);?></a><span class="normalTextSmall"><br><?=htmlentities($cat1['description']);?></span></td><td class="forumRowHighlight" align="center"><span class="normalTextSmaller"><?=$catthreads;?></span></td><td class="forumRowHighlight" align="center"><span class="normalTextSmaller"><?=$catreplies;?></span></td><td class="forumRowHighlight" align="center"><span class="normalTextSmaller"><span><b><center><?=forumtime($lp7q['time_posted']);?><br>by <a href="/Forum/User/UserProfile.aspx?UserName=<?=htmlentities($lp7a['username']);?>"><?=htmlentities($lp7a['username']);?></a></center><a href="#"><img border="0" src="/forumsapi/skins/default/images/icon_mini_topic.gif"></a></b></span></span></td>
</tr>

<?}?>

<?}?>


                    
</tbody></table> 


                </td><td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
                <!-- right margin -->
                <td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
                
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody></table>

        </div></div>

</div></div></div></div></div></div></div></div></div></div></div></div>

<? include("../inc/footer.php"); ?>