<?php
include("../inc/header.php");
include("../inc/nav.php");
$topic = $_GET['ForumID'] ?? 1;

$topic = intval($topic);

                    $resultsperpage = 15;
                    $check = $conn->query("SELECT * FROM forum WHERE category='$topic' AND reply_to='0' ORDER BY is_pinned DESC, time_posted DESC");
                    $usercount = $check->rowCount();

                    $numberofpages = ceil($usercount/$resultsperpage);

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    }else{
                        $page = $_GET['page'];
                    }

                    $thispagefirstresult = ($page-1)*$resultsperpage;



$threadsperpage = 20;
$stmt = $conn->query("SELECT id FROM forum WHERE category='$topic' AND reply_to='0' ORDER BY is_pinned DESC, time_posted DESC");
$total = $stmt->rowCount();

$pages = ceil($total / $threadsperpage);

$page = $_GET['page'] ?? 0;
$page = intval($page);

if ($page < 0) $page = 0;
if ($page > $pages - 1) $page = $pages - 1;

$offset = $page * $threadsperpage;

$fq = $conn->prepare("SELECT * FROM forum WHERE category=:topic AND reply_to='0' ORDER BY is_pinned DESC, time_posted DESC LIMIT :limit OFFSET :offset");
$fq->bindValue(':topic', $topic);
$fq->bindValue(':limit', $resultsperpage, PDO::PARAM_INT);
$fq->bindValue(':offset', $thispagefirstresult, PDO::PARAM_INT);
$fq->execute();
  
$stmt_topicsql = $conn->prepare("SELECT * FROM topics WHERE id = :topic");
$stmt_topicsql->bindParam(':topic', $topic, PDO::PARAM_INT);
$stmt_topicsql->execute();
$topicsql = $stmt_topicsql->fetch(PDO::FETCH_ASSOC);

$topics = $topicsql;

$stmt_groupq = $conn->prepare("SELECT * FROM forumgroups WHERE id = :category");
$stmt_groupq->bindParam(':category', $topicsql['category'], PDO::PARAM_INT);
$stmt_groupq->execute();
$groupq = $stmt_groupq->fetch(PDO::FETCH_ASSOC);
$group = $groupq;



?>
<title>
  <?=$title?>
</title>
 <div id="Body">
     <style>
/*****************************************************
General Anchor
*****************************************************/
a.linkSmallBold, a.linkMenuSink
{
    font-weight: bold;
}

a.linkSmall, a.LinkSmallBold, a.linkMenuSink
{
    color: navy;
    font-size: 10px;
}


a.linkSmallBold:visited, a.linkMenuSink:visited
{
    color: #013DA4;
}

a.linkSmallBold:Hover, a.linkMenuSink:Hover
{
    color: #DD6900;
}


/*****************************************************
Text and Anchor to display when a user is online
*****************************************************/
.userOnlineLinkBold, a.userOnlineLinkBold, a.userOnlineLinkBold:Visited, a.userOnlineLinkBold:Hover, a.userOnlineLinkBold:Link
{
    font-weight: bold;
    color: #0055E7;
}

.moderatorOnlineLinkBold, a.moderatorOnlineLinkBold, a.moderatorOnlineLinkBold:Visited, a.moderatorOnlineLinkBold:Hover, a.moderatorOnlineLinkBold:Link
{
    font-weight: bold;
    color: darkblue;
}

.adminOnlineLinkBold, a.adminOnlineLinkBold, a.adminOnlineLinkBold:Visited, a.adminOnlineLinkBold:Hover, a.adminOnlineLinkBold:Link
{
    font-weight: bold;
    color: black;
}

/*****************************************************
Text and anchors used in the navigation menu
*****************************************************/
.menuTitle
{
    font-weight: bold;
    font-size: 20px;
    font: normal 8pt/normal Verdana, sans-serif;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    color: navy;
}

.menuText
{
    font-size: 0.9em;
    font-weight: bold;
    font: normal 8pt/normal Verdana, sans-serif;
    color: #FFFFFF;
}

a.menuTextLink:visited, a.menuTextLink:link
{
    font-size: 0.9em;
    text-decoration: none; 
    font: normal 8pt/normal Verdana, sans-serif;
    color: #013DA4;
}

a.menuTextLink:Hover
{
    color: #000000;
}


