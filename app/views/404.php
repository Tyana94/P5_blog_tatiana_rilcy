<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"   />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
    
        <div class="pagerr">
            <h1>Erreur 404</h1>
            <h3>La page demandée n'existe pas.</h3>
            <h4>Retour à la liste des articles</h4>
        </div>
        <div class="retour">
             <p> <?php foreach($posts as $post) {
            echo '<a href="articles/' . $post['id'] . '/">' . $post['title'] . '</a><br>';
            }
            ?>
            </p>
        </div>

<?php include('../app/includes/footer.php'); ?>

    </body>
</html>
