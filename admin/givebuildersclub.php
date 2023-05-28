<?php include('include.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertogive = $_POST['usertogive'];
    $expiredate = $_POST['expiredate'];
    $givetype = $_POST["bctype"];

    $sql = "UPDATE users SET BC = :givetype, BCExpire = :expiredate WHERE username = :usertogive";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':givetype', $givetype);
    $stmt->bindParam(':expiredate', $expiredate);
    $stmt->bindParam(':usertogive', $usertogive);
    $stmt->execute();
}

?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="">
    <input name="usertogive" type="text" tabindex="1" class="Text" placeholder="User to gift"><br>
    <input name="bctype" type="text" tabindex="1" class="Text" placeholder="Type"><br>
    <input name="expiredate" type="text" tabindex="1" class="Text" placeholder="Expiration Date"><br><br>
    <input type="submit" value="Give" tabindex="4" class="Button" name="submit">
    <br>
    Expiration Date Format: YYYY-MM-DD
    <br>
    </form>
</center>
<?php include('finclude.php'); ?>