/*****************************************************
Text and anchors used in the search
*****************************************************/
.searchPager
{
    font-size : 0.9em;
    font-weight: bold;
}

.searchItem
{
    background-color: #DDEEFF; 
}

.searchAlternatingItem
{
    background-color: #FFFFFF;
}


/*****************************************************
Default separator style for PostList
*****************************************************/
td.flatViewSpacing
{
    height: 2px;
    background-color: #80B7FF;
}

/*****************************************************
Table Header and cell definitions
*****************************************************/
th
{
    background-image: url(/Forum/api/skins/default/images/forumHeaderBackground.gif);
    background-color: #4455aa
}

td.forumHeaderBackgroundAlternate
{
    background-image: url(/Forum/api/skins/default/images/forumHeaderBackgroundAlternate.gif);
    background-color: #EBEDF6;
}

/*****************************************************
Body
*****************************************************/
body 
{
    FONT-SIZE: 8pt;
    font: normal 8pt/normal Verdana, sans-serif;
    scrollbar-face-color: #DEE3E7;
    scrollbar-highlight-color: #FFFFFF;
    scrollbar-shadow-color: #DEE3E7;
    scrollbar-3dlight-color: #D1D7DC;
    scrollbar-arrow-color:  #006699;
    scrollbar-track-color: #EFEFEF;
    scrollbar-darkshadow-color: #98AAB1;
}


/*****************************************************
Validation Text
*****************************************************/
.validationWarningSmall
{
    color: Red;
    font-size : 0.9em;
}

/*****************************************************
General Text
*****************************************************/
.normalTextSmall 
{ 
    font-size : 12px;
}

.normalTextSmallBold
{ 
    font-size : 12px;
    font-weight: bold;
}

.normalTextSmaller
{
    font-size: 10px;
}

.normalTextSmall, .normalTextSmallBold, .normalTextSmaller
{ 
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
}

/*****************************************************
Text used on tables with a background
*****************************************************/
.tableHeaderText
{
    color: white;
    font-size: 10px;
    font-weight:bold;
    font: normal 8pt/normal Verdana, sans-serif;
}

/*****************************************************
Border used around tables
*****************************************************/
.tableBorder
{
    border: 1px #013DA4 solid; 
    background-color: #FFFFFF;
}

/*****************************************************
Main forum colors
*****************************************************/
td.forumRow
{
    background-color: #DDEEFF;
}


td.forumAlternate
{
    background-color: #DAE7FD;
}

/*****************************************************
Background color and text used in threaded view
*****************************************************/
td.threadTitle
{
    background-color: #D4D9EC;
}

.threadDetailTextSmall
{
    color: #0055E7;
    font-size: 0.9em;
}

.threadDetailTextSmallBold
{
    color: #0055E7;
    font-size: 0.9em;
    font-weight: bold;
    font: normal 8pt/normal Verdana, sans-serif;
}

td.forumRowHighlight
{
    background-color: #D4D9EC;
}

/*****************************************************
Text and links used in ForumGroupRepeater and ForumRepeater
*****************************************************/
.forumTitle
{
    font-size: 1.0px;
    font-weight: bold;
    font: normal 8pt/normal Verdana, sans-serif;
    color: #013DA4;
}


a.forumTitle:visited, a.forumTitle:link
{
    font-size: 1.0em;
    font-weight: bold;
    color: #013DA4;
}

a.forumTitle:hover
{
    color: #DD6900;
}

.forumName
{
    font-weight: bold;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    font-size: 16px; 
    text-decoration: none; 
    color: navy;
}

a.forumName:hover
{
    color: #DD6900;
    text-decoration: underline;
}


/*****************************************************
Form Elements
*****************************************************/
select
{   FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    font-size: 0.9em;
    font-weight: bold;
    background-color: #DAE7FD;
    border-color: Black;
}

textarea
{
    font-size: 0.9em;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    background-color: White;
    border-color: Black;
}

/*****************************************************
Menu Controls
*****************************************************/
A.linkMenuSink
{
    font-size: 0.9em;
    FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    position: relative;
}

TD.popupMenuSink
{
    position: relative;
}

DIV.popupMenu
{
    border: 1px solid blue;
}

DIV.popupTitle
{
  FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    color: white;
    font-weight: bold;
    background-color: #4455AA;
}

