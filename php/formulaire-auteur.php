<?php

// Déterminer si le formulaire a été posté

// Si oui alors récupérer la saisie de l'utilisateur

// Récupérer la connexion à la base de données

// Définir la requête sql pour l'insertion d'un auteur

// Préparer la requête

// Exécuter la requête en passant les données de la saisie

// Rediriger vers l'affichage des auteurs 



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
                    <input type="text" name="prenom_auteur" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom_auteur" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Valider</button>
            </form>
        </div>
    </div>

</body>

</html>