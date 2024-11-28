<?php

if (isset($_POST['creer'])) {
    // Récupération des données du formulaire
    $nbCartes = $_POST['nbCartes'];             
    $nbVertes = $_POST['nbVertes'];             
    $nbOranges = $_POST['nbOranges'];           
    $nbNoires = $_POST['nbNoires'];             
    $strategie = $_POST['typeStrat'];
    $strategie = strval($strategie);         

    // Récupération de l'ID de la partie
    $idp = "SELECT MAX(idp) AS max_id FROM Partie";
    $idp = executer_une_requete($idp);
    $idp = $idp['instances'][0]['max_id'];
    $idp = intval($max_idp) + 1;

    // Définition de la date actuelle
    $date = "SELECT CURRENT_DATE()";
    $date = executer_une_requete($date);
    $date = strval($date);

    // Définition de l'heure actuelle
    $heure = "SELECT CURRENT_TIME()";
    $heure = executer_une_requete($heure);
    $heure = strval($heure);

    // Sélection aléatoire des cartes vertes
    $hasardVerte = "SELECT id_c FROM Carte WHERE niveau LIKE verte ORDER BY RAND() LIMIT $nbVertes";
    $hasardVerte = executer_une_requete($hasardVerte);

    // Sélection aléatoire des cartes oranges
    $hasardOrange = "SELECT id_c FROM Carte WHERE niveau LIKE orange ORDER BY RAND() LIMIT $nbOranges";
    $hasardOrange = executer_une_requete($hasardOrange);

    // Sélection aléatoire des cartes noires
    $hasardNoire = "SELECT id_c FROM Carte WHERE niveau LIKE noire ORDER BY RAND() LIMIT $nbNoires";
    $hasardNoire = executer_une_requete($hasardNoire);

    // Création de la partie
    $creerUnePartie = "INSERT INTO Partie (idp, date_Partie, Heure_Partie, etat, strategie, idj, id_p) VALUES ($idp, $date, $heure, 'A venir', '$strategie', 0, $idp)";
    executer_une_requete($creerUnePartie);

    // Récupération de l'ID du plateau
    $idPlateau = "SELECT MAX(id_p) AS max_idp FROM Plateau";
    $idPlateau_result = executer_une_requete($idPlateau);
    $idPlateau = $idPlateau['instances'][0]['max_idp'] + 1;

    // Création du plateau
    $creerUnPlateau = "INSERT INTO Plateau (taille, id_p) VALUES ($nbCartes, $idp)";
    executer_une_requete($creerUnPlateau);

    // Associer les cartes vertes au plateau
    foreach ($hasardVerte ['instances'] as $carteVerte) {
        $idCarteVerte = $carteVerte['id_c'];
        $associerCarteVerte = "INSERT INTO Est_Compose (id_c, id_p) VALUES ($idCarteVerte, $idPlateau)";
        executer_une_requete($associerCarteVerte);
    }

    // Associer les cartes oranges au plateau
    foreach ($hasardOrange ['instances'] as $carteOrange) {
        $idCarteOrange = $carteOrange['id_c'];
        $associerCarteOrange = "INSERT INTO Est_Compose (id_c, id_p) VALUES ($idCarteOrange, $idPlateau)";
        executer_une_requete($associerCarteOrange);
    }

    // Associer les cartes noires au plateau
    foreach ($hasardNoire ['instances'] as $carteNoire) {
        $idCarteNoire = $carteNoire['id_c'];
        $associerCarteNoire = "INSERT INTO Est_Compose (id_c, id_p) VALUES ($idCarteNoire, $idPlateau)";
        echo "je suis la";
        executer_une_requete($associerCarteNoire);
    }
}

?>