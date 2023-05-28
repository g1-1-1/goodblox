<?php
require_once 'include.php'; // Include your PDO connection file here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert2 = $_POST['sitealert2'];
    $sitealert2 = str_replace("'", "\'", $sitealert2);
    $enabled2 = $_POST['enabled2'];
    $color2 = $_POST['sitealert2color'];

    // Prepare the query with placeholders
    $query = "UPDATE `global` SET `ShowingSiteAlert2` = :enabled2, `SiteAlert2Color` = :color2, `SiteAlert2` = :sitealert2 WHERE `global`.`id` = '1';";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':enabled2', $enabled2);
    $stmt->bindParam(':color2', $color2);
    $stmt->bindParam(':sitealert2', $sitealert2);

    // Execute the statement
    $stmt->execute();
}

header('location: sitealerts.php');
require_once 'finclude.php'; // Include your footer file here
?>
