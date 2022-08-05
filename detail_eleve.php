<?php
// echo "vous etes sur la page détail de élève";
session_start();

if(isset($_GET) && !empty($_GET['id'])){
    require_once "connect.php";
     // on nettoie l'id envoyé  pour ce prémunir des injection  
 $id = strip_tags($_GET['id']);
//  var_dump($id);
    $sql= "SELECT   prenom,nom, examens.matiere, examens.note, examens.id_examen FROM etudiants INNER JOIN examens ON etudiants.id_etudiant = examens.id_etudiant WHERE etudiants.id_etudiant = :id;";
    $query = $db->prepare(($sql));
     // on "accroche " les paramètre (id)
     $query->bindValue(':id' ,$id, PDO::PARAM_INT);
     //print_r($query);

     $query->execute();

     $resultEleve = $query->fetch();
    //   var_dump($resultEleve);
    
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

 //$sql ="SELECT  * FROM `etudiants`,`examens` where etudiants.id_etudiant = examens.id_etudiant ";
 //$sql ="SELECT * FROM etudiants INNER JOIN examens ON etudiants.id_etudiant = examens.id_etudiant   ";


    



   

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
        <h1>information de élève <?= $resultEleve['nom']." ". $resultEleve['prenom'] ?></h1>
        <div class="detail-eleve-container">
 <section class="detail-section">
        <p>ID élève : <?php  $resultEleve['id'] ?> </p>
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
                   
                            <tr>
                              <td class ="details-notes">
                                  <p>
                                  <?= $resultEleve["id"]?>
                                      </p>
                                    </td>
                                    
                        <td class ="details-notes"><?= $resultEleve['matiere']?></td>
                        <td class ="details-notes" ><?= $resultEleve['note']?></td>
                        </tr>
                        
                    
                    
                    
                      
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