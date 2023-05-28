<?php
$servername = "mysql.serv00.com"; 
$username = "m2743_goodblox"; 
$password = "GoodBlox!2023"; 
$dbname = "m2743_goodbloxdb"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
