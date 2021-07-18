<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<!-- <Menu -->
<?php include("menu.php"); ?>

<!--banniere ----------------------------------------->
<?php include("banniere.php"); ?>

                  <!--A PROPOS DE MOI ----------------------------------------->
              <div class="container" id="moi">
                    <div class="row">
                      <div class="col-12 col-lg-12">
                        <div class="texte1">
                          <h2>A propos de moi</h2>
                          <p>Je m'appelle Tatiana RILCY et mes expériences professionnelles au sein de différents services m'ont permis d'acquérir des connaissances variées et surtout une bonne capacité d'adaptation à différents environnements de travail. </p>
                          <p> Ayant été Chef de projet digital, Consultante MOA, Business Analyst, je souhaite actuellement enrichir mes compétences techniques, en suivant une formation de "Développeur application PHP" chez Openclassroom. </p>
                          <p>Cette formation m'a déjà beaucoup apportée avec la réalisation de différents projets, comme :
                            <ul>
                              <li>la création du prototype d'un site en HTML et CSS</li>
                              <li>la création de schéma UML et Base de données MySQL avec un jeu de données de démo</li>
                              <li>la création d'un blog en PHP</li>
                            </ul>
                          </p>
                         </div>
                      </div>
                     </div>
              </div>








<?php
foreach ($posts as $post) {

?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Commentaires</a></em>        
        </p>
    </div>
<?php
}
?>

<a href="<?=("addPost.php") ;?>">Ajouter un post</a><br />
<p>Ajouter un post : 
<a href="<?=("inscription.php") ;?>">Inscrivez-vous</a> | <a href="<?=("connexion.php") ;?>">Connectez-vous</a></p>
<?php include("footer.php"); ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>