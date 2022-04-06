<head>
      <title>Fax-it</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="styles.css"/>
      <link rel = "icon" href="icone.ico">
</head>
<div>
<?php
$bd = new PDO('mysql:host=localhost;port=50765;dbname=mdominiq', 'azure', '6#vWHD_$');
$mdp = $_POST['mdp'];
$id = $_POST['id']; 
$question = ("SELECT user FROM utilisateur WHERE user = '".$id."' and mdp = '".$mdp."'");
$reponse = $bd -> query($question);
$reponse = $reponse -> fetchAll();
if (count($reponse) >= 1)
{
    echo "<h1>Vous avez correctement été connecté·e<h1>";
    echo "<form action = 'blog.php' method = 'post'> <input type = 'hidden' value = '".$id."' name = 'pseudo'/> <button> Acceder au blog </button> </form>";
}
else 
{
    echo "Erreur d'identification, veuillez réessayer ou vous créer un compte.<br>";
    echo "<button onclick = 'back()'> Retourner en arrière</button> <script> function back(){window.location.href = 'index.php'} </script>";
}
echo"</div>"
?>