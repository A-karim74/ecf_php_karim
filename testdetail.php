<?php
// echo "vous etes sur la page détail de élève";

session_start();
var_dump($_GET['id']);
// est-ce que l'id existe
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php'); 

    // on nettoie l'id envoyé  pour ce prémunir des injection  
    $id = strip_tags($_GET['id']);
 $sql ="SELECT  * FROM `etudiants`,`examens` WHERE etudiants.id_etudiant = examens.id_etudiant ";
   // $sql =  'SELECT  * FROM `etudiants` , `examnens` WHERE `id` = :id;' ;

    // on preapre la requete 
    $query = $db->prepare(($sql));
    
    // on "accroche " les paramètre (id)
     $query->bindValue(':id' ,$id, PDO::PARAM_INT);
    /* PDO::PARAM_INT const/methode de PDO
    verifie que l'on recois bien un entier 
    sinon il renvoie une erreur  */
    
    
    // ont execute la requette
    $query->execute();
    print_r($query);
    
    // On récupère le produit 
    $resultEleve= $query->fetch();
   // var_dump($resultEleve);
    

    // ont vérifie si le produit exist 
    if(!$resultEleve){
    $_SESSION['erreur'] = "CET id n'existe pas";
    // header('Location: index.php');
    
    }
}else {
    $_SESSION['erreur'] = "URL Invalide"; 
    //header('Location: index.php');
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherhcer un élvèves</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <main>
        <h1>information de élève <?= $resultEleve['nom'] ." ". $resultEleve['prenom'] ?></h1>
        <div class="detail-eleve-container">
 <section class="detail-section">
        <p>ID élève : <?php  $resultEleve['id_etudiant'] ?> </p>
                <p>Nom: <?= $resultEleve['nom'] ?> </p>
                <p>Prénom: <?= $resultEleve['prenom'] ?> </p>
            
        </section>
        </div>
        <div class="global-note-container">
            <h2>détails des notes de élèves</h2>
            <section id ="details-notes-section">
                <table class ="details-notes-table">
                    <thead class ="details-notes-thead">
                        <th class ="details-notes">ID examen</th>
                        <th class ="details-notes" >matiére</th>
                        <th class ="details-notes">notes</th>
                    </thead>
                    <tbody class ="details-notes-tbody">
                    </tbody>
                    <?php
                    foreach($resultEleve as $eleve_detail){
                        ?>
                            <tr>
                              <td class ="details-notes"><?= $resultEleve["id_examen"]?></td>
                        <td class ="details-notes"><?= $resultEleve['matiere']?></td>
                        <td class ="details-notes" ><?= $resultEleve['note']?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                      
                    </tbody>
                </table>
            </section>
        </div>
       
        <div class="back-to-index-container">
            <a href="./index.php">Retourner a la page d'acceuil</a>
        </div>
    </main>
</body>
</html>