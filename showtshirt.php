<?php require_once('inc/config.php'); 
if(!isset($_GET['size'])) {
    $size = "100%";
} else {
  $size = (int)$_GET['size'];
}
echo"<img src='tshirt.png'>";
?>
<style>
*{
  position:absolute;
  width:<?php echo $size; ?>;
}
</style>