<?php include('include.php'); ?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM users WHERE username = '".addslashes($_POST["username"])."';";
    $stmt = $conn->prepare($sql);
$stmt->execute();
$usertocheck = $stmt->fetch(PDO::FETCH_ASSOC);

}
?>
<center>
    <a href="index.php"><h1 style="color: black;">< Back</h1></a>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="submit" name="submit" value="Check alts">
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM users WHERE ip = :ip";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':ip', $usertocheck['ip']);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    if(count($result) > 0) {
        foreach($result as $row) {
           

            ?>
            <a href="/user.aspx?id=<?php echo htmlspecialchars($row['id']); ?>">
                <h1>User ID <?php echo htmlspecialchars($row['id']); ?></h1>
                <h2><?php echo htmlspecialchars($row['username']); ?></h2>
                <h2>Account Created at <?php echo htmlspecialchars($row['join_date']); ?></h2>
            </a>
            <hr>
            <?php
        }}
    } else { ?>
    <h1>Complete the form to check.</h1>
    <?php } ?>
</center>
<?php include('finclude.php'); ?>