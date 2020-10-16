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
    $sql = "SELECT * FROM vue_livres";

    // Exécuter la requête SQL
    $query = $pdo->query($sql);

    // Récupération des données de la requête sous la forme d'un tableau
    $bookList = $query->fetchAll(PDO::FETCH_ASSOC);
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

    <h1 class="text-center mt-4 mb-2">Liste des livres</h1>

    <table class="table table-striped ml-2 mr-2">
        <tr>
            <th>Titre</th>
            <th>Année de publication</th>
            <th>Prix</th>
            <th>Genre</th>
            <th>Editeur</th>
            <th>Auteurs</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($bookList as $book) : ?>
            <tr>
                <td><?= $book["titre"] ?></td>
                <td><?= $book["annee_publication"] ?></td>
                <td><?= $book["prix"] / 100 ?> €</td>
                <td><?= $book["nom_genre"] ?></td>
                <td><?= $book["nom_editeur"] ?></td>
                <td><?= $book["auteurs"] ?></td>
                <td>
                    <a href="/suppression-livres.php?id=<?= $book["id"] ?>" class="btn btn-danger">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>