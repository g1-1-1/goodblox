<?php
include $_SERVER["DOCUMENT_ROOT"].'/inc/header.php';
include $_SERVER["DOCUMENT_ROOT"].'/inc/nav.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/inc/config.php';

if($isloggedin !== 'yes') {
  header('location: /login.aspx');
}

if($_SERVER["REQUEST_METHOD"] == 'POST') {
  
  
$currentDirectory = getcwd();
    $uploadDirectory = "../Thumbs/Games/";

    $errors = []; // Store errors here

    $fileExtensionsAllowed = ['jpeg','jpg','png','gif']; // These will be the only file extensions allowed 

    $fileName = $_FILES['thumb']['name'];
    $fileSize = $_FILES['thumb']['size'];
    $fileTmpName  = $_FILES['thumb']['tmp_name'];
    $fileType = $_FILES['thumb']['type'];
    $fileExtension = strtolower(end(explode('.',htmlentities(mysqli_real_escape_string($link, $fileName)))));

    $uploadPath = $uploadDirectory . time() . "." . $fileExtension; 
    $jelly = time() . "." . $fileExtension;

    //print_r($_FILES);
if($fileSize > 0)
{ 
    $errors=array();
    $allowed_ext= array('jpg','jpeg','png','gif');
    $file_name =$_FILES['thumb']['name']; // die(print_r($_FILES));
 //   $file_name =$_FILES['image']['tmp_name'];
    $file_ext = strtolower(end(explode('.',htmlentities(mysqli_real_escape_string($link, $file_name)))));


    $file_size=$_FILES['thumb']['size'];
    $file_tmp= $_FILES['thumb']['tmp_name'];
    // echo $file_tmp;echo "<br>";

    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    // echo "Base64 is ".$base64; die();



    if (! in_array($file_ext,$allowed_ext))
    {
        $errors[]='Extension not allowed';
    }

    if($file_size > 8388608)
    {
        $errors[]= 'File size must be under 8mb';

    }
    if(empty($errors))
    {
       if( move_uploaded_file($file_tmp, 'images/'.$file_name));
       {
        header("Location: /Games.aspx");
       }
    }
    else
    {
        foreach($errors as $error)
        {
          // die("Error creating place."); 
          echo $error , '<br/>'; 
        }
    }
   //  print_r($errors);

}else{
  header("Location: /Games.aspx");
  }
  
  $gamename = $_POST["name"];
  $gamedesc = $_POST["map"];
  $gameip = $_POST["ip"];
  $gameport = $_POST["port"];
  $thumb = base64_encode($data);
  
  $stmt = $conn->prepare("INSERT INTO games (name, description, thumbnail, creator_id, ip, port) VALUES (:name, :description, :thumbnail, :creator_id, :ip, :port)");
  $stmt->execute(['name' => $gamename, 'description' => $gamedesc, 'creator_id' => $_USER['id'], 'ip' => $gameip, 'port' => $gameport, 'thumbnail' => $thumb]);
  
  if ($stmt->rowCount() > 0) {
    echo "New record created successfully";
  } else {
    echo "Error: Unable to create new record";
  }
}

header('location: /');
?>
