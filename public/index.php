<?php
// On démarre la session php
//session_start();
require("../vendor/autoload.php");
$router = new AltoRouter();
$router->setBasePath('blog/');


//== page d'accueil ============================================  OK
$router->map('GET','/', function() {                          
    $controller = new \App\Controller\FrontendController();
    $controller->home();   
}, 'home');


//== connexion ============================================  KO
$router->map('GET','/login', function() {                          
    $controller = new \App\Controller\FrontendController();
    $controller->login();   
}, 'login');


//== connexion ============================================  KO
$router->map('POST','/connexion', function() {                          
    $controller = new \App\Controller\FrontendController();
    $controller-connect();   
}, 'connexion');


//== inscription ============================================  KO
$router->map('GET','/inscription', function() {                      
    $controller = new \App\Controller\FrontendController();
    $controller->inscription();   
}, 'inscription');


//== inscription ============================================  KO
$router->map('POST','/inscrit', function() {                      
    $controller = new \App\Controller\FrontendController();
    $controller->inscrit();   
}, 'inscrit');


//== afficher un article ============================================  OK
$router->map('GET','/article/[i:id]/', function($id) {        
    $controller = new \App\Controller\FrontendController();
    $controller->show($id);
}, 'article');


//== afficher commentaires ============================================  KO
$router->map('GET','/commentaires/[i:id]/', function($id) {        
    $controller = new \App\Controller\FrontendController();
    $controller->afficher($id);
}, 'commentaire');


//== deconnexion ============================================  KO
$router->map('GET','/logout', function() {                         
    $controller = new \App\Controller\FrontendController();
    $controller->logout();   
}, 'logout');


//== contact ====================================================  KO
$router->map('GET','/contact', function() {                          
    $controller = new \App\Controller\FrontendController();
    $controller->contact();   
}, 'contact');


//== contact ====================================================  KO
$router->map('POST','/contacter', function() {                          
    $controller = new \App\Controller\FrontendController();
    $controller->contacter();   
}, 'contacter');



//== ajouter un commentaire =======================================  KO  
$router->map('GET','/addcom/[i:id]/', function($id) {        
    $controller = new \App\Controller\AccountController();
    $controller->addcom($id);
}, 'ajout');


//== profil ====================================================  OK
$router->map('GET','/user', function() {                          
    $controller = new \App\Controller\AccountController();
    $controller->profil();   
}, 'profil');



//== admin ========================================================  OK
$router->map('GET','/admin', function() {                          
    $controller = new \App\Controller\BackendController();
    $controller->administre();   
}, 'admin');


//== ajouter un article ============================================  KO
$router->map('GET','/addpost/[i:id]/edit', function($id) {            
    $controller = new \App\Controller\BackendController();
    $controller->affich($id);   
}, 'affich-post');


//== ajouter un article ============================================  KO
$router->map('POST','/addpost/[i:id]/insert/', function($id) {            
    $controller = new \App\Controller\BackendController();
    $controller->insert($id);   
}, 'ajouter-post');





















//== modifier un article ============================================  OK
$router->map('GET','/posts/[i:id]/edit/', function($id) {        
    $controller = new \App\Controller\BackendController();
    $controller->modif($id);
}, 'modifier-post');


//== modifier un article ============================================  OK
$router->map('POST','/posts/[i:id]/update/', function($id) {        
    $controller = new \App\Controller\BackendController();
    $controller->update($id);
}, 'update-post');


//== supprimer un article ============================================  KO
//$router->map('GET','/posts/[i:id]/edit', function ($id) {
//    $controller = new \App\Controller\BackendController();
//    $controller->supp($id);
//} , 'supprimer-post'); 


//== supprimer un article ============================================  KO
$router->map('POST','/posts/[i:id]/delete/', function ($id) {
    $controller = new \App\Controller\BackendController();
    $controller->delete($id);
} , 'supprimer-post'); 






//== supprimer un commentaire ========================================  KO 
$router->map('GET','/deletecom/[i:id]/', function($id) {        
    $controller = new \App\Controller\BackendController();
    $controller->supcom($id);
}, 'supprimecom');


//== supprimer un commentaire ========================================  KO 
$router->map('POST','/posts/[i:id]/delete/', function($id) {        
    $controller = new \App\Controller\BackendController();
    $controller->delete($id);
}, 'deletecom');


//== approuver un commentaire ========================================  KO
$router->map('GET','/approuve', function($id) {        
    $controller = new \App\Controller\BackendController();
    $controller->approuvcom($id);
}, 'approuve');





# call closure or throw 404 status CALL CLOSURE OR THROW 404 STATUS         Page 404  ------------->  OK
$match = $router->match();

if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    # NO ROUTE WAS WATCHED
    $controller = new \App\Controller\FrontendController();
    $controller->lost();
}