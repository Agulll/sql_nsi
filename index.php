<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "style.css"/>
		<meta charset="utf-8" />
		<title>Décision Blog</title>
		<link rel = "shortcut icon" href = "dés.png"/>
	</head>
<body>
	<header>
		<div class = "logo">
			<a href = "index.php"> <p> <img class = "icone" src = "dés.png"/> Decision Blog </p> </a> 
			<div id = "banderole">
				<a href = "connect.php"> <input type="button" value="se connecter" id = "connection"/> </a>
				<a href = "inscrit.php"> <input type="button" value="s'inscrire" id = "inscription"/> </a>
				<?php if (isset ($_SESSION['connecté?'])) {
					if ($_SESSION['connecté?'] == 'oui') {
						echo "<script>function confirm() {return confirm('Voulez vous vous déconnecter ?');} </script> <form action = 'deco.php' method = 'post'> <button onclick = 'return confirm()'> se déconnecter </button> </form>";
					}
				} 
				?>
			</div>
		</div>
	</header>
	<div id = "taille">
		<div id = "msg">
			<?php
				$dbco = new PDO('mysql:host=localhost;port=50765;dbname=nvidal', 'azure', '6#vWHD_$');
				$message = "CREATE TABLE message(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,contenu_msg TEXT,date_et_heure DATETIME, auteur TEXT)";
				$user = "CREATE TABLE users(email VARCHAR(100) PRIMARY KEY, pseudo TEXT, mdp TEXT)";
				$dbco -> exec($message);
				$dbco -> exec($user); 
					if (isset($_SESSION['connecté?'])) {
						if ($_SESSION['connecté?'] == "oui") {
							echo '<form id = "formulaire" action = "index.php" method = "post" name = "formulaire"> 
								<textarea name = "texte" placeholder="écrivez votre message ici" id = "textarea"></textarea>
								<input type = "hidden" value = "'. $_SESSION['email'] .'" name = "email" />
								<input type = "hidden" value = "oui" name = "connecté?" />
								<button id = "post"> POSTER </button>
							</form>';
							if(!empty($_POST)) { 
								if (isset($_POST['texte'])) {
									if($_POST['texte']!="") {
										$recup = addslashes($_POST['texte']);
										$demande = $dbco -> query("SELECT pseudo FROM users WHERE email = '". $_SESSION['email'] ."'");
										$pseudo = $demande->fetch();
										$ajout = "INSERT INTO message(contenu_msg, date_et_heure, auteur) VALUES('".$recup."', NOW(), '".$pseudo[0]."')";
										$dbco -> exec($ajout);
									} 
								}
							}
						}
					} else {echo '<h2> connectez vous pour pouvoir envoyer un message ! </h2> <br />';}
				$contenu = $dbco->query("SELECT id, contenu_msg, date_et_heure, auteur FROM message");
				if (isset($_SESSION['email'])) {
						$demande = $dbco -> query("SELECT pseudo FROM users WHERE email = '". $_SESSION['email'] ."'");
						$pseudo2 = $demande->fetch();
					while ($reponse = $contenu->fetch()) {
						if ($pseudo2[0] == $reponse['auteur']) {
							echo '<script> function confirm_tu() {return confirm("Êtes vous sur de vouloir supprimer votre message ?")} </script>';
							echo '<div class="mise_en_page">' . $reponse['contenu_msg'] .'<form method = "post" action = "supr.php">
							<input type = "hidden" value = "'.$reponse['id'].'" name = "id"/> <input type = "submit" value ="SUPPRIMER LE MESSAGE" onclick = "return confirm_tu()" /></form> <br />
							<form action = "modif.php" method = "post">
							<input type = "hidden" value = "'.$reponse['id'].'" name = "id"/> <input type = "submit" value ="Modifier le message"/> </form>
							<br />date: '. $reponse['date_et_heure'].' | pseudo:'.$reponse['auteur'].'</div> <br />' ;
						} else {
							echo '<div class="mise_en_page"> <pre>' . $reponse['contenu_msg'] .'<br /> <br />date: '. $reponse['date_et_heure'].' | pseudo:'.$reponse['auteur'].'</pre> </div> <br />' ;
						}
					}
					$contenu->closeCursor();
				} else {
					while ($reponse = $contenu->fetch()) {
						echo '<div class="mise_en_page"> <pre>' . $reponse['contenu_msg'] .'<br /> <br />date: '. $reponse['date_et_heure'].' | pseudo:'.$reponse['auteur'].'</pre> </div> <br />' ;
					}
				}
			?>
		</div>
	</div>

</body>
</html>  