DIV.popupItem
{
    font-size: 1.0em;
    font-weight: bold;
  FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
    background-color: #DDEEFF;
}
</style>
<div id="Body">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr><td></td></tr>
                        <tr valign="bottom">
                            <td>
                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr valign="top">
                                            <td>&nbsp; &nbsp; &nbsp;</td>
                                            
                                            <td width="95%" class="CenterColumn">
                                                <br>
                                              <tr>
    <td colspan="2" align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
<table cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
                                  <td width="1px" valign="top" align="left">
                                    <nobr>
                                    </nobr>
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&shy;</span>
                                      <a class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$group['name'];?></a>
                                    </nobr>
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&nbsp;&gt;</span>
                                      <a class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=<?=$topicscheisse['id'];?>"><?=$topics['name'];?></a>
                                    </nobr>
                                  </td>
                                  <td width="*" valign="top" align="left">&nbsp;</td>
                                </tr>
</tbody></table>

<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_MenuScript"></span></span></td>
  </tr>
                                                <span></span>
                                                <span>
                                                    <table cellpadding="0" width="100%">
                                                        <tbody>
                                                            <tr></tr>
                                                            <tr><td>&nbsp;</td></tr>
                                                            <tr>
                                                                <td valign="bottom" align="left">
                                                                    <a href="/Forum/CreatePost.php?t=<?php echo $topic ?>">
                                                                        <img src="/Forum/api/skins/default/images/newtopic.gif" border="0">
                                                                    </a>
                                                                </td>
                                                                <td align="right">
                                                                    <span class="normalTextSmallBold">Search this forum: </span>
                                                                    <input name="ForumSearch" type="text">
                                                                    <input type="submit" name="ForumSearchBtn" value=" Go ">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" colspan="2">
                                                                    <table class="tableBorder" cellspacing="1" cellpadding="3" border="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
    <th class="tableHeaderText" align="left" colspan="2" height="25">&nbsp;Thread&nbsp;</th><th class="tableHeaderText" align="center" nowrap="nowrap">&nbsp;Started By&nbsp;</th><th class="tableHeaderText" align="center">&nbsp;Replies&nbsp;</th><th class="tableHeaderText" align="center">&nbsp;Views&nbsp;</th><th class="tableHeaderText" align="center" nowrap="nowrap">&nbsp;Last Post&nbsp;</th>
  </tr>
      <tr>
      <?php
                $poststmt = $conn->query("SELECT * FROM forum WHERE category='$topic' AND reply_to='0' ORDER BY is_pinned DESC, time_posted DESC LIMIT ".$thispagefirstresult.",".$resultsperpage);
