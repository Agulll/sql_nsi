<html>
    <head>
        <title>Fax-it verification</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css"/>
        <link rel = "icon" href="icone.ico">
    </head>
	<div>
    <?php
    $bd = new PDO('mysql:host=localhost;port=50765;dbname=mdominiq', 'azure', '6#vWHD_$');
	$mdp = $_POST['mdp'];
	$id = $_POST['id'];
    $question = ("SELECT user FROM utilisateur WHERE user ='".$id."'");
	$reponse = $bd -> query($question);
	$reponse = $reponse -> fetchAll();
	if (count($reponse) >= 1)
	{
		echo "Utilisez un autre nom svp";
	} else {
		$requeteU = ("INSERT INTO utilisateur(mdp, user) VALUE ('".$mdp."','". $id ."')");
		$bd -> exec($requeteU); 
		echo "<p> Félicitation vous êtes connecté·e </p>
		<form method='post' action='blog.php'>
		<input type='hidden' value='".$id."' name = 'pseudo'>
		<button type='submit'>Acceder au blog.</button>";
	}
	echo "</div>";
	?>
</html>
