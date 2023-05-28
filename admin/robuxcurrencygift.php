<?php include('include.php'); ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $count = $_POST["count"];

    // Fetch the user from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $usertogift = $stmt->fetch(PDO::FETCH_ASSOC);

    // Update the user's robux count
    $stmt = $conn->prepare("UPDATE users SET robux = robux + ? WHERE username = ?");
    $stmt->execute([$count, $usertogift["username"]]);

    echo "<h1>Successfully gifted " . $usertogift['username'] . " " . $count . " GOODBUX</h1>";
}
?>

<center>
<a href="currencygift.php"><h1 style="color: black;">< Back</h1></a>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username to gift">
    <input type="text" name="count" placeholder="How many">
    <input type="submit" name="submit" value="Gift">
</form>
</center>
<?php include('finclude.php'); ?>