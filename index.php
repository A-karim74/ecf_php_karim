<?php
session_start();


require_once "connect.php";
//  preparation de la requete 
//$sql = "SELECT * FROM etudiants INNER JOIN examens ON etudiants.id_etudiant = examens.id_etudiant
$sql ="SELECT  * FROM `etudiants`,`examens` WHERE etudiants.id_etudiant = examens.id_etudiant ";
/*limit 6*/

$query = $db->prepare($sql);

//  on excute la requette 
$query->execute();

//  on stock le resulat dans un tableau associatif

$result = $query->fetchAll(pdo::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des éléves</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>Gestionnaire des élèves</h1>
    <main class="container">
        <div class="trouver-eleve">
            <p>
                <a href="./detail_eleve.php">Cliquer ici pour rechercher un eleve </a></p>
        </div>
        <div class="table-container">
            <section>
                <table id ="index-table">
                    <thead>
                        <th id="index-th">ID</th>
                       <th id="index-th" >Nom</th>
                       <th id="index-th" >Prénom</th>
                       <th id="index-th" >Notes</th> 
                    </thead>
                    <tbody>
                     <?php  
                     //  on boucle sur la variable $result 
                        foreach($result as $eleve){ 
                    ?>   
                     <tr>
                        <td id="index-td"><?= $eleve['id_etudiant'] ?></td>
                      <td id="index-td" ><?= $eleve['nom'] ?> </td>
                      <td id="index-td" ><?= $eleve['prenom'] ?> </td>
                      <td id="index-td" ><?= $eleve['note'] ?> </td>
                      <td id="index-td" ><a href="detail_eleve.php?id=<?= $eleve['id_etudiant']?>">
                        Voir détail de éléve</a></td>
                     </tr>
                     <?php
                        }
                    ?>
                         
                    </tbody>
                </table>
            </section>

        </div>
    </main>
    
</body>
</html>