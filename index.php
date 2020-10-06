<?php
session_start();
require('controller/front_controller.php');
require('controller/back_controller.php');
// Page des articles
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    }  
    // Page d'un Article
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        }
        else {
            echo 'Erreur : aucun identifiant article envoyé';
        }
    }
    // Page des commentaires
    elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['auteur']) && !empty($_POST['contenu'])) {
                addComment($_GET['id'], $_POST['auteur'], $_POST['contenu']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    // voir Coms
    elseif ($_GET['action'] == 'gestCom.php') {
        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            tabCom();
        }
        else {
            echo "vous n'avez pas la permission !";
        }
            
    }
    // Signalement com
    elseif ($_GET['action'] == "addReport") {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            addReport($_GET['id']); 
        }
        else {
            echo 'signalement impossible';
        }
    }
    // page connexion
    elseif ($_GET['action'] == 'connexion') {
        require('vue/connexion.php');
    }

    
    // page Admin
    elseif ($_GET['action'] == 'admin') {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        connect($email, $pass);
    }
    // acces page Admin via session
    elseif ($_GET['action'] == 'board') {
        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            require('vue/admin.php');
        }
        else {
            echo "vous n'avez pas la permission !";
        }
    }


    // Page Admin Voir les Articles
    elseif ($_GET['action'] == 'voirArt.php') {
        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            tabPosts();
        }
        else {
            echo "vous n'avez pas la permission !";
        }

    }

    // Page Admin ajouter un article
    elseif ($_GET['action'] == 'addPost') {
        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            if (!empty($_POST['titre_article']) && !empty($_POST['texte_article'])) {
                addPost($_GET['id'], $_POST['titre_article'], $_POST['texte_article']);
            }
            require('vue/admin/addArt.php');            
        }
        else {
            echo "vous n'avez pas la permission !";
        }
        
    }   
        // Vue modifier un article
        elseif ($_GET['action'] == 'vueModif') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                frontModif();
            }
            else {
                echo 'Article introuvable';
            }
        }
        // modifier un article
        elseif ($_GET['action'] == 'modifArt') {
            if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['titre_article']) && !empty($_POST['texte_article'])) {
                    modifArt($_GET['id'], $_POST['titre_article'], $_POST['texte_article']);
                }
                else {
                    echo 'Erreur : aucun identifiant article envoyé';
                }
                require('vue/admin/modArt.php');
            }
        }
        else {
            echo "vous n'avez pas la permission !";
        }
            
        }
        // Supprimer Article
        elseif ($_GET['action'] == 'deleteArt') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletArt($_GET['id']);
            }
            else {
                echo 'Article introuvable';
            }
        }
    // Page Admin gestion des commentaires
    elseif ($_GET['action'] == 'gestCom.php') {
        if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
        {
            require('vue/admin/gestCom.php');
        }
        else {
            echo "vous n'avez pas la permission !";
        }
    }
    elseif ($_GET['action'] == 'deleteCom') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            deletCom($_GET['id']);
        }
        else {
            echo 'Commentaire introuvable';
        }
    }
    else if ($_GET['action'] == 'deco') {
        $_SESSION = array();
        session_destroy();
    }

}
else {
    listPosts();
}
