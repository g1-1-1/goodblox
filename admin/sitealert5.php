<?php
require_once 'include.php'; // Include your PDO connection file here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert5 = $_POST['sitealert5'];
    $sitealert5 = str_replace("'", "\'", $sitealert5);
    $enabled5 = $_POST['enabled5'];
    $color5 = $_POST['sitealert5color'];

    // Prepare the query with placeholders
    $query = "UPDATE `global` SET `ShowingSiteAlert5` = :enabled5, `SiteAlert5Color` = :color5, `SiteAlert5` = :sitealert5 WHERE `global`.`id` = '1';";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':enabled5', $enabled5);
    $stmt->bindParam(':color5', $color5);
    $stmt->bindParam(':sitealert5', $sitealert5);

    // Execute the statement
    $stmt->execute();
}

header('location: sitealerts.php');
require_once 'finclude.php'; // Include your footer file here
?>
