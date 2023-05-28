<?php
include 'inc/header.php';
include 'inc/nav.php';
require_once 'inc/config.php';
  
$type = $_GET['type'] ?? 'hat';
  
if ($type == "hat") {
  $sname = "Hats";
}

if ($type == "pants") {
  $sname = "Pants";
}

if ($type == "tshirt") {
  $sname = "T-Shirts";
}
  
if ($type == "shirt") {
  $sname = "Shirts";
}
  
if ($type == "face") {
  $sname = "Faces";
}
if ($type == "head") {
  $sname = "Heads";
}
?>

<div id="CatalogContainer" style="margin-top: 5px">
    <div id="SearchBar" class="SearchBar">
        <span class="SearchBox"><input name="ctl00$cphRoblox$rbxCatalog$SearchTextBox" type="text" maxlength="100" id="ctl00_cphRoblox_rbxCatalog_SearchTextBox" class="TextBox"/></span>
        <span class="SearchButton"><input type="submit" name="ctl00$cphRoblox$rbxCatalog$SearchButton" value="Search" id="ctl00_cphRoblox_rbxCatalog_SearchButton"/></span>
    </div>
    <div class="DisplayFilters">
      <h2>Catalog</h2>
      <div id="BrowseMode">
        <h4>Browse</h4>
        <ul>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeFeaturedSelector" href="#" onclick="alert('You cannot do this.');">Featured</a></li>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="#" onclick="alert('You cannot do this.');">For Sale</a></li>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="#" onclick="alert('You cannot do this.');">Best Selling</a></li>
          <li><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="#" onclick="alert('You cannot do this.');">Recently Updated</a></li>
        </ul>
      </div>
      <div id="Category">
        <h4>Category</h4>
        
            <ul>
          
            <li>
              <?php if ($type == "head") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/> <?php } ?>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="/Catalog.aspx?type=head">Heads</a>
            </li>
            
            <li>
              <?php if ($type == "face") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/> <?php } ?>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=face">Faces</a>
            </li>
              
            <li>
              <?php if ($type == "hat") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/> <?php } ?>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="/Catalog.aspx?type=hat">Hats</a>
            </li>
             
            <li>
              <?php if ($type == "shirt") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/> <?php } ?>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=shirt">Shirts</a>
            </li>
            
            <li>
              <?php if ($type == "pants") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/> <?php } ?>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=pants">Pants</a>
            </li>
              
            <li>
              <?php if ($type == "tshirt") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0"/> <?php } ?>
              <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=tshirt">T-Shirts</a>
            </li>
          
            </ul>
          
      </div>
      
    </div>
    <div class="Assets">
        <span id="ctl00_cphRoblox_rbxCatalog_AssetsDisplaySetLabel" class="AssetsDisplaySet">Featured <?php echo $sname ?></span>
      <div id="ctl00_cphRoblox_rbxCatalog_HeaderPagerPanel" class="HeaderPager">
        <span id="ctl00_cphRoblox_rbxCatalog_HeaderPagerLabel">Page 1 of 1:</span>
        
        <a id="ctl00_cphRoblox_rbxCatalog_HeaderPagerHyperLink_Next" href="/catalog?hat&sorttype=recentlyupdated&page=1">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
      </div>
      <table id="ctl00_cphRoblox_rbxCatalog_AssetsDataList" cellspacing="0" align="Center" border="0" width="735">
        
    <?php
$sql = "SELECT * FROM catalog WHERE type='$type';";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$resultCheck = count($result);

if ($resultCheck > 0) {
    foreach ($result as $row) {
        $creatorq = $conn->prepare("SELECT * FROM users WHERE id=:creatorid");
        $creatorq->bindValue(':creatorid', $row['creatorid'], PDO::PARAM_INT);
        $creatorq->execute();
        $creator = $creatorq->fetch(PDO::FETCH_ASSOC);
?>

                  
<a href="/Item.aspx?id=<?php echo $row['id']; ?>">
<td valign="top" style="display:inline-block;cursor:pointer;">
            <div class="Asset">
              <div style="display:inline-block;cursor:pointer;">
              <div class="AssetThumbnail">
                <a id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_AssetThumbnailHyperLink" title="" href="/Item.aspx?id=<?php echo $row['id']; ?>" style="display:inline-block;cursor:pointer;"><img src="<?php echo $row['thumbnail']; ?>" width="120" height="120" border="0" id="imga" alt="" blankurl="http://t6.roblox.com:80/blank-120x120.gif"/></a>
              </div>
              <div class="AssetDetails">
                
                <strong><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetNameHyperLink" href="/Item.aspx?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></strong>
                <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_GameCreatorHyperLink" href="/user.aspx?id=<?php echo $creator['id']; ?>"><?php echo $creator['username']; ?></a></span></div>
                
                
                <div id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_Div3" class="AssetPrice"><span class="PriceIn<?php if($row['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; }?>"><?php if($row['buywith'] == 'tix') {echo 'Tx';} else {echo 'G$';} ?>: <?php echo $row['price']; ?></span></div>
              </div>
          </div>
        </td>
</a>
<?php }} ?>   
</table>
        <div id="ctl00_cphRoblox_rbxCatalog_FooterPagerPanel" class="HeaderPager">
            <span id="ctl00_cphRoblox_rbxCatalog_FooterPagerLabel">Page 1 of 1:</span>
            
            <a id="ctl00_cphRoblox_rbxCatalog_FooterPagerHyperLink_Next" href="Catalog.aspx?m=Featured&amp;c=8&amp;t=AllTime&amp;d=All&amp;q=&amp;p=2">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
        </div>
    </div>
    <div style="clear: both;"/>
</div>

        </div>