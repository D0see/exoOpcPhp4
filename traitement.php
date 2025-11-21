<?php
    require('bdd.php');
    $env = include('env.php');

if ($_POST['titre'] && 
    $_POST['artiste'] &&
    $_POST['image'] && filter_var($_POST['image'], FILTER_VALIDATE_URL) && 
    $_POST['description'] && strlen($_POST['description'] >= 3)
) {
    $pgClient = connexion($env);
    $insertQuery = "INSERT INTO oeuvre (titre, artiste, image, description)
                    VALUES (:titre, :artiste, :image, :description)";
    
    $insertStatement = $pgClient->prepare($insertQuery);

    $insertStatement->execute([
        ':titre'       => htmlspecialchars($_POST['titre']),
        ':artiste'     => htmlspecialchars($_POST['artiste']),
        ':image'       => htmlspecialchars($_POST['image']),
        ':description' => htmlspecialchars($_POST['description'])
    ]);
    header('Location: index.php');
} else {
    header('location: ajouter.php');
}
