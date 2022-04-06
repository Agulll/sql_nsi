<!DOCTYPE html>
<HTML>
    <head>
        <title>Fax-it</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css"/>
        <link rel = "icon" href="icone.ico">
    </head>
  <body>
    <div class="msg">
        <h1><u>Fax-it, Le Blog :</u></h1>
    </div>
    <br>
        <?php
        $bd = new PDO('mysql:host=localhost;port=50765;dbname=mdominiq', 'azure', '6#vWHD_$');
        echo "<form action='formulaire.php' method='POST'>
        <label for='text'> <u>Message</u></label>
        <textarea id='text' name='msg' cols='30' rows='4' placeholder='entrer ici le commentaire'></textarea>
        <input type = 'hidden' value = '".$_POST['pseudo']."' name = 'pseudo'/>
        <br>
        <button type = 'submit'> Poster </button>
        </form>";
        $contain = $bd->query("SELECT msg, autor,id, d FROM messages");
        while ($rep = $contain -> fetch()) 
        {
        echo '<div> <p>' . $rep['msg'] .'<br/><br/><u>Auteur : '.$rep['autor'].' Date et heure :'.$rep['d'].'</u></p>' ;
        if ($rep['autor'] == $_POST['pseudo'])
          {
            echo"<form action='Supr.php' method='post'>
            <input type='hidden' value='".$rep['id']."' name='num-msg'>
            <button type='submit'>Supprimer le message.</button>";
          }
          echo"</div>";
        }
        ?>
  </body>
</HTML>