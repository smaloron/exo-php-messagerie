<?php

// Récupération des données
$id = $_REQUEST["id"];

// Si l'id est supérieur à zéro
if($id > 0){
    try {
        // Connexion à la base de données
        $pdo = require("connexion.php");

        // Définition de la requête SQL
        $sql = "DELETE FROM livres_auteurs WHERE id_livre = ?";

        // Préparation de la requête
        $statement = $pdo->prepare($sql);

        // Exécution de la requête
        $statement->execute([$id]);

        // Définition de la requête SQL
        $sql = "DELETE FROM livres WHERE id = ?";

        // Préparation de la requête
        $statement = $pdo->prepare($sql);

        // Exécution de la requête
        $statement->execute([$id]);

        //Redirection vers la liste des livres
        header("location:/affichage-livres.php");

    } catch(PDOException $ex){
        echo $ex->getMessage();
    }
} else {
    echo "L'id doit être un nombre supérieur à zéro";
}