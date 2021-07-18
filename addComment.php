<?php
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

        if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $getid = htmlspecialchars($_GET['id']);

            $post = $db->prepare('SELECT * FROM posts WHERE id = ?');
            $post->execute(array($getid));
            $post = $post->fetch();

            if(isset($_post['submit_comment'])) {
                if(isset($_POST['user_id'],$_POST['comment']) AND !empty($_POST['user_id']) AND !empty($_POST['comment'])
                    ) {
                    $user_id = htmlspecialchars($_POST['user_id']);
                    $comment = htmlspecialchars($_POST['comment']);
                    if(strlen($user_id) < 30) {

                        $ins = $db->prepare('INSERT INTO comments(user_id, comment, post_id) VALUES (?,?,?)');
                        $ins->execute(array($user_id,$comment,$getid));
                        $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";

                    } else {
                        $c_msg = "Erreur: Le pseudo doit faire moins de 30 caractères";
                    }
                } else {
                    $c_msg = "Erreur: Tous les champs doivent être renseignés";
                }
            }
            $comments = $db->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
            $comments->execute(array($getid));

?>




<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Blog PHP !</h1>
<p><a href="index.php">Retour à la liste des posts</a></p>

                  <div class="news">
                      <h3>
                          <?= htmlspecialchars($post['title']) ?>
                      </h3>
                      <p>
                        <em>le <?= $post['creation_date'] ?></em><br />
                          <?= nl2br(htmlspecialchars($post['contents'])) ?>
                      </p>
                  </div>


<h2>Commentaires:</h2>
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="user_id">Identifiant</label><br />
        <input type="text" id="user_id" name="user_id" />
    </div>
    <div>
        <label for="comment">Votre commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" value="Poster commentaire" name="submit_comment" />
    </div>
</form>
<?php if(isset($c_msg)) { echo $c_msg; } ?>
<?php
}
?>
