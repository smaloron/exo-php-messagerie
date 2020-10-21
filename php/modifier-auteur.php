<?php

/***************************************** 
 * Modification des informations d'un auteur
 * Deux étapes : 
 * 1. Afficher les données de l'auteur dans un formulaire
 * 2. Traiter le formulaire pour effectuer la modification
 *****************************************/


// Récupération des infos de l'auteur en fonction de son id passé en paramètre
// de sorte à ce que l'on puisse pré-remplir le formulaire
// Obtenir une connexion à la base de données
try {
$pdo = require("connexion.php");

    // Récupération de l'id passé en paramètre
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    // Définir la requête sql
    $sql = "SELECT * FROM auteurs WHERE id= ?";

    // Préparation de la requête
    $statement = $pdo->prepare($sql);

    // Exécution de la requête
    $statement->execute([$id]);

    // Récupération des données de la requête sous la forme d'un tableau
    $author = $statement->fetch(PDO::FETCH_ASSOC);

    var_dump($author);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

// Aprés la saisie de l'utilisateur, traitement du formulaire 
// afin de réaliser la modification

// Les données sont elles postées
$isPosted = count($_POST) > 0;

try {
    if($isPosted){
        // Récupération de la saisie
        $nom = filter_input(INPUT_POST, "nom_auteur", FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, "prenom_auteur", FILTER_SANITIZE_STRING);

        // Todo validation des données

        // Définition de la requête SQL
        $sql = "UPDATE auteurs SET nom_auteur= ?, prenom_auteur= ? WHERE id=?";

        // Préparation de la requête
        $statement = $pdo->prepare($sql);

        // Exécution de la requête
        $statement->execute([$nom, $prenom, $id]);

        // redirection vers la liste des auteurs
        header("location:affichage-auteurs.php");
    } // fin de la condition if($isPosted)
} catch (PDOException $ex) {
    echo $ex->getMessage();
} // Fin du bloc try / catch

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mt-4 mb-2">Formulaire auteur</h1>

            <form method="post">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="prenom_auteur" class="form-control" value="<?= $author["prenom_auteur"] ?>">
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom_auteur" class="form-control" value="<?= $author["nom_auteur"] ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </form>
        </div>
    </div>

</body>

</html>