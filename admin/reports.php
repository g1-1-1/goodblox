<?php include('include.php'); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $usertocheck = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usertocheck) {
        // User exists, do something
    } else {
        // User not found
    }
}

?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <?php
        $sql = "SELECT * FROM reports";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$resultCheck = count($result);

if ($resultCheck > 0) {
    foreach ($result as $row) {
        // Process each row
            ?>
            <a href="">
                <h1>Report ID <?php echo htmlspecialchars($row['id']); ?></h1>
                <h2>Game Name: <?php echo htmlspecialchars($row['gamename']); ?></h2>
                <h2>Sent at: <?php echo htmlspecialchars($row['sent']); ?></h2>
                <h2>Cheater's UID: <?php echo htmlspecialchars($row['guyid']); ?></h2>
                <h2>Descriptions of the events: <?php echo htmlspecialchars($row['description']); ?></h2>
            </a>
            <hr>
            <?php
        }
    } ?> 
</center>
<?php include('finclude.php'); ?>