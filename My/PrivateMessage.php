<?php
require_once("../inc/header.php");
require_once("../inc/nav.php");
  
$MessageID = $_GET['MessageID'];

$stmt = $conn->prepare("SELECT * FROM messages WHERE id = :id");
$stmt->execute(['id' => $MessageID]);
$fpost = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fpost) {
  die("Invalid ID.");
}

if ($fpost['user_to'] != $_USER['id']) {
  die("This message wasn't sent to you.");
}

if ($fpost['readto'] != '0') {
  die("This message was already read.");
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $fpost['user_from']]);
$fauthor = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div id="Body">
          
  <div class="MessageContainer">

        <div id="MessagePane">
      <div id="ctl00_cphRoblox_pPrivateMessage">
  
        <div id="ctl00_cphRoblox_pPrivateMessageReader">
    
          <h3>Private Message</h3>
          <div class="MessageReaderContainer">
              

<div id="Message">
    <table width="100%">
        <tbody><tr valign="top">
            <td style="width: 10em">
                <div id="DateSent"><?php echo date("m/d/Y", $fpost['datesent']); echo " "; echo date("g:i A", $fpost['datesent']) ?></div>
                <div id="Author">
                    
                    <a id="ctl00_cphRoblox_rbxMessageReader_Avatar" disabled="disabled" title="ipoopallday" onclick="return false" style="display:inline-block;height:64px;width:64px;"><img src="data:image/jpeg;base64, <?php echo $fauthor['thumbnail']; ?>" border="0" id="img" alt="<?php echo $fauthor['username']; ?>" height="64px"></a><br>
                    <a id="ctl00_cphRoblox_rbxMessageReader_AuthorHyperLink" title="Visit ipoopallday's Home Page" href="/User.aspx?id=<?php echo $fpost['user_from']; ?>"><?php echo $fauthor['username']; ?></a>
                </div>
                <div id="Subject">
                    <?php echo htmlspecialchars($fpost['subject']); ?><br>
                    <br>
                    <div id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
      
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseIconHyperLink" href="../AbuseReport/Message.aspx?ID=2274781&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fPrivateMessage.aspx%3fMessageID%3d2274781"><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_rbxMessageReader_AbuseReportButton_ReportAbuseTextHyperLink" href="../AbuseReport/Message.aspx?ID=2274781&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fMy%2fPrivateMessage.aspx%3fMessageID%3d2274781">Report Abuse</a></span>

    </div>
                </div>
            </td>
            <td style="padding: 0 10px 0 10px">
                <div class="Body">
                    <div id="ctl00_cphRoblox_rbxMessageReader_pBody" class="MultilineTextBox" style="height:250px;overflow-y:scroll;width:455px;">
      
                       <?php echo htmlspecialchars(nl2br($fpost['content'])); ?>                   
    </div> <p style="color:red;"><b>Remember, <?=$sitename;?> staff will never ask you for your <br>password.<br>
People who ask for your password are trying to steal <br>your account.
</b></p>
                </div>
                
            </td>
        </tr>
    </tbody></table>
</div>
              <div style="clear:both"></div>
<script>
        function yea() {
            window.location.replace("/My/DeleteMessage.aspx?ID=<?php echo $fpost['id'] ?>");
        }
    </script>
          </div><form action="" method="POST" id="formok">
          <div class="Buttons">
            <a id="ctl00_cphRoblox_lbCancel" class="Button" href="/My/Inbox.aspx">Cancel</a>
            <a id="ctl00_cphRoblox_lbDelete" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$lbDelete','')" onclick="yea();" name="delete">Delete</a>
            <a id="ctl00_cphRoblox_lbReply" class="Button" href="/api/sendMessage.aspx?replyto=<?php echo $fpost['id'] ?>">Reply</a>
          </div></form>
          <div style="clear:both"></div>
        
  </div>
        
      
</div>
      
    </div>
    <div style="clear: both;"></div>
  </div>

        </div>