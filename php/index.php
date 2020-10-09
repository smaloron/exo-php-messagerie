<?php

$appTitle = "Ma super messagerie";
$appPitch = "Vous gardez toujours le contact avec vos amis";

// Connexion à la base de données
$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=formation;charset=utf8",
    "root",
    "",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

try {
    // Interrogation de la base de données
    $queryResult = $pdo->query("SELECT * FROM messages");
    // récupération des résultats de la requête
    $messageList = $queryResult->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e){
    echo $e->getMessage();
}

// Traitement du formulaire

// Définir une variable indiquant que les données ont été postées
$isPosted = count($_POST) > 0;

// tester la valeur de $isPosted
if ($isPosted) {
    // Récupérer et nettoyer les données
    $auteur = filter_input(INPUT_POST, "saisieAuteur", FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);

    // Définir la requête SQL
    $sql = "INSERT INTO messages (auteur, texte, date_message) VALUES (?,?,?)";

    // Définir une requête préparée
    $statement = $pdo->prepare($sql);

    // Exécuter la requête préparée
    $statement->execute([
        $auteur, $message, date("Y-m-d H:i:s")
    ]);

    // Rediriger vers la page
    header("location:php/index.php");
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: black;
        }

        .message-panel {
            background-color: #778fb5;
            padding: 16px;
            margin-top: 30px;
        }

        .message {
            background-color: white;
            padding: 10px;
            margin: 8px;
            ;
            width: 80%;
            border-radius: 15px;
        }
    </style>
</head>

<body class="container">
    <!-- ligne de bootstrap -->
    <div class="row justify-content-center">
        <div class="col-8 message-panel">
            <!-- Le titre de l'application -->
            <h1><?php echo $appTitle ?></h1>
            <h3><?php echo $appPitch ?></h3>



            <!-- Le formulaire de création de message -->
            <div class="mt-5 mb-5">
                <form method="post" action="/php/index.php">
                    <h2>Nouveau message</h2>
                    <div class="form-group">
                        <label>Auteur</label>
                        <input type="text" name="saisieAuteur" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" name="message" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Valider</button>
                </form>

                <hr>
            </div>

            <!-- La liste des messages -->
            <h2>Les messages</h2>
            <?php foreach ($messageList as $message) : ?>
                <div class="message">
                    <p>Le <?php echo $message["date_message"] ?> <?php echo $message["auteur"] ?> a dit :</p>
                    <div><?php echo $message["texte"] ?></div>
                </div>
            <?php endforeach ?>
        </div><!-- fermeture de message-panel -->
    </div><!-- fermeture de la ligne Bootstrap -->
</body>

</html>