while ($post = $poststmt->fetch(PDO::FETCH_ASSOC)) {
    $authorstmt = $conn->query("SELECT * FROM users WHERE id='{$post['author']}'");
    $author = $authorstmt->fetch(PDO::FETCH_ASSOC);
    $repliesstmt = $conn->query("SELECT id FROM forum WHERE reply_to='{$post['id']}'");
    $replies = $repliesstmt->rowCount();
    if ($replies > 0) {
        $lastreplystmt = $conn->query("SELECT * FROM forum WHERE reply_to='{$post['id']}' ORDER BY id DESC LIMIT 1");
        $lastreply = $lastreplystmt->fetch(PDO::FETCH_ASSOC);
        $lrtimeago2 = new DateTime("@{$lastreply['time_posted']}");
        $lrtimeago = $lrtimeago2->format('d F Y G:i');
        $lrauthorstmt = $conn->query("SELECT * FROM users WHERE id='{$lastreply['author']}'");
        $lrauthor = $lrauthorstmt->fetch(PDO::FETCH_ASSOC);
        $lrstring = "<b>".forumtime($post['time_posted'])."</b> <br> by <a href=\"/Forum/User/UserProfile.aspx?UserName={$author['username']}\">{$author['username']}</a>";
if($post['is_pinned'] > 0){
                    $lrstring = "<b>Pinned Post</b> <br> by <a href=\"/Forum/User/UserProfile.aspx?UserName={$author['username']}\">{$author['username']}</a>";
}
                  }

$icon = "topic_notread.gif";

if($post['is_pinned'] > 0){
if($post['is_locked'] > 0){
                    $icon = "topic-pinned&locked_notread.gif";
}
}

if($post['is_pinned'] > 0){
if($post['is_locked'] <= 0){
                    $icon = "topic-pinned_notread.gif";
}
}

if($post['is_pinned'] <= 0){
if($post['is_locked'] > 0){
                    $icon = "topic-locked_notread.gif";
}
    } else {
        $lrstring = "";
    }
    $lstmt = $conn->query("SELECT * FROM forum WHERE reply_to='{$post['id']}' ORDER BY id DESC LIMIT 1");
    $l = $lstmt->fetch(PDO::FETCH_ASSOC);
    $postimagelol = '/Forum/api/skins/default/images/topic_notread.gif';

                  echo "<tr>
    <td class='forumRow' align='center' valign='middle' width='25'>
<img title='Post' src='/Forum/api/skins/default/images/$icon' border='0'>
</td>
<td class='forumRow' height='25'><a class='linkSmallBold' href='/Forum/ShowPost.php?id={$post['id']}'>{$post['title']}</a>
</td>
<td class='forumRowHighlight' align='left' width='100'>
  &nbsp;
  <a class='linkSmall' href='/User.php?id={$author['id']}'>{$author['username']}</a>
</td>
<td class='forumRowHighlight' align='center' width='50'>
  <span class='normalTextSmaller'>$replies</span>
</td>
<td class='forumRowHighlight' align='center' width='50'><span class='normalTextSmaller'>-</span>
</td>
";
if ($replies > 0) {
echo"
<td class='forumRowHighlight' align='center' width='140' nowrap='nowrap'><span class='normalTextSmaller'><b>$lrtimeago</b>
<br>by </span>
<a class='linkSmall' href='/User.php?id={$lrauthor['id']}'>{$lrauthor['username']}</a>
<a href='/User.php?id={$lrauthor['id']}'>
<img border='0' src='/Forum/api/skins/default/images/icon_mini_topic.gif'></a></td>
  </tr>";
}else{
    $stmt = $conn->prepare("SELECT * FROM forum WHERE id=:id");
$stmt->bindValue(':id', $post['id']);
$stmt->execute();
$tposte = $stmt->fetch(PDO::FETCH_ASSOC);
$lrtimeago1 = new DateTime("@{$tposte['time_posted']}");
$lrtime = $lrtimeago1->format('d F Y G:i');
echo"
<td class='forumRowHighlight' align='center' width='140' nowrap='nowrap'><span class='normalTextSmaller'><b>$lrtime</b>
<br>by </span>
<a class='linkSmall' href='/User.php?id={$author['id']}'>{$author['username']}</a>
<a href='/User.php?id={$author['id']}'>
<img border='0' src='/Forum/api/skins/default/images/icon_mini_topic.gif'></a></td>
  </tr>";
}
                }
                ?>

  </tr>              
  </tr>
                                                                </td>
<?php
                    if(!isset($_GET['page'])) {
                        $paget = 1;
                    }else{
                        $paget = $_GET['page'];
                    }
echo "<span id='ctl00_cphRoblox_ThreadView1_ctl00_Pager'><table cellspacing='0' cellpadding='0' border='0' width='100%'>
<tr>
  <td><span class='normalTextSmallBold'>";
  if($numberofpages == 0) {
  echo"Page $paget of 1";
  }else{
  echo"Page $paget of $numberofpages";
  }
  echo"</span></td><td align='right'><span><span class='normalTextSmallBold'>Goto to page: </span>
";

                    if($numberofpages == 0) {
                    echo"<a id='ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page0' class='normalTextSmallBold' href='/Forum/ShowPost.php?id=$id&page=1'>1</a>";
                    }
                   for ($page=1;$page<=$numberofpages;$page++) {

                        echo "<a id='ctl00_cphRoblox_ThreadView1_ctl00_Pager_Page0' class='normalTextSmallBold' href='/Forum/ShowForum.php?id=$topic&page=$page'>$page</a> ";
                    }
                    echo "  <span class='normalTextSmallBold'></td>
</tr>
</table></span>";
?>
                                                                    </table>
                                                                        </tbody>
                                                                            </tr>
                                                                            
                                                        </table>
                                                        </tbody>
                                                        
                                                        </td>
                                                        </tr>
                                </table>
                            </tbody>
<?php
include("../inc/footer.php");
?>                            </div>
