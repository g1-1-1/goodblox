<?php include('include.php'); ?>
<center>
    <h1 style="color: black;">Welcome to the Admin Panel, don't forget to read the <a href="help.php">documentation</a>, <?php echo $_USER['username']; ?></h1>
    <h3 style="color: blue;">Not Dangerous</h3>
    <a style="color: blue;" href="ban.php">(Un)ban someone</a><br>
    <a style="color: blue;" href="sitealerts.php">Change Site Alerts</a><br>
    <a style="color: blue;" href="altidentification.php">Alt identification</a><br>
    <a style="color: blue;" href="currencygift.php">Currency Gift</a><br>
    <a style="color: blue;" href="givebuildersclub.php">Give Builders Club</a><br>
    <a style="color: blue;" href="giveadmin.php">Give Admin</a><br>
    <a style="color: blue;" href="ipban.php">IP Bans</a><br>
    <a style="color: blue;" href="reports.php">Check Reports</a><br>
    <h3 style="color: red;">Dangerous</h3>
    <a style="color: red;" href="maintenance.php">Enable Maintenance Mode</a><br>
    <hr>
    
</center>
<?php include('finclude.php'); ?>