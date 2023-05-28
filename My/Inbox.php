<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';
if($isloggedin !== 'yes') {header('location: /login.aspx');}

if($_POST['read']){
$ok = $pdo->prepare("SELECT * FROM messages WHERE `id` = :read");
$ok->bindParam(':read', (int)$_POST['read'], PDO::PARAM_INT);
$ok->execute();
$okletsgo = $ok->fetch();

if($okletsgo['user_to'] == $_USER['id']){
    $yeet = $pdo->prepare("UPDATE messages SET `readto` = '1' WHERE `id` = :read");
    $yeet->bindParam(':read', (int)$_POST['read'], PDO::PARAM_INT);
    $yeet->execute();

header("Location: /My/Inbox.aspx");
}

}
 
if($_POST['readall']){

$yeet = $conn->prepare("UPDATE messages SET `readto` = '1' WHERE `user_to` = :user_to");
$yeet->bindParam(':user_to', $_USER['id']);
$yeet->execute();


header("Location: /my/inbox");

}
  
                    $numberofpages = ceil($resultsperpage);

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    }else{
                        $page = (int)addslashes($_GET['page']);
                    }

$resultsperpage = 20;

                    $thispagefirstresult = ($page-1)*$resultsperpage;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}</script>
<div id="Body">
          
  <div id="InboxContainer">
      <div id="InboxPane">
            <h2>Inbox</h2>






        <div id="Inbox">

          <div>
  <table cellspacing="0" cellpadding="3" border="0" id="ctl00_cphRoblox_InboxGridView" style="width:726px;border-collapse:collapse;">
    <tr class="InboxHeader">
      <th align="left" scope="col">
                  <input onclick="toggle(this);" type="checkbox" name="readall"/>
                </th><th align="left" scope="col"><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Sort$m.[Subject]')">Subject</a></th><th align="left" scope="col"><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Sort$u.[userName]')">From</a></th><th align="left" scope="col"><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Sort$m.[Created]')">Date</a></th>
    </tr>





     <?php
                     $sql = "SELECT * FROM messages WHERE user_to = :user_to AND readto = '0' ORDER BY `id` DESC";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_to' => $_USER['id']]);
$result = $stmt->fetchAll();

$resultCheck = count($result);
if ($resultCheck > 0) {
    foreach ($result as $row) {
        $creatorq = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
        $creatorq->execute(['user_id' => $row['user_from']]);
        $creator = $creatorq->fetch(PDO::FETCH_ASSOC);
        ?>
  <tr class="InboxRow">
      <td>
                  <span style="display:inline-block;width:25px;"><input type="checkbox" name="read" value="<?=$row['id'];?>" /></span>
                </td><td align="left"><a href="PrivateMessage.aspx?MessageID=<?=$row['id'];?>" style="display:inline-block;width:325px;"><?=htmlspecialchars($row['subject']);?></a></td><td align="left">
                  <a id="ctl00_cphRoblox_InboxGridView_ctl02_hlAuthor" title="Visit <?=htmlspecialchars($creator['username']);?>'s Home Page" href="../User.aspx?ID=<?=$creator['id'];?>" style="display:inline-block;width:175px;"><?=htmlspecialchars($creator['username']);?></a>
                </td><td align="left"><?=date("n/j/Y g:i:s A",$row['datesent']);?></td>
    </tr> <?php } } ?>


<tr class="InboxPager">
      <td colspan="4"><table border="0">
        <tbody><tr>
          <td><span>1</span></td><td><a href="javascript:__doPostBack('ctl00$cphRoblox$InboxGridView','Page$2')">2</a></td>
        </tr>
      </tbody></table></td>
    </tr>


  </tbody></table>
</div>
        </div>
        <div class="Buttons">
          <input type="submit" id="ctl00_cphRoblox_DeleteButton" class="Button" value="Delete">
          <a id="ctl00_cphRoblox_CancelHyperLink" class="Button" href="/My/Home.aspx">Cancel</a>
        </div>
    </div>
</div>
    <div style="clear: both;"></div>
  </div>
</div> 
  


                                                                    
