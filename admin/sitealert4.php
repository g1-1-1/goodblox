<?php
require_once 'include.php'; // Include your PDO connection file here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert4 = $_POST['sitealert4'];
    $sitealert4 = str_replace("'", "\'", $sitealert4);
    $enabled4 = $_POST['enabled4'];
    $color4 = $_POST['sitealert4color'];

    // Prepare the query with placeholders
    $query = "UPDATE `global` SET `ShowingSiteAlert4` = :enabled4, `SiteAlert4Color` = :color4, `SiteAlert4` = :sitealert4 WHERE `global`.`id` = '1';";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':enabled4', $enabled4);
    $stmt->bindParam(':color4', $color4);
    $stmt->bindParam(':sitealert4', $sitealert4);

    // Execute the statement
    $stmt->execute();
}

header('location: sitealerts.php');
require_once 'finclude.php'; // Include your footer file here
?>
