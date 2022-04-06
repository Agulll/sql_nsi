<head>
      <title>Fax-it</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="styles.css"/>
      <link rel = "icon" href="icone.ico">
</head>
<div>
<?php
$bd = new PDO('mysql:host=localhost;port=50765;dbname=mdominiq', 'azure', '6#vWHD_$');
$msg = $_POST['msg'];
$pseudo = $_POST['pseudo'];
$requeste = ('INSERT INTO messages(autor, msg, d) VALUE ("'.$pseudo.'","'.$msg.'", NOW())'); 
$bd -> exec($requeste);
echo 'Message bien ajouté au blog !';
echo '<form action = "Blog.php" method = "POST"> <input type = "hidden" value = "'.$pseudo.'" name = "pseudo"/> <button> Revenir en arrière </button> ';
echo '</div>';
?>