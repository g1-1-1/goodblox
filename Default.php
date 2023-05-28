<?php
include 'inc/header.php';
include 'inc/nav.php';
?>
<div id="Body">
          <script>
  function pF {
 return false
}
  </script>
  <div id="SplashContainer">
    <div id="SignInPane">
      

<div id="LoginViewContainer">
  
      <div id="LoginView">
        <?php if($isloggedin == 'yes') {echo '<h5>Logged In</h5>
  <div id="AlreadySignedIn">
          <a title="'.$_USER['username'].'" href="/My/Home.aspx" style="display:inline-block;height:190px;width:152px;cursor:pointer;"><img src="data:image/png;base64,'.$_USER['thumbnail'].'" style="display:inline-block;width:145px;margin-top:15px;" border="0" id="img" alt="'.$_USER['username'].'"></a>
        ';} else echo '<h5>Member Login</h5>
        
        <div class="AspNet-Login">
            <div class="AspNet-Login"><form method="POST" action="login.aspx">
              <div class="AspNet-Login-UserPanel">
                <label for="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserName" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserNameLabel" class="Label">Character Name</label>
                <input name="username" type="text" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserName" tabindex="1" class="Text">
              </div>
              <div class="AspNet-Login-PasswordPanel">
                <label for="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Password" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_PasswordLabel" class="Label">Password</label>
                <input name="password" type="password" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Password" tabindex="2" class="Text">
              </div>
              <!--div class="AspNet-Login-RememberMePanel"-->
                
              <!--/div-->
              <div class="AspNet-Login-SubmitPanel">
                <button type="submit" name="lb" tabindex="4" type="submit" class="Button">Login</button>
                <!--<a id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Login" tabindex="4" class="Button" href="javascript:__doPostBack(\'ctl00$cphRoblox$rbxLoginView$lvLoginView$lSignIn$Login\',\'\')">Login</a>-->
              </div>
              <div class="AspNet-Login-SubmitPanel">
                               <a tabindex="4" class="Button" href="Login/NewAge.aspx">Register</a>
                        </div>
                        <div class="AspNet-Login-PasswordRecoveryPanel">
                            <a tabindex="5" href="Login/ResetPasswordRequest.aspx">Forgot your password?</a>
                        </div>
            </div>'; ?>
          
</div>
      </div>
    
</div>

      <br>
            
                    <?php if($isloggedin == 'no'){ echo '<div id="ctl00_cphRoblox_LoginView1_pFigure">
               
                <div id="Figure"><a id="ctl00_cphRoblox_LoginView1_ImageFigure" disabled="disabled" title="Figure" onclick="return false" style="display:inline-block;"><img src="/images/NewFrontPageGuy.png" alt="Figure" blankurl="http://t1.roblox.com:80/blank-115x130.gif" border="0"></a></div>
              
</div>'; } else { echo'
<div style="text-align:center; background-color:#eeeeee; border:1px solid black;">
<br>
<h3>'.$sitename.' News</h3>
<a href="/Default.aspx">GoodBlox news added</a><br><br>
<a href="/Default.aspx">Hats Added!</a><br><br>
<a href="">24/7 Servers soon.</a><br><br>
</div>';
} ?>
    
          
    </div>
    <div id="RobloxAtAGlance">
      <h2><?=$sitename?> Virtual Playworld</h2>
      <h3><?=$sitename?> is Free!</h3>
      <ul id="ThingsToDo">
        <li id="Point1">
          <h3>Build your personal Place</h3>
          <div>Create buildings, vehicles, scenery, and traps with thousands of virtual bricks.</div>
        </li>
        <li id="Point2">
          <h3>Meet new friends online</h3>
          <div>Visit your friend's place, chat in 3D, and build together.</div>
        </li>
        <li id="Point3">
          <h3>Battle in the Brick Arenas</h3>
          <div>Play with the slingshot, rocket, or other brick battle tools.  Be careful not to get "bloxxed".</div>
        </li>
      </ul>
      <div id="Showcase">
        <iframe width="400" height="326" src="https://www.bitview.net/embed.php?v=LYkKRQuT7_5" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        <br><br>
      </div>
      <div id="Install">
        <div id="CompatibilityNote"><div id="ctl00_cphRoblox_pCompatibilityNote">
  Works with your<br>Windows PC!
</div></div>
        
        <div id="DownloadAndPlay"><a id="ctl00_cphRoblox_hlDownloadAndPlay" href="download/GoodBlox.7z"><img src="/images/PlayNowGreenFader.gif" alt="FREE - Download and Play!" border="0"></a></div>
      </div>
      <div id="ctl00_cphRoblox_pForParents">
        <div id="ForParents">
          <a id="ctl00_cphRoblox_hlKidSafe" title="<?=$sitename?> is gamer-safe!" href="Parents.html" style="display:inline-block;"><img title="<?=$sitename?> is gamer-safe!" src="images/GamerSeal.png" border="0"/></a>
        </div>
  
        <div id="ctl00_cphRoblox_pForParents">
</div>
      
</div>
    </div>
    <div id="UserPlacesPane">
    <div id="UserPlaces_Content">
      <table width="100%" cellspacing="0" border="0">
        <tbody>
          <tr>
            <td class="UserPlace">
              <a title="Our Discord Server" href="https://discord.gg/AXpQe5pWgJ" style="display:inline-block;cursor:pointer;margin-top:-10px;"><img src="https://web.archive.org/web/20201231200504im_/https://goodblox.xyz/resources/discord.png" id="img" alt="Our Discord Server" width="85" height="85" border="0"></a>
            </td>
            <td class="UserPlace">
              <a title="Our Twitter Page" href="https://twitter.com/MADBLOX5" style="display:inline-block;cursor:pointer;margin-left:30px;"><img src="https://web.archive.org/web/20201231200504im_/https://goodblox.xyz/resources/Twitter1.png" id="img" alt="Our Twitter Page" width="50" height="50" border="0"></a>
            </td>
            <td class="UserPlace">
              <a title="E-mail us!" href="mailto:team@madblxx.ga" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20201231200504im_/https://goodblox.xyz/resources/mail.png" id="img" alt="E-mail us!" width="80" height="80" border="0"></a>
            </td>
            <td class="UserPlace">
              <a title="Our Subreddit!" href="https://reddit.com/r/dayblox" style="display:inline-block;cursor:pointer;margin-top:-10px;"><img src="https://web.archive.org/web/20201231200504im_/https://goodblox.xyz/resources/reddit.png" id="img" alt="Our Subreddit!" width="75" height="75" border="0"></a>
            </td>

            <td class="UserPlace">
              <a title="Our YouTube Channel" href="https://www.youtube.com/@MADBLOX-gh3wr" style="display:inline-block;cursor:pointer;"><img src="https://web.archive.org/web/20201231200504im_/https://goodblox.xyz/resources/youtube.png" id="img" alt="Our YouTube Channel" border="0"></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="UserPlaces_Header" style="min-height:70px;">
      <h3><?=$sitename?> Links</h3>
      <p>Check out our important links that you could visit!</p>
    </div>
  </div>

        </div>
<?php
include 'inc/footer.php';  
?>
