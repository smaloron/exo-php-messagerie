<?php

try {

    // Connexion à la base de données
    $pdo = new PDO(
        "mysql:host=127.0.0.1;dbname=formation;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

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
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

/**************************** 
 *  Traitement du formulaire
 ****************************/

 $isPosted = count($_POST);

 if($isPosted){
     // Récupération des données
     $title = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
     $publishedAt = filter_input(INPUT_POST, "annee_publication", FILTER_SANITIZE_NUMBER_INT);
     $price = filter_input(INPUT_POST, "prix", FILTER_SANITIZE_NUMBER_INT);
     $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_NUMBER_INT);
     $publisher = filter_input(INPUT_POST, "editeur", FILTER_SANITIZE_NUMBER_INT);

     // L'utilisateur a entré des euros on enregistre des centimes dans la BD
     $price *= 100;

     // sql
     $sql = "INSERT INTO livres (titre, annee_publication, prix, id_genre, id_editeur) VALUES (?,?,?,?,?)";

     // statement
     $statement = $pdo->prepare($sql);

     // Exécution
     $statement->execute([$title, $publishedAt, $price, $genre, $publisher]);

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
</head>

<body class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mt-4 mb-2">Formulaire auteur</h1>

            <form method="post">
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="titre" class="form-control">
                </div>
                <div class="form-group">
                    <label>Année de publication</label>
                    <input type="number" name="annee_publication" class="form-control" min="1980" max="2020">
                </div>

                <div class="form-group">
                    <label>Prix en euros</label>
                    <input type="number" name="prix" class="form-control" min="5" max="999">
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre" class="form-control">
                        <?php foreach ($genreList as $genre) : ?>
                            <option value="<?= $genre["id"] ?>">
                                <?= $genre["nom_genre"] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Editeur</label>
                    <select name="editeur" class="form-control">
                        <?php foreach ($publisherList as $publisher) : ?>
                            <option value="<?= $publisher["id"] ?>">
                                <?= $publisher["nom_editeur"] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </form>
        </div>
    </div>

</body>

</html>