<?php include('include.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertogive = $_POST['usertogive'];
    $givetype = $_POST["admintype"];

    $sql = "UPDATE users SET USER_PERMISSIONS = :givetype WHERE username = :usertogive";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':givetype', $givetype);
    $stmt->bindParam(':usertogive', $usertogive);
    $stmt->execute();
}

?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="">
    <input name="usertogive" type="text" tabindex="1" class="Text" placeholder="User to promote"><br>
    <input name="admintype" type="text" tabindex="1" class="Text" placeholder="Type"><br>
    <h5>Put None or Administrator on Type</h5>
    <input type="submit" value="Give" tabindex="4" class="Button" name="submit">
    </form>
</center>
<?php include('finclude.php'); ?>