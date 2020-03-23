<?php
    $tab = [1,2,3,4,5,6,7,8,9,10];

    $totalValeur = sizeof($tab);
    $nbrParPage = 2;
    $nbrDePage = ceil($totalValeur/$nbrParPage);

    echo '<p>Le nombre de page est : '.$nbrDePage.'</p>';
    for($i=1; $i<=$nbrDePage; $i++){
        echo ' <a href="">'. $i .'</a> ';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>