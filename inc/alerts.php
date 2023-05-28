<?php
$one = $_GLOBAL['SiteAlert1'];
$one = htmlspecialchars(str_replace('{domain}',$sitedomain,$one));
$onecolor = $_GLOBAL['SiteAlert1Color'];

$two = $_GLOBAL['SiteAlert2'];
$two = htmlspecialchars(str_replace('{domain}',$sitedomain,$two));
$twocolor = $_GLOBAL['SiteAlert2Color'];

$three = $_GLOBAL['SiteAlert3'];
$three = htmlspecialchars(str_replace('{domain}',$sitedomain,$three));
$threecolor = $_GLOBAL['SiteAlert3Color'];

$four = $_GLOBAL['SiteAlert4'];
$four = htmlspecialchars(str_replace('{domain}',$sitedomain,$four));
$fourcolor = $_GLOBAL['SiteAlert4Color'];

$five = $_GLOBAL['SiteAlert5'];
$five = htmlspecialchars(str_replace('{domain}',$sitedomain,$five));
$fivecolor = $_GLOBAL['SiteAlert5Color'];
if($_GLOBAL['ShowingSiteAlert1'] == 'yes') {echo '<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: '.htmlspecialchars($onecolor).'">
            <div class="Exclamation">
            </div>
            <div id="sitealert1txt">'.htmlspecialchars($one).'</div>
          </div>
        </div>';} ?>
        <?php if($_GLOBAL['ShowingSiteAlert2'] == 'yes') {echo '<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: '.htmlspecialchars($twocolor).'">
            <div class="Exclamation">
            </div>
            <div id="sitealert2txt">'.htmlspecialchars($two).'</div>
          </div>
        </div>';} ?>
       <?php if($_GLOBAL['ShowingSiteAlert3'] == 'yes') {echo '<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: '.htmlspecialchars($threecolor).'">
            <div class="Exclamation">
            </div>
            <div id="sitealert3txt">'.htmlspecialchars($three).'</div>
          </div>
        </div>';} ?>    
        <?php if($_GLOBAL['ShowingSiteAlert4'] == 'yes') {echo '<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: '.htmlspecialchars($fourcolor).'">
            <div class="Exclamation">
            </div>
            <div id="sitealert4txt">'.htmlspecialchars($four).'</div>
          </div>
        </div>';} ?>    
        <?php if($_GLOBAL['ShowingSiteAlert5'] == 'yes') {echo '<div class="SystemAlert">
          <div class="SystemAlertText" style="background-color: '.htmlspecialchars($fivecolor).'">
            <div class="Exclamation">
            </div>
            <div id="sitealert5txt">'.htmlspecialchars($five).'</div>
          </div>
        </div>';}  ?>   
        