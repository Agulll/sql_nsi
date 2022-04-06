<!DOCTYPE html>
<html>
<?php 
    $dbco = new PDO('mysql:host=localhost;port=50765;dbname=mdominiq', 'azure', '6#vWHD_$');
    $supr = ("DELETE FROM messages WHERE id = ".$_POST["num-msg"]."");
    $dbco -> exec($supr);
    echo '<script> window.location.href = "blog.php" </script>';
?>
</html> 