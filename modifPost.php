<?php
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

$mode_edition = 0;

if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
    $mode_edition = 1;
    $edit_id = htmlspecialchars($_GET['edit']);
    $edit_post = $db->prepare('SELECT * FROM posts WHERE id = ?');
    $edit_post->execute(array($edit_id));

    if($edit_post->rowCount() ==1) {

        $edit_post = $edit_post->fetch();

    } else {
        die('Erreur : l\'article n\'existe pas.');
    }
}

if(isset($_POST['post_title'], $_POST['post_content'], $_POST['post_contents'], $_POST['post_user_id'])) {
    if(!empty($_POST['post_title']) AND !empty($_POST['post_content']) AND !empty($_POST['post_contents']) AND !empty($_POST['post_user_id'])){
        $post_title = htmlspecialchars($_POST['post_title']);
        $post_content = htmlspecialchars($_POST['post_content']);
        $post_contents = htmlspecialchars($_POST['post_contents']);
        $post_user_id = htmlspecialchars($_POST['post_user_id']);

        if($mode_edition == 1) {
        $ins = $db->prepare('INSERT INTO posts (title, content, contents, user_id, creation_date) VALUES (?,?,?,?, NOW())');
        $ins->execute(array($post_title, $post_content, $post_contents, $post_user_id));
          $message ="<span style='color:green'>Votre article a bien été posté</span>";

      } else{
          $update = $db->prepare('UPDATE posts SET title = ?, content = ?, contents = ?, user_id = ?, edition_date = NOW() WHERE id = ?');
          $update->execute(array($post_title, $post_content, $post_contents, $post_user_id, $edit_id));
          $message ="<span style='color:green'>Votre article a bien été mis à jour</span>";
      }

    } else {
        $message = "<span style='color:red'>Veuillez remplir tous les champs</span>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Rédaction / Edition</title>
    <meta charset="utf-8">
</head>
<body>

  <p><a href="index.php">Retour à la liste des posts</a></p>
    <form method="POST">
        <input type="text" name="post_title" placeholder="Titre"<?php if($mode_edition == 1) { ?> value="<?= $edit_post['title'] ?>"<?php } ?> /><br />
        <textarea name="post_content" placeholder="Chapo"><?php if($mode_edition == 1) { ?><?= $edit_post['content'] ?><?php } ?></textarea><br />
        <textarea name="post_contents" placeholder="Contenu de l'article"><?php if($mode_edition == 1) { ?><?= $edit_post['contents'] ?><?php } ?></textarea><br />
        <textarea name="post_user_id" placeholder="Identifiant"><?php if($mode_edition == 1) { ?><?= $edit_post['user_id'] ?><?php } ?></textarea><br />
        <input type="submit" value="Envoyer l'article" />
    </form>
    <br />
    <?php if(isset($message)) { echo $message; } ?>

</body>
</html>
