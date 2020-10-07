<?php
function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT id, title, text, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles');

    return $req;
}

function getPost($idArticle)
{
    $idArticle = intval($idArticle);
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, text, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM articles WHERE id=?');
    $req->execute(array($idArticle));
    $post = $req->fetch();

    return $post;
}
function getComments($idArticle)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, auteur, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM commentaires WHERE article_id = ? ORDER BY date_creation DESC');
    $comments->execute(array($idArticle));

    return $comments;
}

function postComment($idArticle, $auteur, $contenu)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO commentaires(article_id, auteur, contenu, report, date_creation) VALUES(?, ?, ?, 0, NOW())');
    $affectedLines = $comments->execute(array($idArticle, $auteur, $contenu));

    return $affectedLines;
}

// fonctions admin
function analyseUser()
{
    $db = dbConnect();
    $reqUser = $db->query('SELECT id, email, pass FROM membres');
    
    return $reqUser;
}
// fonction log admin
function getUser($email, $pass)
{
    $db = dbConnect();
    $reqUser = $db->prepare('SELECT * FROM membres WHERE email = ?');
    $reqUser->execute(array($email));
    $user = $reqUser->fetch(); 
 
    // test du mot de pass et compare au stockage dans la session
    $testPass = password_verify($pass, $user['pass']);
    if($testPass == true){
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['id'] = $user['id'];
        return true;
    }
    else {
        return false;
    }
}
// fonction deconnexion
function destroy()
{
    session_destroy();
}
// fonction pour ajouter un article
function addArticle($idArticle, $titre, $texte)
{
    $db = dbConnect();
    $req = $db->prepare('INSERT INTO articles (id, title, text) VALUES(?, ?, ?)');
    $add = $req->execute(array($idArticle, $titre, $texte));

    return $add;
}
// fonction pour modifier article
function modArt($idArticle, $titre, $texte)
{
    $db = dbConnect();
    
    $reqmod = $db->prepare('UPDATE articles SET title = :nvtitle, text = :nvtext WHERE id = :nvid');
    $modifLines = $reqmod->execute(array(
       'nvid' => $idArticle,
       'nvtitle' => $titre,
       'nvtext' => $texte
    ));

    return $modifLines;
}
// fonction delete article
function deletArticle($id)
{
    $db = dbConnect();
    $reqDelet = $db->prepare('DELETE FROM articles WHERE id = ?');
    $delete = $reqDelet->execute(array($id));
    return $delete;
}
// fonction delete commentaire
function deletComment($id)
{
    $db = dbConnect();
    $reqDelet = $db->prepare('DELETE FROM commentaires WHERE id = ?');
    $delete = $reqDelet->execute(array($id));
    return $delete;
}
// voir les commentaires Page gestCom.php
function getCom()
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, auteur, contenu, report, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM commentaires WHERE report > 0 ORDER BY report DESC');
    $comments->execute(array());

    return $comments;
}
// fonction report Commentaire
function reportCom($id)
{
    $db = dbConnect();
    $report = $db->prepare('UPDATE commentaires SET report = report+1 WHERE id = ?');
    $affected = $report->execute(array($id));
    
    return $affected;

}


