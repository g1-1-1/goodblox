<?php
require_once 'include.php'; // Include your PDO connection file here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert3 = $_POST['sitealert3'];
    $sitealert3 = str_replace("'", "\'", $sitealert3);
    $enabled3 = $_POST['enabled3'];
    $color3 = $_POST['sitealert3color'];

    // Prepare the query with placeholders
    $query = "UPDATE `global` SET `ShowingSiteAlert3` = :enabled3, `SiteAlert3Color` = :color3, `SiteAlert3` = :sitealert3 WHERE `global`.`id` = '1';";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':enabled3', $enabled3);
    $stmt->bindParam(':color3', $color3);
    $stmt->bindParam(':sitealert3', $sitealert3);

    // Execute the statement
    $stmt->execute();
}

header('location: sitealerts.php');
require_once 'finclude.php'; // Include your footer file here
?>
