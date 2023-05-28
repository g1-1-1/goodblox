<?php
include($_SERVER["DOCUMENT_ROOT"]."/inc/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/inc/nav.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/inc/config.php");
$id = $_GET["id"];
if($isloggedin == 'yes') {
$stmt = $conn->prepare("SELECT * FROM games WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$newaccountcode = generateRandomString();
$stmt = $conn->prepare("UPDATE users SET accountcode = :accountcode WHERE id = :id");
$stmt->bindParam(':accountcode', $newaccountcode);
$stmt->bindParam(':id', $_USER['id']);
$stmt->execute();

$joinargs = '-script "wait(); dofile(\'http://madblxx.ga/join/character.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\') dofile(\'http://madblxx.ga/join/play.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\')"';
$b64joinargs = base64_encode($joinargs);
header('location: goodbloxplayer:'.$b64joinargs);
}
  
if($isloggedin !== 'yes') {
$stmt = $conn->prepare("SELECT * FROM games WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);
$guest = 'Guest';


$joinargs = '-script "wait(); dofile(\'http://madblxx.ga/join/character.php?placeid='.$game['id'].'&accountcode='.$guest.'\') dofile(\'http://madblxx.ga/join/play.php?placeid='.$game['id'].'&accountcode='.$guest.'\')"';
$b64joinargs = base64_encode($joinargs);
header('location: goodbloxplayer:'.$b64joinargs);
}
?>

<h1>How to play a game</h1>
<h3>Step 1: Radmin VPN</h3>
<a href="http://radmin-vpn.com/"><p>Download Radmin VPN here</p></a>
<p>Join the Radmin VPN network:</p>
<p>Name: DAYBLOX</p>
<p>Pass: lol123</p>
<h3>Step 2: Download <?=$sitename ?> Client</h3>
<a href="/download/MADBLOX-Client.zip"><p>Download <?=$sitename ?> here</p></a>
<h3>Step 3: Join the action!</h3>
<p>Go to your game, you clicked Play on <a href="/place.aspx?id=<?php echo $game['id']; ?>"><?php echo $game['name']; ?></a> before.</p>
<p>Then copy the PlaceId that you can find on the URL</p>
<img src="/images/gameid.png">
<p>Then open !Join.bat on the <?=$sitename ?> Client, paste the PlaceId and your Account Code</p>
<p><strong>Whats an Account Code?</strong> An Account Code is random characters linked to your <?=$sitename ?> account,</p>
<p>Your Account Code is: <?php echo $_USER['accountcode']; ?></p>
<p>Paste your Account Code into !Join.bat</p>
<h3>Step 4: Have fun!</h3>
<h2>Tutorial writen by nolanwhy</h2>
<?php include($_SERVER["DOCUMENT_ROOT"]."/inc/footer.php"); ?>