<?php
include 'inc/header.php';
include 'inc/nav.php';
require_once 'inc/config.php';
$id = (int)$_GET['id'];
$sql = "SELECT * FROM catalog WHERE id = :id;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$resultCheck = $stmt->rowCount();

if ($resultCheck > 0) {
    $type = "";
    if($result['type'] == "hat") $type = "Hat";
    if($result['type'] == "hair") $type = "Hair";
    if($result['type'] == "shirt") $type = "Shirt";
    if($result['type'] == "pants") $type = "Pants";
    if($result['type'] == "gear") $type = "Gear";
    if($result['type'] == "tshirt") $type = "T-Shirt";
    if($result['type'] == "face") $type = "Face";
    if($result['type'] == "package") $type = "Package";
    metatag($result['name'], $result['description'], $result['thumbnail']);

    $creatorq = $conn->prepare("SELECT * FROM users WHERE id=:creatorid");
    $creatorq->bindValue(':creatorid', $result['creatorid'], PDO::PARAM_INT);
    $creatorq->execute();
    $creator = $creatorq->fetch(PDO::FETCH_ASSOC);

    $numbersq = $conn->prepare("SELECT * FROM comments WHERE assetid = :id");
    $numbersq->bindValue(':id', $id, PDO::PARAM_INT);
    $numbersq->execute();
    $numbers = $numbersq->rowCount();

    $owneditemsq = $conn->prepare("SELECT * FROM owned_items WHERE itemid=:itemid AND ownerid=:ownerid");
    $owneditemsq->bindValue(':itemid', $result['id'], PDO::PARAM_INT);
    $owneditemsq->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
    $owneditemsq->execute();
    $owneditems = $owneditemsq->fetch(PDO::FETCH_ASSOC);
    if($owneditems) {$owned = 'yes';} else {$owned = 'no';
}
?>
<style>
    #Item {
    font-family: Verdana, Sans-Serif;
    padding: 10px;
}
#ItemContainer {
    background-color: #eee;
    border: solid 1px #555;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#Actions {
    background-color: #fff;
    border-bottom: dashed 1px #555;
    border-left: dashed 1px #555;
    border-right: dashed 1px #555;
    clear: left;
    float: left;
    padding: 5px;
    text-align: center;
    min-width: 0;
    position: relative;
}
.PlayGames {
  background-color: #ccc;
  border: dashed 1px Green;
  color: Green;
  float: right;
  margin-top: 10px;
  padding: 10px 5px;
  text-align: right;
  width: 325px;
  }
}
    </style>
  <div id="ItemContainer" style="float:left;width: 720px;">
  <h2><?php echo $result['name'] ; ?></h2>
  <div id="Item">
    <div id="Thumbnail">
      <a title="<?php echo $result['name']; ?>" style="display:inline-block;height:250px;width:250px;"><img src="<?php echo $result['thumbnail'] ; ?>" border="0" id="img" alt="<?php echo $result['name']; ?>" style="display:inline-block;height:250px;width:250px;"></a>
    </div>
    <div id="Summary">
      <h3><?=$sitename ?> <?=$type ?></h3>
            <div id="<?php if($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; }?>Purchase">
              <?php if($owned == 'no') { ?>
        <div id="PriceIn<?php if($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; }?>"><?php if($result['buywith'] == 'tix') {echo 'Tx';} else {echo 'G$';} ?>: <?php echo $result['price']; ?></div>
<div id='BuyWith<?php if($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; }?>'>
          <a href="buyitem.aspx?id=<?php echo $result["id"]; ?>" class='Button'>Buy with <?php if($result['buywith'] == 'tix') {echo 'Tx';} else {echo 'G$';} ?></a>
        </div> <?php } else { ?>
          <div id="PriceIn<?php if($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; }?>">You already own this item!</div>
          <?php } ?>
      </div>      <br><br>
            <div id="Creator"><br><a href="/User.aspx?ID=<?php echo $creator['id']; ?>"><img src="data:image/jpeg;base64, <?php echo $creator['thumbnail']; ?>" frameborder="0" scrolling="no" width="100" height="100"></img></a><br><span style="color:#555;">Creator: </span><a href="/user.php?id=<?php echo $creator['id']; ?>"><?php echo $creator['username']; ?></a></div>
      <div id="LastUpdate">Updated: </div>
      <div id="Favourites">Favorited: 0 times</div>
            <div>
        <div id="DescriptionLabel">Description:</div>
        <div id="Description"><?php echo $result['description']; ?></div>
      </div>
            <p>
        </p><div class="ReportAbusePanel">
          <span class="AbuseIcon"><a><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
          <span class="AbuseButton"><a>Report Abuse</a></span>
        </div>
      <p></p>
    </div>
    <div id="Actions" style="width:240px;">
                      <a href="#">Favorite</a>
                              </div><div style="clear: both;"></div>
    <?php if($owned == 'yes') {
          ?>
      
            <div id="Ownership">
          
          <a id="ctl00_cphRoblox_RemoveFromInventoryButton" class="Button" href="javascript:__doPostBack('ctl00$cphRoblox$RemoveFromInventoryButton','')">Delete from My Stuff</a>
        </div><br><br>
      
      
          <?php }
          ?>
        <div id="ctl00_cphRoblox_CommentsPane_CommentsUpdatePanel">
  
        <div class="CommentsContainer">
            
                    <h3>Comments (<?php echo $numbers; ?>)</h3>
                    
                <div class="Comments">
