<?php
include($_SERVER["DOCUMENT_ROOT"]."/inc/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/nav.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
$id = $_GET["id"];
$gameq = $conn->query("SELECT * FROM games WHERE id='$id'");
$game = $gameq->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM games WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$creatorq = $conn->query("SELECT * FROM users WHERE id='".$game['creator_id']."'");
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);

$creator_query = $conn->prepare("SELECT * FROM users WHERE id=:id");
$creator_query->bindParam(':id', $game['creator_id']);
$creator_query->execute();
$creator = $creator_query->fetch(PDO::FETCH_ASSOC);

if($creator['id'] !== $_USER['id']) {
    die("<h1>You do not own this place.</h1>");
    exit;
}

if(!isset($_POST["maplocation"])) { ?>
<?php
 if ($isloggedin == 'no') {
    die("<script>document.location = \"login/\"</script>");
  }
  else {
    echo '
<h1 class="title titlewithmargin" style="border: 1px solid black; padding: 10px">Game hosting</h1>';
    ?>
<?php } ?>
<div style="border: 1px solid black; padding: 10px">
    <h1 style="margin-top: 0px">Hello fellow user! Please enter the map's file path.</h1>
    <p style="color: red">Make sure the folder and file specified exists, or else the client will throw an error.</p>
    <p style="color: red">Put a slash at the end of the folder path.</p>
    <p>Don't worry, this is a safe form. The client will be looking at your PC, not the site.</p>
  <br>
<style>
  .title{font-family: verdana, serif-sans; letter-spacing: 5px; font-weight: normal; display: flex;}
  .titlenospacing{letter-spacing: 0px;}
  .hubbox{background-color: red; padding: 5px; color: white; border: darkred 2px solid; font-size: 0.8em; outline: black 0.5px dotted; letter-spacing: 0px;}
  .titlewithpadding{padding-top: 20px; vertical-align: center;}
  </style>
    <form action="" method="POST">
        <input type="text" name="maplocationfolder" placeholder="C:/Folder/" value="<?php echo $_USER["defaultmaplocationfolder"]; ?>"><br>
      <br>
        <input type="text" name="maplocation" placeholder="place.rbxl" value="<?php echo $game["defaultmapfilename"]; ?>"><br>
      <br>
        <input type="submit" name="submit" value="Host">
    </form>
</div>
<?php
    die();
} else {
    $mapfilename = addslashes($_POST["maplocation"]);
    $maplocationfolder = addslashes($_POST["maplocationfolder"]);
    $maplocation = $maplocationfolder.$mapfilename;
$stmt = $conn->prepare("UPDATE users SET defaultmaplocationfolder = :maplocationfolder WHERE id = :id");
$stmt->bindParam(':maplocationfolder', $maplocationfolder);
$stmt->bindParam(':id', $_USER['id']);
$stmt->execute();

$stmt = $conn->prepare("UPDATE games SET defaultmapfilename = :mapfilename WHERE id = :id");
$stmt->bindParam(':mapfilename', $mapfilename);
$stmt->bindParam(':id', $game['id']);
$stmt->execute();

    $contains = ' ';
    if (strpos($maplocation, $contains) !== false) {
        $maplocation = '"'.$maplocation.'"';
    }
}
$joinargs = $maplocation.' -no3d -script  "wait(); dofile(\'http://madblxx.ga/join/server.php?game='.$game['id'].'\') dofile(\'http://madblxx.ga/join/FixAssetLinks.php\')"';
$b64joinargs = base64_encode($joinargs);
header('location: goodbloxplayer:'.$b64joinargs);
?>
<?php
  include 'inc/footer.php';
  ?>