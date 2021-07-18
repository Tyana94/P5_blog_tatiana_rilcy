<?php
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

if(isset($_POST['forminscription'])) 
{
    $email = htmlspecialchars($_POST['email']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) 
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $reqmail = $db->prepare("SELECT * FROM users WHERE email = ?");
            $reqmail->execute(array($email));
            $mailexist = $reqmail->rowCount();
            if($mailexist ==0)
            {
                if($mdp == $mdp2) 
                {
                    $insertmbr = $db->prepare("INSERT INTO users(email, password) VALUES(?, ?)");
                    $insertmbr->execute(array($email, $mdp));
                    $error = "Votre compte a été crée ! <a href=\"connexion.php\">Connexion  </a>";
                    header('Location:');
                }
                else 
                {
                    $error = "Vos mots de passe ne correspondent pas !";
                }
            } 
            else 
            {
                $error = "Email déjà utilisé !";
            }
        }
    }
    else 
    {
        $error = "Veuillez renseigner tous les champs !";
    }
}

?>



<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Inscription</title>
    <meta charset="utf-8">
  </head>
  <body>
      <div align="center">
          <h2>Inscription</h2>
          <br /><br />
          <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="email">Email :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Votre email" id="email" name="email" />
                    </td>
                </tr>  
                <tr>
                    <td align="right">
                        <label for="mdp">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="mpd" name="mdp" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmer mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmer mot de passe" id="mdp2" name="mdp2" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center"><br />
                        <input type="submit" name="forminscription" value="Inscription" />
                    </td>
                </tr>              
            </table>               
          </form>

          <?php
          if(isset($error))
          {
              echo $error;
          }
          ?>
            
    
  </body>
  </html>