<?php
require ("inc/header.php");
require ("inc/nav.php");

$id = htmlspecialchars((int)addslashes($_GET['ID']));
$gameitem = $conn->prepare("SELECT * FROM games WHERE id=:id");
$gameitem->bindParam(':id', $id);
$gameitem->execute();
$game = $gameitem->fetch(PDO::FETCH_ASSOC);
if(!$game) {
  die('<script>
  alert("This game does not exist");
  document.location = "/games";
  </script>');
  exit;
}
$creatorq = $conn->prepare("SELECT * FROM users WHERE id=:creator");
$creatorq->bindParam(':creator', $game['creator_id']);
$creatorq->execute();
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);

?>

<title>
  <?=$title?>
</title>
<div id="Body">
<script>
  var sid;
  var token;
  var sid2;
  var activeTab = 1;
  function showTab(num) 
    {
    $("#tab" + activeTab).removeClass("Active");
    $("#tabb" + activeTab).hide();
    activeTab = num;
    $("#tab" + num).addClass("Active");
    $("#tabb" + num).show();
  }
  function JoinGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("The server is ready. Joining the game... ");
        token = data;
        location.href= "play.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function HostGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("Redirecting you to the host page... ");
        token = data;
        location.href= "host.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function checkifProgressChanged() 
    {
    $.getJSON("" + sid, function(result) {
      $("#Requesting").html(result.msg);
      if(result.token == null) 
            {
        if(result.check == true) 
                {
          setTimeout(function() { checkifProgressChanged() }, 750);
        } 
                else 
                {
          $("#Spinner").hide();
        }
      } 
            else 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function joinServer() 
    {
    $.getJSON("" + sid2, function(result) 
        {
      $("#Requesting").html(result.msg);
      if(result.token != null) 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function closeModal() 
    {
    $("#joiningGameDiag").hide();
    $("#Spinner").show();
    $("#Requesting").html("Requesting a server");
  }
    </script>
<style>
  #ItemContainer #Thumbnail_Place {
  height: 230px;
  width: 420px;
  }
  .PlayGames {
  background-color: #ccc;
  border: dashed 1px Green;
  clear: left;
  color: Green;
  float: left;
  margin-top: 10px;
  padding: 10px 5px;
  text-align: center;
  width: 410px;
  }
  #ItemContainer #Actions, #ItemContainer #Actions_Place {
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
</style>
<div id="joiningGameDiag" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
  <div class="modalPopup" style="width: 27em; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <div style="margin: 1.5em">
<div id="Spinner" style="float:left;margin:0 1em 1em 0">
        <img src="/images/ProgressIndicator2.gif" style="border-width:0px;">
      </div>
      <div id="Requesting" style="display: inline">
        Requesting a server
      </div>
      <div style="text-align: center; margin-top: 1em">
        <input id="Cancel" onclick="closeModal()" type="button" class="Button" value="Cancel">
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<style>
#ItemContainer {
    background-color: #eee;
    border: solid 1px #555;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#Item {
    font-family: Verdana, Sans-Serif;
    padding: 10px;
}
</style>
<div id="ItemContainer" style="width:725px; margin:unset;float:left;">
  <?php echo '<h2>"'.htmlspecialchars($game['name']).'"</h2> '?>
  <div id="Item">
    <div id="Summary" style="width:251px;">
      <h3><?=$sitename?> Place</h3>
      <div id="Creator" class="Creator">
        <div class="Avatar">
<img src="data:image/jpeg;base64, <?php echo $creator['thumbnail']; ?>" frameborder="0" scrolling="no" width="100"></img>
          <a title="<?php echo $creator['username']; ?>" href="/User.php?ID=<?php echo $game['creator_id']; ?>" style="display:inline-block;cursor:pointer;"></a>
        </div>
        Creator: <a href="/user.php?id=<?php echo $game['creator_id']; ?>"><?php echo $creator['username']; ?></a>
      </div>
      <div id="LastUpdate">Updated: <?php echo $game['datecreated']; if(is_null($game['datecreated'])) { echo 'Unknown'; }?></div>
      <div class="Visited">Visited: <?php echo $visits; ?></div>
            <div>
        <div id="DescriptionLabel">Description:</div>
        <div id="Description" style="width:auto;"><?php echo htmlspecialchars(htmlentities($game['description'])); ?></div>
      </div>
            <div id="ReportAbuse">
        <div class="ReportAbusePanel">
          <center>
              <br>
            <span class="AbuseIcon"><a><img src="images/abuse.gif" border="0" alt="Report Abuse" border="0"></a></span>
            <span class="AbuseButton"><a>Report Abuse</a></span>
                      </center>
        </div>
      </div>
    </div>
    <div id="Details">
      <div id="Thumbnail_Place">
        <a title="<?php echo $game['name']; ?>
" style="display:inline-block;cursor:pointer;">
<img src="/Thumbs/Games/show.php?id=<?php echo $game['id']; ?>" width="418" height="228" style="border: 1px solid black" alt="<?php echo $game['name']; ?>">
</a>
      </div>
      <div id="Actions_Place" style="width: 408px;">
<a href="#">Favorite</a>
              </div>
            <div class="PlayGames">
        <div style="text-align: center; margin: 1em 5px;">
                    <span style="display:inline;"><img src="images/public.png" style="border-width:0px;">&nbsp;Public</span>
                    <img src="images/CopyLocked.png" style="border-width:0px;"> Copy Protection: CopyLocked
                  </div>
        <div>
          <div style="display: inline; width: 10px; ">
            <a href="/uriostooold.php"><p style="color: grey;">Play button doesn't work?</p></a>
            <input type="image" class="ImageButton" src="images/Play.png" alt="Visit Online" onclick="JoinGame()">
            <?php if($creator['id'] == $_USER['id']) { ?><br><input type="image" class="ImageButton" src="images/Host.png" alt="Host Game" style="margin-top: 5px" onclick="HostGame()"><?php } ?>
          </div>
        </div>
      </div>
      <div style="clear: both;"></div>
      <div id="Place_GamesPanel" class="Panel">
        <h4>Online Games</h4>
        <div style="padding: 1em">
            <div id="ctl00_cphRoblox_GamesUpdatePanel">
  
                    
                    
                    <br>
                    <input type="submit" name="ctl00$cphRoblox$RefreshButton" value="Refresh" id="ctl00_cphRoblox_RefreshButton" class="Button">
                
</div>
        </div>
    </div>
    </div>
  </div>
  
</div>
  

<div style="clear: both;"></div>
      <?php require ("inc/footer.php"); ?>


</div>