<?php
$sql = "SELECT * FROM comments WHERE assetid=:id;";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();
$resultCheck = count($result);

if ($resultCheck > 0) {
    foreach ($result as $row) {
        $creatorq = $conn->prepare("SELECT * FROM users WHERE id=:userid");
        $creatorq->bindValue(':userid', $row['userid'], PDO::PARAM_INT);
        $creatorq->execute();
        $creator = $creatorq->fetch(PDO::FETCH_ASSOC);
?>

                    <div class="Comment">
                        <div class="Commenter">
                            <div class="Avatar">
                                <a id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AvatarImage" title="subata" href="/User.aspx?id=1" style="display:inline-block;height:64px;width:64px;cursor:pointer;"><img src="data:image/jpeg;base64, <?php echo $creator['thumbnail']; ?>" width="65" height="65" border="0" id="img" alt="<?php echo $creator['username']; ?>"></a></div>
                        </div>
                        <div class="Post">
                            <div class="Audit">
                                Posted
                                <?php
                                $fpostedatsss = new DateTime("@{$row['time_posted']}");
                                $fpostedat =  $fpostedatsss->format('d F Y G:i');
                                echo $fpostedat; 
                                ?>
                                by
                                <a id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_UsernameHyperLink" href="User.aspx?id=<?php echo $creator['id']; ?>"><?php echo $creator['username']; ?></a>
                            </div>
                            <div class="Content"><?php echo $row['content']; ?></div>
                            <div id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_Actions" class="Actions"><div id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AbuseReportButton_AbuseReportPanel" class="ReportAbusePanel">
    
    <span class="AbuseIcon"><a id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AbuseReportButton_ReportAbuseIconHyperLink" href="AbuseReport/Comment.aspx?ID=114910&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fItem.aspx%3fID%3d1061325%26UserAssetID%3d78142"><img src="/images/abuse.gif" alt="Report Abuse" style="border-width:0px;"></a></span>
    <span class="AbuseButton"><a id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AbuseReportButton_ReportAbuseTextHyperLink" href="AbuseReport/Comment.aspx?ID=114910&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fItem.aspx%3fID%3d1061325%26UserAssetID%3d78142">Report Abuse</a></span>

  </div></div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>  <?php } } ?>
                
                    

                    
                
            <?php if($isloggedin == 'yes'){ ?><form action="/postcomment.aspx?id=<?php echo $id; ?>" method="post"><div id="ctl00_cphRoblox_CommentsPane_PostAComment" class="PostAComment">
                <h3>Comment on this <?php echo $type; ?></h3>
                <div class="CommentText"><textarea name="content" rows="5" cols="20" id="ctl00_cphRoblox_CommentsPane_NewCommentTextBox" class="MultilineTextBox"></textarea></div>
                <div class="Buttons"><input id="ctl00_cphRoblox_CommentsPane_NewCommentButton" class="Button" type="submit" value="Post Comment"></div>
            </div></form> <?php } ?>
        </div>
    
</div>

  </div>

</div>

<div style="clear:both;"></div>
<div id='itemPurchaseFade' style='position: fixed; z-index: 1; left: 0px; top: 0px; width: 100%; height: 100%; overflow: auto; background-color: rgba(100, 100, 100, 0.25); display: none;'>
  <div id='itemPurchase' class='anim' style='max-width: 325px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);'>
    <div style='background-color: #FFFFE0; border:3px solid gray; box-shadow: black 5px 5px;'><div id='VerifyPurchaseTix' style='margin: 1.5em; display:none;'>
        <h3>Insufficient Funds</h3>
        <p>You need more <?php if($row['buywith'] == 'tix') {echo 'Tix';} else {echo 'MADBUX';} ?> to purchase this item.</p>
        <p><input type='submit' name='oof' value='Cancel' onclick='$(&#39;#itemPurchaseFade&#39;).hide();' class='MediumButton' style='width:100%;'></p>
      </div>            <div id='PurchaseMessage' style='margin: 1.5em; display: none;'>
                Thanks for buying this.
      </div>
        
    </div>          </div>
</div>

<?php } else {header('location: /catalog.aspx');} ?>