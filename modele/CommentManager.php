<?php
require_once('modele/Manager.php');

class CommentManager extends Manager
{
    
    // Recuperer les commentaires suivant l'ID de l'article
    public function getComments($idArticle)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, auteur, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM commentaires WHERE article_id = ? ORDER BY date_creation DESC');
        $comments->execute(array($idArticle));

        return $comments;
    }
    // Fonction pour Poster un commentaire
    public function postComment($idArticle, $auteur, $contenu)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaires(article_id, auteur, contenu, report, date_creation) VALUES(?, ?, ?, 0, NOW())');
        $affectedLines = $comments->execute(array($idArticle, $auteur, $contenu));

        return $affectedLines;
    }
    // fonction pour signaler un Commentaire
    public function reportCom($id)
    {
        $db = $this->dbConnect();
        $report = $db->prepare('UPDATE commentaires SET report = report+1 WHERE id = ?');
        $affected = $report->execute(array($id));
        
        return $affected;
    }
}