<?php
require_once 'include.php'; // Include your PDO connection file here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert1 = $_POST['sitealert1'];
    $sitealert1 = str_replace("'", "\'", $sitealert1);
    $enabled1 = $_POST['enabled1'];
    $color1 = htmlspecialchars($_POST['sitealert1color']);

    // Prepare the query with placeholders
    $query = "UPDATE `global` SET `ShowingSiteAlert1` = :enabled1, `SiteAlert1Color` = :color1, `SiteAlert1` = :sitealert1 WHERE `global`.`id` = '1';";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':enabled1', $enabled1);
    $stmt->bindParam(':color1', $color1);
    $stmt->bindParam(':sitealert1', $sitealert1);

    // Execute the statement
    $stmt->execute();
}

header('location: sitealerts.php');
require_once 'finclude.php'; // Include your footer file here
?>
