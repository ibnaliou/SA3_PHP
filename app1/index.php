<?php
    $couleurs = [
        ['code' => '#ff0000', 'nom' => 'Rouge'],
        ['code' => '#0000ff', 'nom' => 'Bleu'],
        ['code' => '#ffe000', 'nom' => 'Jaune'],
    ];
    $affiche = false;

    function createMatrice($n, $c1, $c2, $c3, $pos){
        echo '<table>';
        for($i=0; $i<$n; $i++){
            echo '<tr>';
            for($j=0; $j<$n; $j++){
                if($pos === 'haut'){
                    if(($j < $n-1-$i && $i>$j) || ($j > $n-1-$i && $i<$j)){
                        echo '<td style="background: '. $c2 .'"></td>';
                    }else if($j < $n-1+$i && $i>$j && $j != $n-1-$i){
                        echo '<td style="background: '. $c3 .'"></td>';
                    }else{
                        echo '<td style="background: '. $c1 .'"></td>';
                    }
                }else{
                    if(($j < $n-1-$i && $i>$j) || ($j > $n-1-$i && $i<$j)){
                        echo '<td style="background: '. $c2 .'"></td>';
                    }else if($j < $n-1+$i && $i>$j && $j != $n-1-$i){
                        echo '<td style="background: '. $c1 .'"></td>';
                    }else{
                        echo '<td style="background: '. $c3 .'"></td>';
                    }
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    if(isset($_POST['valid'])){
        if(empty($_POST['size'])){
            echo '<h3>Veuillez saisir la taille</h3>';
        }else if($_POST['size']<=0 || $_POST['size']>=30){
            echo '<h3>La taille doit être entre 1-29</h3>';
        }else if(empty($_POST['c1'])){
            echo '<h3>Veuillez selectionner la couleur 1</h3>';
        }else if(empty($_POST['c2'])){
            echo '<h3>Veuillez selectionner la couleur 2/h3>';
        }else if(empty($_POST['c3'])){
            echo '<h3>Veuillez selectionner la couleur 3</h3>';
        }else if(empty($_POST['pos'])){
            echo '<h3>Veuillez selectionner la position</h3>';
        }else if($_POST['c1'] == $_POST['c2'] || $_POST['c2'] == $_POST['c3'] || $_POST['c1'] == $_POST['c3']){
            echo '<h3>Les couleurs doivent être différentes</h3>';
        }else{
            $affiche = true;
        }
    }elseif(isset($_POST['annule'])){
        header('location:/tp_php/app1');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application 1</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Sonatel Academy</h1>
        <form method="post">
            <div class="input-group">
                <h4>Taille de la matrice carrée</h4>
                <div class="input-container">
                    <div class="img">
                        <img class="img-1" src="img/icone1.png">
                    </div>
                    <input class="form-input-group" type="text" name="size" value="<?= @$_POST['size'] ?>">
                </div>
            </div>
            <div class="input-group">
                <h4>Select C1</h4>
                <div class="input-container">
                    <div class="img">
                        <img class="img-2" src="img/icone2_3.png">
                    </div>
                    <select class="form-input-group" name="c1" >
                        <option value="" disabled selected></option>
                        <?php foreach($couleurs as $c): ?>
                        <option value="<?= $c['code'] ?>" <?= ($c['code'] == @$_POST['c1']) ? 'selected' : '' ?> ><?= $c['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <h4>Select C2</h4>
                <div class="input-container">
                    <div class="img">
                        <img class="img-3" src="img/icone2_3.png">
                    </div>
                    <select class="form-input-group" name="c2" >
                        <option value="" disabled selected></option>
                        <?php foreach($couleurs as $c): ?>
                        <option value="<?= $c['code'] ?>" <?= ($c['code'] == @$_POST['c2']) ?'selected' : '' ?> ><?= $c['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <h4>Select C3</h4>
                <div class="input-container">
                    <div class="img">
                        <img class="img-5" src="img/icone2_3.png">
                    </div>
                    <select class="form-input-group" name="c3" >
                        <option value="" disabled selected></option>
                        <?php foreach($couleurs as $c): ?>
                        <option value="<?= $c['code'] ?>" <?= ($c['code'] == @$_POST['c3']) ?'selected' : '' ?> ><?= $c['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <h4>Position</h4>
                <div class="input-container">
                    <div class="img">
                        <img class="img-4" src="img/interrogation.png">
                    </div>
                    <select class="form-input-group" name="pos" >
                            <option value="" disabled selected></option>
                            <option value="haut" <?= (@$_POST['pos'] == 'haut') ?'selected' : '' ?>>Haut</option>
                            <option value="bas" <?= (@$_POST['pos'] == 'bas') ?'selected' : '' ?>>Bas</option>
                    </select>
                </div>
            </div>

            <div class="btn-group">
                <button class="btn btn-ann" name="annule">Annuler</button>
                <button class="btn btn-val" name="valid">Valider</button>
            </div>
        </form>
        <div>
            <?php 
                if(isset($_POST['valid'])){
                    if($affiche){
                        createMatrice((int)trim($_POST['size']), $_POST['c1'], $_POST['c2'], $_POST['c3'], $_POST['pos']);
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>