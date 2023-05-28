<?php include('include.php'); ?>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertoban = $_POST['usertoban'];
    $usertoban = str_replace("'","\'",$usertoban);
    $banreason = $_POST['banreason'];
    $banreason = str_replace("'","\'",$banreason);
    $unbantime = time();
    $oneday = 86400;
    $date = date("Y-m-d H-m-s");
    if($_POST['bantype'] == 'reminder') {
        $bantype = 'Reminder'; 
        $unbantime = time();
    } elseif($_POST['bantype'] == 'warning') {
        $bantype = 'Warning'; 
        $unbantime = time();
    } elseif($_POST['bantype'] == '1days') {
        $bantype = '1daysban'; 
        $unbantime = time() + ($oneday);
    } elseif($_POST['bantype'] == 'delete') {
        $bantype = 'Ban'; 
        $unbantime = time() + (9999999999999999999999999999999999999999999);
    } else {
        $bantype = 'None';
    }
    $banq = $conn->prepare("UPDATE `users` SET `bandate` = :date, `bantype` = :bantype, `unbantime` = :unbantime, `banreason` = :banreason WHERE `users`.`username` = :username");
    $banq->execute(array(':date' => $date, ':bantype' => $bantype, ':unbantime' => $unbantime, ':banreason' => $banreason, ':username' => $usertoban));
} 
?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input name="usertoban" type="text" tabindex="1" class="Text" placeholder="User to ban"><br>
    <input id="bantype" type="radio" name="bantype" value="unban" checked="checked" tabindex="6"><label>Unban</label><br>
    <input id="bantype" type="radio" name="bantype" value="reminder" tabindex="6"><label>Reminder</label><br>
    <input id="bantype" type="radio" name="bantype" value="warning" tabindex="6"><label>Warning</label><br>
    <input id="bantype" type="radio" name="bantype" value="1days" tabindex="6"><label>1 days ban</label><br>
    <input id="bantype" type="radio" name="bantype" value="delete" tabindex="6"><label>Delete</label><br>
    <input name="banreason" type="text" tabindex="1" class="Text" placeholder="Ban Reason"><br>
    <input type="submit" value="(Un)ban" tabindex="4" class="Button" name="submit">
    </form>
</center>
<?php include('finclude.php'); ?>