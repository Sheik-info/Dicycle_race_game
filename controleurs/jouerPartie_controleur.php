<?php
// Initialisation des variables
$cartes = []; // Tableau pour stocker les cartes choisies
$des = []; // Tableau pour stocker les dés lancés
$tour = 0; // Compteur de tours initialisé à 0
$pions = ["pion1.png", "pion2.png", "pion3.png", "pion4.png", "pion5.png", "pion6.png"]; // Pions pour attribution aléatoire

// Insérer les données des joueurs dans la base
if (isset($_POST['partie']) && isset($_POST['nbjoue'])) {
    $nbJoueurs = (int)$_POST['nbjoue']; // Nombre de joueurs converti en entier
    for ($i = 1; $i <= $nbJoueurs; $i++) {
        // Vérifier que les champs nécessaires sont remplis
        if (!empty($_POST["nom$i"]) && !empty($_POST["prenom$i"]) && !empty($_POST["pseudo$i"]) && 
            !empty($_POST["mail$i"]) && !empty($_POST["naiss$i"])) {
            // Nettoyage des données (si nécessaire, selon votre implémentation de insert_dans_joueur)
            $nom = htmlspecialchars($_POST["nom$i"]);
            $prenom = htmlspecialchars($_POST["prenom$i"]);
            $pseudo = htmlspecialchars($_POST["pseudo$i"]);
            $mail = filter_var($_POST["mail$i"], FILTER_SANITIZE_EMAIL);
            $naiss = htmlspecialchars($_POST["naiss$i"]);

            // Insertion dans la base
            try {
                insert_dans_joueur($nom, $prenom, $pseudo, $mail, $naiss);
            } catch (Exception $e) {
                // Gestion basique des erreurs (à adapter selon votre système)
                echo "Erreur lors de l'insertion du joueur $i : " . $e->getMessage();
            }
        }
    }
}

// Insérer le plateau et démarrer la partie
if (isset($_POST['commencez'])) {
    $nbJoueurs = nombre_de_joueurs(); // Récupérer le nombre de joueurs (fonction définie ailleurs)
    
    // Correction : utilisation des clés correctes de la vue (nbcv, nbcj, nbcb, nbcn)
    $nbVertes = (int)$_POST['nbcv'];
    $nbJaunes = (int)$_POST['nbcj'];
    $nbBleues = (int)$_POST['nbcb'];
    $nbNoires = (int)$_POST['nbcn'];

    // Validation : maximum 12 cartes
    $totalCartes = $nbVertes + $nbJaunes + $nbBleues + $nbNoires;
    if ($totalCartes <= 12 && $totalCartes >= 0) {
        try {
            insert_dans_plateau($nbVertes, $nbJaunes, $nbBleues, $nbNoires);
        } catch (Exception $e) {
            echo "Erreur lors de la création du plateau : " . $e->getMessage();
        }
    } else {
        echo "Erreur : Le nombre total de cartes doit être compris entre 0 et 12.";
    }
}

// Gestion des dés lancés (optionnel, si vous voulez stocker les résultats dans le contrôleur)
if (isset($_POST['lancer'])) {
    $des = [];
    $nbDesRouges = (int)$_POST['nbdr'];
    $nbDesBleus = (int)$_POST['nbdb'];
    $nbDesOranges = (int)$_POST['nbdo'];

    // Validation : maximum 6 dés
    $totalDes = $nbDesRouges + $nbDesBleus + $nbDesOranges;
    if ($totalDes == 6) {
        for ($i = 0; $i < $nbDesRouges; $i++) $des[] = lancer_de("rouge");
        for ($i = 0; $i < $nbDesBleus; $i++) $des[] = lancer_de("bleu");
        for ($i = 0; $i < $nbDesOranges; $i++) $des[] = lancer_de("jaune");
    } else {
        echo "Erreur : Vous devez sélectionner exactement 6 dés.";
    }
}
