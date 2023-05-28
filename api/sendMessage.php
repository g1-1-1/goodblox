<?php
require ("../inc/header.php");
require ("../inc/nav.php");

$uid = $_GET['id'] ?? 0;
$uid = intval($uid);

$replyto = $_GET['replyto'] ?? 0;
$replyto = intval($replyto);

$userq = $conn->prepare("SELECT * FROM users WHERE id=:uid");
$userq->bindParam(':uid', $uid);
$userq->execute();
$user = $userq->fetch(PDO::FETCH_ASSOC);

if (($userq->rowCount() < 1) || ($uid == $_USER['id'])) {
  die("<script>document.location = \"/users/\"</script>");
}

$reply = false;

if ($replyto != 0) {
  $mq = $conn->prepare("SELECT * FROM messages WHERE user_from=:uid AND user_to=:user_id AND id=:replyto");
  $mq->bindParam(':uid', $uid);
  $mq->bindParam(':user_id', $_USER['id']);
  $mq->bindParam(':replyto', $replyto);
  $mq->execute();

  if ($mq->rowCount() != 0) {
    $reply = true;
    $reply_msg = $mq->fetch(PDO::FETCH_ASSOC);
  }
}

?>

<script>
  function SubmitForm(token) {
    document.getElementById("msgform").submit();
  }
</script>
 <div id="Body">
                <div class="MessageContainer">
  <div id="MessagePane" >
      <?php
if (isset($_POST['subject'])) {
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    $currenttimelol = time();

    $stmt = $conn->prepare("INSERT INTO `messages` (`id`, `user_from`, `user_to`, `subject`, `content`, `datesent`) VALUES (NULL, :user_from, :user_to, :subject, :content, :datesent)");
    $stmt->bindValue(':user_from', $_USER['id']);
    $stmt->bindValue(':user_to', $uid);
    $stmt->bindValue(':subject', $subject);
    $stmt->bindValue(':content', $message);
    $stmt->bindValue(':datesent', $currenttimelol);
    $stmt->execute();

    echo "Message sent!";
    die("<script>document.location = \"..\user.php?id=$uid\"</script>");
}
?>

  <form method="post" id='msgform'>
    <h3>Your Message</h3>
    <div id="MessageEditorContainer">  
      <div class="MessageEditor">
        <table width="100%" style="font-size: 12px;">
          <tbody><tr valign="top">
            <td style="width:12em">
              <div id="From">
                <span class="Label">
                <span id="MsgFrom">From:</span></span> <span class="Field">
                <span id="MsgAuthor"><?php echo $_USER['username']; ?></span></span>
              </div>
              <div id="To">
                <span class="Label">
                <span id="MsgTo">Send To:</span></span> <span class="Field">
                <span id="MsgRecipient"><?php echo $user['username']; ?></span></span>
              </div>
              
            </td>
            <td style="padding:0 24px 6px 12px">
              <div id="Subject">
                <div class="Label">
                  <label id="MsgSubjectText">Subject:</label>
                </div>
                <div class="Field">
                  <input name="subject" type="text" id="MsgSubject" class="TextBox" style="width:100%;">
                </div>
              </div>
              <div class="Body">
                <div class="Label">
                  <label id="MsgBodyTitle">Message:</label></div>
                <textarea name="message" rows="2" cols="20" id="MsgBody" class="MultilineTextBox" style="width:100%;"></textarea>
              </div> 
            </td>
          </tr>
        </tbody></table>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="Buttons">                
      <input name="sd" data-callback='SubmitForm' value="Send" id="Send" class="Button" type="submit">
          </div>
  </form></div>
  <div style="clear: both;"></div>
  
</div>
            </div>
<?php
require ("../inc/footer.php");
?>