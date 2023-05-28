<?php
require_once('config.php');
require_once('functionsapi.php');
ob_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$date=date("Y-m-d");
?>

<?php
if ($_USER['BC'] == 'BC') {
    if ($_USER['BCExpire'] == $date) {
        $removebc = 'None';
        $sql = "UPDATE users SET BC = :removebc WHERE id = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':removebc', $removebc);
        $stmt->bindParam(':userid', $_USER['id']);
        $stmt->execute();
    }
    if ($_USER['BCExpire'] < $date) {
        $removebc = 'None';
        $sql = "UPDATE users SET BC = :removebc WHERE id = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':removebc', $removebc);
        $stmt->bindParam(':userid', $_USER['id']);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">
  <head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link id="ctl00_Imports" rel="stylesheet" type="text/css" href="/AllCSSnew.css"/><link id="ctl00_Favicon" rel="Shortcut Icon" type="image/ico" href="<?php echo $siteurl; ?>/favicon.ico"/><meta name="author" content="<?=$sitename?> Corporation"/><meta name="keywords" content="game, video game, building game, construction game, online game, LEGO game, LEGO, MMO, MMORPG, virtual world, avatar chat"/><meta name="robots" content="all"/></head>
  <body>
      <div id="Container">
<div id="">
     <script type="text/javascript"><!--
  <h1>oops </h1>
      google_ad_client = "pub-2247123265392502";
      google_ad_width = 728;
      google_ad_height = 90;
      google_ad_format = "728x90_as";
      google_ad_type = "text_image";
      google_ad_channel = "";
      //-->
    </script>
    <script type="text/javascript" src="pagead/show_ads.js"></script>
</div>
        <div id="Header">
          <div id="Banner">
            <div id="Options">
              <div id="Authentication">
              <?php if($isloggedin == 'no') {echo '<a href="/login.aspx">Login</a>';} ?>
              <?php // may not be accurate
  if($isloggedin == 'yes') {echo 'Logged in as '.$_USER['username'].'&nbsp;<strong>|</strong>&nbsp;<a href="'.$siteurl.'/logout.aspx">Logout</a>';} ?>
              </div>
              <div id="Settings">
              <?php if($isloggedin == 'yes') {echo 'Age 13+, Chat Mode: Filter';} ?>
              </div>
            
            </div>
            <div id="Logo"><a id="ctl00_rbxImage_Logo" title="<?=$sitename?>" href="<?php echo $siteurl; ?>/" style="display:inline-block;cursor:pointer;"><img src="/images/goodblox_logo.png" border="0" id="img" alt="<?=$sitename?>" blankurl="http://t2.roblox.com:80/blank-267x70.gif"/></a>
            </div>
            <div id="Alerts"><table style="width:100%;height:100%"><tr><td valign="middle">
            <?php if($isloggedin == 'no') {
            echo "<a id=\"ctl00_rbxAlerts_SignupAndPlayHyperLink\" class=\"SignUpAndPlay\" href=\"/register\"><img src=\"/images/SignupBannerV2.png\" alt=\"Sign-up and Play!\" border=\"0\"/></a>";
            }?>
              <?php if($isloggedin == 'yes') {
                echo '                <table style="width:123%;height:101%;padding-right:20px;">
                <tbody><tr>
                  <td valign="middle">
          
                    <div>
                      <div id="AlertSpace" style="background-opacity: 0.5">
                        <div>';
                        if($unreadmsg > '0'){
                          
                        echo '<div id="MessageAlert">
                            <a class="TicketsAlertIcon"><img src="'.$siteurl.'/images/Message.gif" style="border-width:0px;"></a>&nbsp;
                            <a href="'.$siteurl.'/My/Inbox.aspx" class="TicketsAlertCaption">'.$unreadmsg.' New Messages!</a>
                          </div>';
                        
                        }
                        if($_USER['robux'] !== '0'){
                          echo'
                          <div id="RobuxAlert">
                            <a class="TicketsAlertIcon"><img src="'.$siteurl.'/images/Robux.png" style="border-width:0px;"></a>&nbsp;
                            <a href="'.$siteurl.'/currency" class="TicketsAlertCaption">'.$_USER['robux'].' GOODBUX</a>
                          </div>'; }
                       echo'
                          <div id="TicketsAlert">
                            <a class="TicketsAlertIcon"><img src="'.$siteurl.'/images/Tickets.png" style="border-width:0px;"></a>&nbsp;
                            <a href="'.$siteurl.'/currency" class="TicketsAlertCaption">'.$_USER['tix'].' Tickets</a>
                          </div>
                  </div>
                      </div>
                    </div>
                  </td>
                      </tr>
                    </tbody></table>';
              } ?>
</td></tr></table></div>
          </div>