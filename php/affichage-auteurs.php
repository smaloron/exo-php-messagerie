<?php

/***************************************** 
 * Affichage de la liste des livres
 * provenant de la vue "vue_livres" dans la base de données
 * sous la forme d'un tableau HTML
 *****************************************/

// Obtenir une connexion à la base de données
try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;dbname=formation;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Définir la requête sql
    $sql = "SELECT * FROM auteurs";

    // Exécuter la requête SQL
    $query = $pdo->query($sql);

    // Récupération des données de la requête sous la forme d'un tableau
    $authorList = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <h1 class="text-center mt-4 mb-2">Liste des auteurs</h1>

    <table class="table table-striped ml-2 mr-2">
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
        </tr>
        <?php foreach ($authorList as $author) : ?>
            <tr>
                <td><?= $author["prenom_auteur"] ?></td>
                <td><?= $author["nom_auteur"] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>