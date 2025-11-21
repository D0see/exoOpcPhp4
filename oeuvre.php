<?php
    require 'header.php';
    require 'bdd.php';
    $env = include('env.php');

    if(empty($_GET['id'])) {
        header('Location: index.php');
    }

    $pgClient = connexion($env);

    $oeuvreQuery = 'Select * from oeuvre where oeuvre.id = ' . $_GET['id'];
    $oeuvreStatement = $pgClient->prepare($oeuvreQuery);
    $oeuvreStatement->execute();
    $oeuvre = $oeuvreStatement->fetchAll();

    if (empty($oeuvre)) {
        header('Location: index.php');
    }

    $oeuvre = $oeuvre[0];
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
