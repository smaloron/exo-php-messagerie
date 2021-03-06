<?php

try {

    // Connexion à la base de données
$pdo = require("connexion.php");

    /*********************
     *  Récupération des données du livre
     *********************/
    // Récupération de l'id passé en paramètre
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM livres WHERE id = ?";

    $statement = $pdo->prepare($sql);

    $statement->execute([$id]);

    $bookData = $statement->fetch();

    /*********************
     *  Récupération des identifiants des auteurs du livre
     *********************/

    $sql = "SELECT id_auteur FROM livres_auteurs WHERE id_livre= ?";

    $statement = $pdo->prepare($sql);

    $statement->execute([$id]);

    $bookAuthors = $statement->fetchAll();

    /*********************
     *  Récupération des genres
     *********************/
    // Requête sql
    $sql = "SELECT * FROM genres";
    // Exécution de la requête
    $query = $pdo->query($sql);
    // Récupération des données de la requête
    $genreList = $query->fetchAll(PDO::FETCH_ASSOC);

    /*********************
     *  Récupération des éditeurs
     *********************/
    // Requête sql
    $sql = "SELECT * FROM editeurs";
    // Exécution de la requête
    $query = $pdo->query($sql);
    // Récupération des données de la requête
    $publisherList = $query->fetchAll(PDO::FETCH_ASSOC);


    /*********************
     *  Récupération des auteurs
     *********************/
    // Requête sql
    $sql = "SELECT id, CONCAT_WS(' ', prenom_auteur, nom_auteur) as auteur FROM auteurs";
    // Exécution de la requête
    $query = $pdo->query($sql);
    // Récupération des données de la requête
    $authorList = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}




/**************************** 
 *  Traitement du formulaire
 ****************************/

$isPosted = count($_POST);

if ($isPosted) {
    // Récupération des données
    $title = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
    $publishedAt = filter_input(INPUT_POST, "annee_publication", FILTER_SANITIZE_NUMBER_INT);
    $price = filter_input(INPUT_POST, "prix", FILTER_SANITIZE_NUMBER_INT);
    $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_NUMBER_INT);
    $publisher = filter_input(INPUT_POST, "editeur", FILTER_SANITIZE_NUMBER_INT);
    // Récupération de la liste des auteurs sélectionnés
    $authors = filter_input(INPUT_POST, "auteurs", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);


    // L'utilisateur a entré des euros on enregistre des centimes dans la BD
    $price *= 100;

    // sql
    $sql = "UPDATE livres SET titre = ?, annee_publication= ?, prix = ?, id_genre = ?, id_editeur = ? WHERE id = ?";

    // statement
    $statement = $pdo->prepare($sql);

    // Exécution
    $statement->execute([$title, $publishedAt, $price, $genre, $publisher, $id]);

    // Remise à zéro des auteurs du livre
    $sql = "DELETE FROM livres_auteurs WHERE id_livre = ?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);

    // Affectation des auteurs aux livres
    $sql = "INSERT INTO livres_auteurs (id_livre, id_auteur) VALUES (?, ?)";
    $statement = $pdo->prepare($sql);

    $numberOfAuthors = count($authors);

    for ($i = 0; $i < $numberOfAuthors; $i++) {
        $statement->execute([$id, $authors[$i]]);
    }

    // Redirection
    header("location:/affichage-livres.php");
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            const $authorList = $("#authorList");
            const $authorTemplate = $("#authorTemplate");
            const $authorAddButton = $("#authorAddButton");

            $authorAddButton.click(function() {
                $newAuthor = $authorTemplate.clone().removeAttr("id");
                $authorList.append($newAuthor);

                console.log($authorList.children().length);
            });

            $("body").delegate('.author-delete', 'click', function() {

                if ($authorList.children().length <= 2) {
                    alert("Vous ne pouvez pas supprimer le dernier auteur");
                    return;
                }

                if (confirm("êtes-vous sur(e) de vouloir supprimer cette liste ?")) {
                    $(this).parent().parent().remove();
                }
            });
        });
    </script>
</head>

<body class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mt-4 mb-2">Formulaire auteur</h1>

            <form method="post">
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="titre" class="form-control" value="<?= $bookData["titre"] ?>">
                </div>
                <div class="form-group">
                    <label>Année de publication</label>
                    <input type="number" name="annee_publication" class="form-control" min="1980" max="2020" value="<?= $bookData["annee_publication"] ?>">
                </div>

                <div class="form-group">
                    <label>Prix en euros</label>
                    <input type="number" name="prix" class="form-control" min="5" max="999" value="<?= $bookData["prix"]/ 100 ?>">
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre" class="form-control">
                        <?php foreach ($genreList as $genre) : ?>
                            <option value="<?= $genre["id"] ?>"
                            <?= $genre["id"]==$bookData["id_genre"]?"selected": "" ?> >
                                <?= $genre["nom_genre"] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Editeur</label>
                    <select name="editeur" class="form-control">
                        <?php foreach ($publisherList as $publisher) : ?>
                            <option value="<?= $publisher["id"] ?>"
                            <?= $publisher["id"] == $bookData["id_editeur"]? "selected": ""  ?> >
                                <?= $publisher["nom_editeur"] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <fieldset id="authorList">
                    <div class="row">
                        <legend class="col">Les auteurs</legend>
                        <div class="col-3">
                            <button class="btn btn-primary btn-block" id="authorAddButton" type="button">
                                Ajouter un auteur
                            </button>
                        </div>
                    </div>

                    <?php foreach($bookAuthors as $authorOfTheBook): ?>
                        <div class="row" id="authorTemplate">
                            <div class="form-group col-9">
                                <select name="auteurs[]" class="form-control">
                                    <?php foreach ($authorList as $author) : ?>
                                        <option value="<?= $author["id"] ?>"
                                         <?= $author["id"] == $authorOfTheBook["id_auteur"] ? "selected": "" ?>>
                                            <?= $author["auteur"] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-danger btn-block author-delete" type="button">
                                    Supprimer
                                </button>
                            </div>
                        </div>
                    <?php endforeach ?>
                </fieldset>

                <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </form>
        </div>
    </div>

</body>

</html>