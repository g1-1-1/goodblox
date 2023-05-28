<?php
include '../core/config.php';

$uid = $_POST['personid'];
$gametitle = $_POST['gametitle'];
$description = $_POST['description']; 
$guyid = $_POST['personid'];
$userq = mysqli_query($conn, "SELECT * FROM users WHERE id='$uid'") or die(mysqli_error($conn));
$user = mysqli_fetch_assoc($userq);
?>

<script>
function SubmitForm(token) {
    document.getElementById("reportform").submit();
}
</script>
<title>Abuse Report</title>
<link rel="stylesheet" type="text/css" href="/RobloxOld.css"/>
<div id="body">
<form method="post" id="reportform" action="InGameChat.php">
<strong><center>Abuse Report</center></strong>
<br>
What is the title of the game you are in?
<br>
<input type="text" name="gametitle" placeholder="Type in the Game Title"><br>
Please send the id of the person that is currenty breaking the rules
<br>
<input type="text" name="personid" placeholder="Type in the ID of the person."><br>
Give us a description of what's happening.
<br>
<input type="text" name="description" placeholder="Make a description.."><br>
  
<input name="sd" data-callback='SubmitForm' value="Send" id="Send" class="Button" type="submit" style="margin-top: 5px">
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$currenttimelol = time();

$stmt = "INSERT INTO
`reports`
(`id`, `gamename`, `userid`, `description`, `guyid`, `sent`)
VALUES (
  NULL,
  '$gametitle',
  '". $_USER['id'] ."',
  '$description',
  '$guyid',
  '$currenttimelol')";
                //echo ($stmt);
                $q = mysqli_query($conn, $stmt) or die(mysqli_error($conn));
                  echo "Report sent!";
}
            ?>
