<?php require_once($_SERVER['DOCUMENT_ROOT']."/inc/config.php");

// Prepare the SQL query with a placeholder for the parameter
$sql = "SELECT * FROM games WHERE id = :id";

// Prepare the PDO statement
$stmt = $conn->prepare($sql);

// Bind the parameter value to the placeholder
$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

// Execute the query
$stmt->execute();

// Fetch the result as an associative array
$usrid = $stmt->fetch(PDO::FETCH_ASSOC);

// $usrid['rblxid']

header("Content-Type: image/png");

if($usrid['thumbnail']){

echo base64_decode($usrid['thumbnail']);

}else{

header('location: /images/unavail-160x100.png');

}
?>