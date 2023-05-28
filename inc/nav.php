<div class="Navigation">
            <?php if($isloggedin == 'yes') { ?>
            <span><a id="ctl00_hlMyRoblox" class="MenuItem" href="<?php echo $siteurl; ?>/My/Home.aspx">My <?=$sitename?></a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlGames" class="MenuItem" href="<?php echo $siteurl; ?>/Games.aspx">Games</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlCatalog" class="MenuItem" href="<?php echo $siteurl; ?>/Catalog.aspx">Catalog</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlBrowse" class="MenuItem" href="<?php echo $siteurl; ?>/Browse.aspx">People</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlForum" class="MenuItem" href="<?php echo $siteurl; ?>/BuildersClub.aspx">Builders Club</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <?php } ?>
            <span><a id="ctl00_hlForum" class="MenuItem" href="<?php echo $siteurl; ?>/Forum/Default.aspx">Forum</a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlNews" class="MenuItem" href="<?php echo $siteurl; ?>/ServerError.aspx" target="_blank">News</a>&nbsp;<a id="ctl00_hlNewsFeed" href="http://blog.<?php echo $sitedomain; ?>/index.html"><img src="<?php echo $siteurl; ?>/images/feed-icon-14x14.png" border="0"/></a></span>
            <span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlForum" class="MenuItem" href="/Help.php">Help</a></span>
            <?php if($_USER['USER_PERMISSIONS'] == 'Administrator') {echo '<span class="Separator">&nbsp;|&nbsp;</span>
            <span><a id="ctl00_hlMyRoblox" class="MenuItem" href="'.$siteurl.'/admin">Admin</a></span>';} ?>

           </div>
        </div>  
 <?php require_once($_SERVER["DOCUMENT_ROOT"]."/inc/alerts.php"); ?>

<?php if($_GLOBAL['maintenanceEnabled'] == 'yes') {header('location: '.$siteurl.'/maintenance');} ?>

<?php
if ($ipbansresultCheck > 0) {
    while ($ipbansrow = $ipbansresult->fetch(PDO::FETCH_ASSOC)) {?>
       <div style="margin: 100px auto 100px auto; width: 500px; border: black thin solid; padding: 22px; color: black;">
  <h2 style="text-align:center;">Access Denied</h2>
  <p>
    Your network access to <?=$sitename?> was denied, To make it simple, you got ip banned from <?=$sitename?>, This ban is definitive and cannot be appealed.
  </p>
<p>Reviewed: <span style="font-weight: bold"><?=$ipbansrow['banned_at'] ?></span></p>
  <!--<p>
    Ban Reason: </span><span style="font-weight: bold"><?php echo $_USER['banreason']; ?></span></p>
  </p>-->
  <p>
    Please abide by the <?=$sitename ?> Community Guidelines so that <?=$sitename ?> can be fun for users of all ages.
  </p>
</div>
    <?php ; die();}
}
?>

<?php if($isloggedin == 'yes') {if($_USER['bantype'] !== 'None') { ?>
  <div style="margin: 100px auto 100px auto; width: 500px; border: black thin solid; padding: 22px; color: black;">
  <h2 style="text-align:center;"><?php if($_USER['bantype'] == 'Reminder') {echo 'Reminder';} elseif($_USER['bantype'] == 'Warning') {echo 'Warning';} elseif($_USER['bantype'] == 'Ban') {echo 'Account Deleted';} elseif($_USER['bantype'] == '1daysban') {echo 'Banned for 1 day';} ?></h2>
  <p>
    Our content monitors have determined that your behaviour at <?=$sitename ?> has been in violation of our Terms of Service. We will terminate your account if you do not abide by the rules.
  </p>
<p>Reviewed: <span style="font-weight: bold"><?php echo $_USER['bandate']; ?></span></p>
  <p>
    Moderator Note: </span><span style="font-weight: bold"><?php echo $_USER['banreason']; ?></span></p>
  </p>
  <p>
    Please abide by the <?=$sitename ?> Community Guidelines so that <?=$sitename ?> can be fun for users of all ages.
  </p>

  
  <p>
    <?php if($_USER['bantype'] == 'Ban'){ ?>
    <p>Your account has been terminated.    <!--<a href='/logout.aspx'>Log out</a>-->
      </p>
    <?php } ?>
    <?php if($_USER['bantype'] == 'Warning') {echo '<br>
<center>
<input type="checkbox" id="checker"> <span>I Agree</span>
<br>
<a href="../reactivate_account.php"><button id="sendbtn" disabled>Reactivate My Account</button></a>
<br> <script>
var checker = document.getElementById("checker");
 var sendbtn = document.getElementById("sendbtn");
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>
<br>
<a href="../logout.aspx"><button>Logout</button></a>
</center>';} ?>  </p>
    <?php if($_USER['bantype'] == 'Reminder') {echo '<br>
<center>
<input type="checkbox" id="checker"> <span>I Agree</span>
<br>
<a href="../reactivate_account.php"><button id="sendbtn" disabled>Reactivate My Account</button></a>
<br> <script>
var checker = document.getElementById("checker");
 var sendbtn = document.getElementById("sendbtn");
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>
<br>
<a href="../logout.aspx"><button>Logout</button></a>
</center>';} ?>
    <?php if($_USER['bantype'] == '1daysban') {echo '<br>
<center>
'; if (($_USER['unbantime'] <= time()) && ($_USER['bantype'] != 'Ban')) {
echo '
<input type="checkbox" id="checker"> <span>I Agree</span>
<br>'; } if (($_USER['unbantime'] <= time()) && ($_USER['bantype'] != 'Ban')) {
echo'
<a href="../reactivate_account.php"><button id="sendbtn" disabled>Reactivate My Account</button></a>
<br> <script> 
var checker = document.getElementById("checker");
 var sendbtn = document.getElementById("sendbtn");
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>' ; } echo'
<a href="/logout.aspx"><button>Logout</button></a>
</center>'; } ?>

</div>
<?php include($_SERVER["DOCUMENT_ROOT"]."/inc/footer.php"); die(); }} //echo '<center><h1>GoodBlox is shutting down. because it is shit</h1></center>'; die(); ?>


        

