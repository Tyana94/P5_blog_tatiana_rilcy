<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $db->prepare('SELECT * FROM users WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

?>

<html lang="fr">
  <head>
    <title>Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div align="center">
        <h2>Profil de : <?php echo $userinfo['email']; ?></h2><br />
        <?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
        {
        ?>
        <a href="deconnexion.php">Se déconnecter</a>
        <?php
        }
        ?>

    </div>
  </body>
</html>
<?php
}
?>