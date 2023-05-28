<?php
require ("../../inc/header.php");
require ("../../inc/nav.php");

if($_USER['USER_PERMISSIONS'] !== 'Administrator') {header('location: /Forum/Default.aspx');}

?>

<link rel="stylesheet" href="/forumsapi/skins/default/style/default.css" type="text/css">
<div id="Body">

<?php
$id = $_GET['PostID'] ?? 0;

$id = intval($id);

$resultsperpage = 25;

$check = $conn->query("SELECT * FROM forum WHERE reply_to='$id'");
$usercount = $check->rowCount();

$numberofpages = ceil($usercount/$resultsperpage);

if(!isset($_GET['PageIndex'])) {
    $page = 1;
}else{
    $page = intval($_GET['PageIndex']);
}

$thispagefirstresult = ($page-1)*$resultsperpage;

$fr = $conn->query("SELECT * FROM forum WHERE reply_to='$id'");

if($fr->rowCount() > 0){
    $hasreplies = "Yes";
}else{
    $hasreplies = "No";
}

$fq = $conn->query("SELECT * FROM forum WHERE id='$id'");

if ($fq->rowCount() < 1) {
    header("Location: /Forum/Default.aspx?MessageId=6"); die(); exit;
}

$fpost = $fq->fetch(PDO::FETCH_ASSOC);

$forumgroup = $fpost['category'];

if($_POST['Cancel']){

    if ($fpost['reply_to'] != 0) {
        $letsgetthis = $conn->query("SELECT * FROM forum WHERE id = '".$fpost['reply_to']."'");
        $letsgo = $letsgetthis->fetch(PDO::FETCH_ASSOC);
        $whereamiid = $fpost['reply_to']."#".$fpost['id'];
        $goto = "/Forum/ShowPost.aspx?id=".$whereamiid;
    }else{
        $whereamiid = $fpost['id'];
        $goto = "/Forum/ShowPost.aspx?id=".$whereamiid;
    }

    header("Location: ".$goto);
}

if($_POST['Delete']){
    if($_POST['DeleteReason'] != ""){
        if($_USER['USER_PERMISSIONS'] == 'Administrator') {
            $delete = $conn->query("DELETE FROM forum WHERE id='$id'");

            if ($fpost['reply_to'] != 0) {
                $letsgetthis = $conn->query("SELECT * FROM forum WHERE id  = '".$fpost['reply_to']."'");
                $letsgo = $letsgetthis->fetch(PDO::FETCH_ASSOC);
                $whereamiid = $letsgo['id'];
                $goto = "/Forum/ShowPost.aspx?id=".$whereamiid;
            }else{
                if($hasreplies == "Yes"){
                    $delete = $conn->query("DELETE FROM forum WHERE reply_to='$id'");
                }
                $whereamiid = $fpost['id'];
                $goto = "/Forum/ShowForum.aspx?id=".$forumgroup;
            }

            header("Location: ".$goto);
        }
    }
}

if ($fpost['reply_to'] != 0) {
    // header("Location: /Forum/Msgs/default.aspx?MessageId=6"); die(); exit;
}

$topicsql = $conn->query("SELECT * FROM topics WHERE id  = '".$fpost['category']."'");
$topicscheisse = $topicsql->fetch(PDO::FETCH_ASSOC);

$groupium1 = $conn->query("SELECT * FROM forumgroups WHERE id  = '".$topicscheisse['category']."'");
$groupium = $groupium1->fetch(PDO::FETCH_ASSOC);
?>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr><td></td></tr>
                        <tr valign="bottom">
                            <td>
                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr valign="top">
                                            <td>&nbsp;&nbsp;&nbsp;</td>
                                            <td width="95%" class="CenterColumn">








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
                                      <a class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?=$groupium['id'];?>"><?=$groupium['name'];?></a>
                                    </nobr>
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&nbsp;&gt;</span>
                                      <a class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=<?=$topicscheisse['id'];?>"><?=$topicscheisse['name'];?></a>
                                    </nobr>
                                  </td>
                                  <td class="popupMenuSink" width="1px" valign="top" align="left">
                                    <nobr>
                                      <span class="normalTextSmallBold">&nbsp;&gt;</span>
<?php
if ($fpost['reply_to'] != 0) {
  $stmt = $conn->prepare("SELECT * FROM forum WHERE id = ?");
  $stmt->execute([$fpost['reply_to']]);
  $letsgo = $stmt->fetch(PDO::FETCH_ASSOC);
  $whereamiid = $letsgo['id'];
  $whereamititle = htmlspecialchars($letsgo['title']);
  $hash = "#".$fpost['id'];
  $specification = "(Reply)";
} else {
  $whereamiid = $fpost['id'];
  $whereamititle = htmlspecialchars($fpost['title']);
}
?>
                                      <a class="linkMenuSink" href="/Forum/ShowPost.aspx?PostID=<?=$whereamiid;?><?=$hash;?>"><?=$whereamititle;?> <?=$specification;?></a>
                                    </nobr>
                                  </td>
                                  <td width="*" valign="top" align="left">&nbsp;</td>
                                </tr>
</tbody></table>

<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_MenuScript"></span></span></td>
  </tr>

</td></tr></tbody></table>

<form action="" method="POST">
<p>
<center>
<table Class="tableBorder" CellPadding="3" Cellspacing="1">
  <tr>
    <th class="tableHeaderText" align="left" height="25">
      &nbsp;Delete Post/Thread
    </th>
  </tr>
  <tr>
    <td class="forumRow">
      <table cellSpacing="1" cellPadding="3">
        <tr>
          <td vAlign="top" nowrap align="left"><span class="normalTextSmall">Please provide a reason of why you are deleting this post.</span></td>
        </tr>
        <tr>
          <td align="left" colspan="2">
            <table>
              <tr>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td vAlign="top" colspan="2" nowrap align="left"><span class="normalTextSmallBold"><asp:CheckBox Checked="true" id="SendUserEmail" runat="server" text=" Send user email (thread owner only) why post was deleted"/></span></td>
        </tr>
        <tr>
          <td align="left">
            <table>
              <tr>
                <td vAlign="top" colspan="2" nowrap align="right"><span class="normalTextSmallBold">Reason: </span></td>
                <td vAlign="top" align="left"><textarea id="DeleteReason" name="DeleteReason" rows="8" cols="90"></textarea>
<br><text class="validationWarningSmall"><?php if($_POST['Delete']){ if($_POST['DeleteReason'] == ""){?>You must supply a reason.<?}}?>&nbsp;</text>
</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
                                    <td valign="top" align="right" colspan="2">
                                      <input type="submit" name="Cancel" id="Cancel" value=" Cancel "> &nbsp; <input type="submit" name="Delete" value=" Delete ">
                                    </td>
                                  </tr>
      </table>
    </td>
  </tr>
</table>
</center>
</form>

</div>

<?php
require ("../../inc/footer.php");
?>