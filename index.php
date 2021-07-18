<?php
require("vendor/autoload.php");
/*require('app/controller/Frontend.php');*/
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
$controller = new \App\Controller\Frontend();

try {
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'listPosts') {
            $controller->index();
        }

        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller->add();
            } else {
                throw new Exception('Article non envoyé');
            }
        }

        elseif ($_GET['action'] == 'addComment') {
          if(isset($_GET['id']) AND !empty($_GET['id'])) {
            $getid = htmlspecialchars($_GET['id']);
            $controller->add($_GET['id'], $_POST['user_id'], $_POST['comment']);
          } else {
              throw new Exception('Article non envoyé');
          }

            if(isset($_post['addComment'])) {
                if(isset($_POST['user_id'],$_POST['comment']) AND !empty($_POST['user_id']) AND !empty($_POST['comment'])
                    ) { $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";

                  } else {
                      throw new Exception('Tous les champs doivent être renseignés !');
                  }
              }

                    $user_id = htmlspecialchars($_POST['user_id']);
                    $comment = htmlspecialchars($_POST['comment']);
                    if(strlen($user_id) < 30) {
                      $ins = $db->prepare('INSERT INTO comments(user_id, comment, post_id) VALUES (?,?,?)');
                      $ins->execute(array($user_id,$comment,$getid));
                      $c_msg = "<span style='color:green'>Votre commentaire a bien été posté</span>";

                  } else {
                      throw new Exception('Le pseudo doit faire moins de 30 caractères');
                  }
                }

                }
                else {

                  $controller->index();
                }
            }

      catch(Exception $e) {
          echo 'Erreur : ' . $e->getMessage();
      }
      ?>
