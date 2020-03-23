<?php
    $annee = [
        [ "num" => 1, "nomFr" => "Janvier", "nomEn" => "January"],
        [ "num" => 2, "nomFr" => "Fevrier", "nomEn" => "February"],
        [ "num" => 3, "nomFr" => "Mars", "nomEn" => "March"],
        [ "num" => 4, "nomFr" => "Avril", "nomEn" => "April"],
        [ "num" => 5, "nomFr" => "Mai", "nomEn" => "May"],
        [ "num" => 6, "nomFr" => "Juin", "nomEn" => "June"],
        [ "num" => 7, "nomFr" => "Juillet", "nomEn" => "July"],
        [ "num" => 8, "nomFr" => "Aout", "nomEn" => "August"],
        [ "num" => 9, "nomFr" => "Septembre", "nomEn" => "September"],
        [ "num" => 10, "nomFr" => "Octobre", "nomEn" => "October"],
        [ "num" => 11, "nomFr" => "Novembre", "nomEn" => "November"],
        [ "num" => 12, "nomFr" => "December", "nomEn" => "December"]
    ];
    $j = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 2</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <h1>Afficher les mois</h1>
    <div>
        <form method="post">
            <div class="form-group">
                <label for="langue">Choisir une Langue</label>
                <select name="langue" class="form-control">
                    <option value="" disabled selected>Choose a langage</option>
                    <option value="fr" <?= (@$_POST['langue'] == 'fr') ? "selected" : ""; ?> >Français</option>
                    <option value="en" <?= (@$_POST['langue'] == 'en') ? "selected" : ""; ?> >Anglais</option>
                </select>
            </div>
            <button class="btn" type="submit" name="valid">Ok</button>
        </form>
    </div>

    <?php if(isset($_POST['valid']) && !empty($_POST['langue'])){ ?>

    <table>
        <?php for($i=0; $i<4; $i++){ $j = $i*3; ?>
            <tr>
                <td><?= $annee[$j]['num'] ?></td>
                <td><?= ($_POST['langue'] == 'fr') ? $annee[$j]['nomFr'] : $annee[$j]['nomEn'] ?></td>
                <td><?= $annee[$j+1]['num'] ?></td>
                <td><?= ($_POST['langue'] == 'fr') ? $annee[$j+1]['nomFr'] : $annee[$j+1]['nomEn'] ?></td>
                <td><?= $annee[$j+2]['num'] ?></td>
                <td><?= ($_POST['langue'] == 'fr') ? $annee[$j+2]['nomFr'] : $annee[$j+2]['nomEn'] ?></td>
            </tr>
        <?php } ?>
    </table>

    <?php } ?>
</body>
</html>
