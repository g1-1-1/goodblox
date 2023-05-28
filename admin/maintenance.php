<?php include('include.php'); ?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="maintenanceenable.php">
    <h1>Maintenance Mode</h1>
    <input id="enabled3" type="radio" name="enabled3"<?php if($_GLOBAL['maintenanceEnabled'] == 'yes') {echo ' checked="checked"';} ?> value="yes" tabindex="6"><label>Enable</label><br>
    <input id="enabled3" type="radio" name="enabled3"<?php if($_GLOBAL['maintenanceEnabled'] == 'no') {echo ' checked="checked"';} ?> value="no" tabindex="6"><label>Disable</label><br>
    <input type="submit" value="Execute" tabindex="4" class="Button" name="submit">
    </form>
</center>
<?php include('finclude.php'); ?>