<?php 
// connexion à la base de donnée
class Manager
{
    protected function dbConnect()
    {
        try
        {
            $db = new \PDO('mysql:host=db5001067866.hosting-data.io;dbname=dbs918970;charset=utf8', 'dbu658281', 'Blogjean@23');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}