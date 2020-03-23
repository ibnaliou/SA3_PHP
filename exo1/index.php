<?php
    session_start();

    $T1 = [];
    $T = [];
    if(!empty($_SESSION['nbr'])){
        $value = $_SESSION['nbr'];
    }else{
        $value = '';
    }
    
    function pagination($tab) {
        $nbrParPage = 100; 
        //Nous allons maintenant compter le nombre de pages.
        $nombreDePagesInf=ceil(sizeof($tab['inferieur'])/$nbrParPage);
        $nombreDePagesSup=ceil(sizeof($tab['superieur'])/$nbrParPage);
        
        if(isset($_GET['pageI'])){ // Si la variable $_GET['pageI'] existe...
            $pageActuelleInf = intval($_GET['pageI']);
        
            if($pageActuelleInf > $nombreDePagesInf){ // Si la valeur de $pageActuelleInf (le numéro de la page) est plus grand que $nombreDePagesInf...
                $pageActuelleInf = $nombreDePagesInf;
            }
        }else{ // Sinon
            $pageActuelleInf = 1; // La page actuelle est la n°1    
        }

        if(isset($_GET['pageS'])){ // Si la variable $_GET['pageS'] existe...
            $pageActuelleSup = intval($_GET['pageS']);
        
            if($pageActuelleSup > $nombreDePagesSup){ // Si la valeur de $pageActuelleSup (le numéro de la page) est plus grande que $nombreDePagesSup...
                $pageActuelleSup = $nombreDePagesSup;
            }
        }else{ // Sinon
            $pageActuelleSup = 1; // La page actuelle est la n°1    
        }

        $premiereEntreeInf = ($pageActuelleInf - 1) * $nbrParPage;
        $premiereEntreeSup = ($pageActuelleSup - 1) * $nbrParPage;

        $resultInf = [];
        $resultSup = [];

        for($i = $premiereEntreeInf; $i < $pageActuelleInf*$nbrParPage; $i++){
            if($i < sizeof($tab['inferieur'])){
                $resultInf[] = $tab['inferieur'][$i];
            }
        }
        for($i = $premiereEntreeSup; $i < $pageActuelleSup*$nbrParPage; $i++){
            if($i < sizeof($tab['superieur'])){
                $resultSup[] = $tab['superieur'][$i];
            }
        }
        
        echo '<div class="pagination">
                <table>
                    <thead>
                        <tr>
                            <th colspan="10">Tableau inférieur</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $k1 = 0;
                    for($i=0; $i<10; $i++){
                        echo '<tr>';
                        for($j=0; $j<10; $j++){
                            if($k1 < sizeof($resultInf)){
                                echo '<td>'.$resultInf[$k1].'</td>';
                                $k1++;
                            }
                        }
                        echo '</tr>';
                    }
        echo        '</tbody>
                </table>';

        echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
        for($i=1; $i<=$nombreDePagesInf; $i++){ //On fait notre boucle
            //On va faire notre condition
            if($i==$pageActuelleInf){ //S'il s'agit de la page actuelle...
                echo ' [ '.$i.' ] '; 
            }    
            else{ // Sinon
                echo ' <a href="index.php?pageI='.$i.'&pageS='.$pageActuelleSup.'">'.$i.'</a> ';
            }
        }

        echo '</p>
                </div>';

                echo '<div class="pagination">
                <table>
                    <thead>
                        <tr>
                            <th colspan="10">Tableau superieur</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $k2 = 0;
                    for($i=0; $i<10; $i++){
                        echo '<tr>';
                        for($j=0; $j<10; $j++){
                            if($k2 < sizeof($resultSup)){
                                echo '<td>'.$resultSup[$k2].'</td>';
                                $k2++;
                            }
                        }
                        echo '</tr>';
                    }
        echo        '</tbody>
                </table>';

        echo '<p align="center">Page : '; //Pour l'affichage, on centre la liste des pages
        for($i=1; $i<=$nombreDePagesSup; $i++){ //On fait notre boucle
            //On va faire notre condition
            if($i==$pageActuelleSup){ //S'il s'agit de la page actuelle...
                echo ' [ '.$i.' ] '; 
            }    
            else{ // Sinon
                echo ' <a href="index.php?pageI='.$pageActuelleInf.'&pageS='.$i.'">'.$i.'</a> ';
            }
        }
        echo '</p>
            </div>';
        
    }

    function moyenne($tab){
        $moy = 0;
        $somme = 0;
        for($i=0; $i<sizeof($tab); $i++){
            $somme += $tab[$i];
        }
        $moy = $somme / sizeof($tab);
        return $moy;
    }

    if(isset($_POST['valid'])){
        if(empty($_POST['nbr'])){
            echo '<p>Veuillez saisir un nombre</p>';
        }else{
            $_SESSION['nbr'] = $_POST['nbr'];
            if(!is_numeric($value)){
                echo '<p>Veuillez saisir un entier</p>';
            }elseif($value <= 10000){
                echo '<p>Veuillez saisir un entier supérieur à 10000</p>';
            }else{
                for($i=2; $i<=$value; $i++){
                    $estPremier = 0;
                    for($j=2; $j<$i; $j++){
                        if($i%$j==0){
                            $estPremier++;
                        }
                    }
                    if($estPremier == 0){
                        $T1[] = $i;
                    }
                }
                $moy = moyenne($T1);
                foreach($T1 as $val){
                    if($val < $moy){
                        $inf[] = $val;
                    }else{
                        $sup[] = $val;
                    }
                }
                $T = [
                    "inferieur" => $inf,
                    "superieur" => $sup
                ];

                $_SESSION['tab'] = $T;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 1 Pagination</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="" method="post">
        <input type="text" name="nbr" placeholder="Entrer une valeur" value="<?= $value ?>" class="form-control">
        <button type="submit" name="valid" class="btn">Valider</button>
    </form>
    <?php
        echo '<div class="table-pagination">';
            if(!empty($_SESSION['tab'])){
                pagination($_SESSION['tab']); 
            }
        echo '</div>';
    ?>

    
</body>
</html>