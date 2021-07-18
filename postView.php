<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<?php include("menu.php"); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des posts</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
    </h3>
    <p>
      <em>le <?= $post['creation_date_fr'] ?></em><br />
        <?= nl2br(htmlspecialchars($post['contents'])) ?>
        <a href="modifPost.php?edit=<?= $post['id'] ?>">Modifier</a> | <a href="deletePost.php?id=<?= $post['id'] ?>">Supprimer</a>
    </p>
</div>



<h2>Commentaires :</h2>
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
        <input type="submit" value="Poster commentaire" name="addComment" />
    </div>
</form>
<?php if(isset($e)) { echo $e; } ?>


<?php while ($c = $comments->fetch()) { ?>
    <b><?= $c['user_id'] ?>:</b>    le <?= $c['comment_date_fr'] ?>
    <br /><?= $c['comment'] ?><br /><br />



<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
