<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';
if($isloggedin !== 'yes') {header('location: /login.aspx');}
?>
<style>
#EditProfileContainer {
    background-color: #eeeeee;
    border: 1px solid #000;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
fieldset {
    font-size: 1.2em;
    margin: 15px 0 0 0;
}
</style>
<br>
<form method="POST" action="EditProfile.aspx">
<div id="EditProfileContainer">
    <h2>Edit Profile</h2>
    <div><span id="WrongOldPW" style="color:Red;"></span></div>
    <div id="Blurb">
        <fieldset title="Update your personal blurb">
            <legend>Update your personal blurb</legend>
            <div class="Suggestion">
                Describe yourself here (max. 1000 characters).  Make sure not to provide any details that can be used to identify you outside <?=$sitename ?>.
            </div>
            <div class="Validators">

            </div>
            <div class="BlurbRow">
                <textarea rows="8" name="desc"  cols="2" id="Blurb" tabindex="3" class="MultilineTextBox"></textarea>
            </div>
        </fieldset>
    </div>
    <div class="Buttons">
        <input id="Submit" tabindex="4" class="Button" type="submit" name="descupd" value="Update">&nbsp;<a id="Cancel" tabindex="5" class="Button" href="/my/home">Cancel</a>

    </form>
    </div>
</div>

</form>
