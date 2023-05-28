<?php
include 'inc/header.php';
include 'inc/nav.php';
require_once 'inc/config.php';
  
$title = $sitename. 'Games - Most Popular (Now)';
?>
<br>
<div id="GamesContainer">
        
<div id="ctl00_cphRoblox_rbxGames_GamesContainerPanel">
  
    <div class="DisplayFilters">
      <h2>Games&nbsp;<a id="ctl00_cphRoblox_rbxGames_hlNewsFeed" href="#" onclick="alert('You cannot do this.');"><img src="/images/feed-icon-14x14.png" border="0"/></a></h2>
      <div id="BrowseMode">
        <h4>Browse</h4>
        <ul>
          <li><a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="#" onclick="alert('You cannot do this.');">Most Popular</a></li>
          <li><a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="#" onclick="alert('You cannot do this.');">Recently Updated</a></li>
          <li><a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="#" onclick="alert('You cannot do this.');">Featured Games</a></li>
        </ul>
      </div>
      <div id="ctl00_cphRoblox_rbxGames_pTimespan">
    
        <div id="Timespan">
          <h4>Time</h4>
          <ul>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanNow" href="#" onclick="alert('You cannot do this.');">Now</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastDay" href="#" onclick="alert('You cannot do this.');">Past Day</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastWeek" href="#" onclick="alert('You cannot do this.');">Past Week</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanPastMonth" href="#" onclick="alert('You cannot do this.');">Past Month</a></li>
            <li><a id="ctl00_cphRoblox_rbxGames_hlTimespanAllTime" href="#" onclick="alert('You cannot do this.');">All-time</a></li>
          </ul>
        </div>
      
  </div>
    </div>
    
            <div id="Games">
                <span id="ctl00_cphRoblox_rbxGames_lGamesDisplaySet" class="GamesDisplaySet">Most Popular (Now)</span>
          <div id="ctl00_cphRoblox_rbxGames_HeaderPagerPanel" class="HeaderPager">
            <span id="ctl00_cphRoblox_rbxGames_HeaderPagerLabel">Page 1 of 1:</span>
            
            <a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="games.aspx?m=MostPopular&amp;t=Now&amp;p=2">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
        </div>
          <table id="ctl00_cphRoblox_rbxGames_dlGames" cellspacing="0" align="Left" border="0" width="550">
    <tr>
      
    </tr>
  </table>
              <div id="Games">
      <td class="Game" valign="top">
          <div style="display:inline-block;cursor:pointer;">
            <?php
      
            $stmt = $conn->prepare('SELECT * FROM games ORDER BY players DESC');
            $stmt->execute();
            
    
         foreach ($stmt as $row) {
           $creatorq = $conn->prepare("SELECT * FROM users WHERE id=:creator");
           $creatorq->bindParam(':creator', $row['creator_id']);
           $creatorq->execute();
           $creator = $creatorq->fetch(PDO::FETCH_ASSOC);
           echo "<span class=\"Game\" valign=\"top\">
            <div style=\"display:inline-block;cursor:pointer;\">
              <div class=\"GameThumbnail\">
 
                        
                <a id=\"ctl00_cphRoblox_rbxGames_dlGames_ctl00_ciGame\" title=\"".htmlspecialchars($row['name'])."\" href=\"/PlaceItem.aspx?ID=".htmlspecialchars($row['id'])."\" style=\"display:inline-block;cursor:pointer;\"><img src=\"/Thumbs/Games/show.php?id=".$row['id']."\" width=\"160\" height=\"100\" border=\"0\" id=\"img\" alt=\"".htmlspecialchars($row['name'])."\"/></a>
              </div>
              <div class=\"GameDetails\">
                <div class=\"GameName\"><a id=\"ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameName\" href=\"/PlaceItem.aspx?ID=".htmlspecialchars($row['id'])."\">".htmlspecialchars($row['name'])."</a></div>
                <div class=\"GameLastUpdate\"><span class=\"Label\">Updated:</span> <span class=\"Detail\">Soon</span></div>
                <div class=\"GameCreator\"><span class=\"Label\">Creator:</span> <span class=\"Detail\"><a id=\"ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameCreator\" href=\"/User.php?id=".htmlspecialchars($row['creator_id'])."\">".htmlspecialchars($creator['username'])."</a></span></div>
                <div class=\"GamePlays\"><span class=\"Label\">Played:</span> <span class=\"Detail\">0 times today</span></div>
                <div id=\"ctl00_cphRoblox_rbxGames_dlGames_ctl00_pGameCurrentPlayers\"> ";
        
                  if ($row['players'] > 0){ echo "<div class=\"GameCurrentPlayers\"><span class=\"DetailHighlighted\">".htmlspecialchars($row['players'])." players online</span></div>"; }
                
                  echo "</div>
                  </div>
                  </div>
            </span>";
         }
      
      ?>
              
      

</div>


