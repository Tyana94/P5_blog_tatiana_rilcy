<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

if(isset($_POST['formconnexion'])) 
{
  $mailconnect = htmlspecialchars($_POST['mailconnect']);
  $mdpconnect = sha1($_POST['mdpconnect']);
  if(!empty($mailconnect) AND !empty($mdpconnect)) 
  {
    $requser = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $requser->execute(array($mailconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if($userexist == 1) 
    {
      $userinfo = $requser->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['email'] = $userinfo['email'];
      $_SESSION['password'] = $userinfo['password'];
      header("Location: profil.php?id=".$_SESSION['id']);
    }
    else 
    {
      $error = "Votre email ou mot de passe est incorrect.";
    }
  }
  else 
  {
    $error = "Veuillez renseigner tous les champs.";
  }
}

?>


<!DOCTYPE html>
<html lang="fr">

  <head>
    <title>Connexion blog</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div align="center">
      <h2>Connexion</h2>
      <form method="POST" action="">
        <table>
          <tr>
            <td align="right">
              <label for="email">Votre e-mail : </label>
            </td>
            <td>
              <input type="email" placeholder="Saisir e-mail" id="email" name="mailconnect" />
            </td>
          </tr>
          <tr>
            <td align="right">
              <label for="password">Mot de passe : </label>
            </td>
            <td>
              <input type="password" placeholder="Saisir mot de passe" id="password" name="mdpconnect" />
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <br />
              <input type="submit" name="formconnexion" value="Se connecter" />
            </td>
          </tr>
        </table>
      </form>
      <?php
      if(isset($error)) 
      {
        echo '<font color="red>' .$error;
      }
      ?>

    </div>
  </body>
</html>
