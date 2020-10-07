<?php

$appTitle = "Ma super messagerie";
$appPitch = "Vous gardez toujours le contact avec vos amis";

$messageList = [
    [
        'auteur' => 'Ufuk',
        'texte' => 'Bonjour à tous',
        'date_message' => '10/10/2020'
    ],
    [
        'auteur' => 'Nazaré',
        'texte' => 'Bonjour merci Ufuk',
        'date_message' => '10/10/2020'
    ],
    [
        'auteur' => 'Sébastien',
        'texte' => 'On va faire un peu de PHP',
        'date_message' => '10/10/2020'
    ],
    [
        'auteur' => 'Maev',
        'texte' => 'A la soupe',
        'date_message' => '10/10/2020'
    ]
];

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
                <form>
                    <h2>Nouveau message</h2>
                    <div class="form-group">
                        <label>Auteur</label>
                        <input type="text" name="auteur" class="form-control">
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