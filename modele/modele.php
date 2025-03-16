<?php

////////////////////////////////////////////////////////////////////////
///////    Gestion de la connexion   ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

function open_connection_DB() {
    global $connexion;
    $connexion = mysqli_connect(SERVEUR, UTILISATEUR, MOTDEPASSE, BDD);
    if (mysqli_connect_errno()) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }
    mysqli_set_charset($connexion, "utf8"); // Assurer l'encodage UTF-8
}

function close_connection_DB() {
    global $connexion;
    if ($connexion) {
        mysqli_close($connexion);
    }
}

////////////////////////////////////////////////////////////////////////
///////   Accès au dictionnaire       ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

function get_tables() {
    global $connexion;
    $requete = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . BDD . "'";
    $res = mysqli_query($connexion, $requete);
    if (!$res) {
        return [];
    }
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function get_statistiques() {
    // TODO: Implémenter si nécessaire
    return null;
}

////////////////////////////////////////////////////////////////////////
///////    Informations (structure et contenu) d'une table    //////////
////////////////////////////////////////////////////////////////////////

function get_infos($typeVue, $nomTable) {
    global $connexion;
    switch ($typeVue) {
        case 'schema':
            return get_infos_schema($nomTable);
        case 'data':
            return get_infos_instances($nomTable);
        default:
            return null;
    }
}

function get_infos_schema($nomTable) {
    global $connexion;
    $requete = "SELECT * FROM $nomTable LIMIT 0"; // LIMIT 0 pour éviter de charger les données
    $res = mysqli_query($connexion, $requete);
    if (!$res) {
        return null;
    }

    $schema = [
        ['nom' => 'nom_attribut'],
        ['nom' => 'type_attribut'],
        ['nom' => 'clé']
    ];
    $metadonnees = mysqli_fetch_fields($res);
    $infos_att = [];
    foreach ($metadonnees as $att) {
        $is_in_pk = ($att->flags & MYSQLI_PRI_KEY_FLAG) ? 'PK' : '';
        $type = convertir_type($att->type);
        $infos_att[] = ['nom' => $att->name, 'type' => $type, 'cle' => $is_in_pk];
    }
    return ['schema' => $schema, 'instances' => $infos_att];
}

function get_infos_instances($nomTable) {
    global $connexion;
    $requete = "SELECT * FROM $nomTable";
    $res = mysqli_query($connexion, $requete);
    if (!$res) {
        return null;
    }

    $schema = [];
    $infos_atts = mysqli_fetch_fields($res);
    foreach ($infos_atts as $att) {
        $schema[] = ['nom' => $att->name];
    }
    $instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return ['schema' => $schema, 'instances' => $instances];
}

function convertir_type($code) {
    $types = [
        1 => 'BOOL/TINYINT', 2 => 'SMALLINT', 3 => 'INTEGER', 4 => 'FLOAT', 5 => 'DOUBLE',
        7 => 'TIMESTAMP', 8 => 'BIGINT/SERIAL', 9 => 'MEDIUMINT', 10 => 'DATE', 11 => 'TIME',
        12 => 'DATETIME', 13 => 'YEAR', 16 => 'BIT', 246 => 'DECIMAL/NUMERIC/FIXED',
        252 => 'BLOB/TEXT', 253 => 'VARCHAR/VARBINARY', 254 => 'CHAR/SET/ENUM/BINARY'
    ];
    return $types[$code] ?? '?';
}

////////////////////////////////////////////////////////////////////////
///////    Traitement de requêtes                             //////////
////////////////////////////////////////////////////////////////////////

function executer_une_requete($requete) {
    global $connexion;
    $resultat = mysqli_query($connexion, $requete);
    if (!$resultat) {
        return null;
    }

    $schema = [];
    $infos_atts = mysqli_fetch_fields($resultat);
    foreach ($infos_atts as $att) {
        $schema[] = ['nom' => $att->name];
    }
    $instances = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return ['schema' => $schema, 'instances' => $instances];
}

function executer_une_table($requete) {
    global $connexion;
    $resultat = mysqli_query($connexion, $requete);
    return $resultat !== false; // Retourne true si succès, false sinon
}

////////////////////////////////////////////////////////////////////////
///////    Fonctions d'Insertion                              //////////
////////////////////////////////////////////////////////////////////////

function insert_dans_partie($duree, $c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, 
                           $idj, $nom, $prenom, $pseudo, $date_naiss, $email, $cumul_points_cartes, 
                           $rang_arrivee, $nb_joueurs_partie, $score_final_partie, $etat, $strategie, $id_p) {
    global $connexion;

    // Récupérer l'ID maximum de Partie
    $idPartieMaxReq = executer_une_requete("SELECT MAX(idp) AS max_id FROM Partie");
    $idPartieMax = $idPartieMaxReq['instances'][0]['max_id'] ?? 0;
    $idPartieMax++;

    // Récupérer date et heure actuelles
    $dateReq = executer_une_requete("SELECT CURRENT_DATE() AS date");
    $heureReq = executer_une_requete("SELECT CURRENT_TIME() AS heure");
    $date = $dateReq['instances'][0]['date'];
    $heure = $heureReq['instances'][0]['heure'];

    // Échapper les valeurs pour éviter les injections SQL
    $nom = mysqli_real_escape_string($connexion, $nom);
    $prenom = mysqli_real_escape_string($connexion, $prenom);
    $pseudo = mysqli_real_escape_string($connexion, $pseudo);
    $date_naiss = mysqli_real_escape_string($connexion, $date_naiss);
    $email = mysqli_real_escape_string($connexion, $email);
    $etat = mysqli_real_escape_string($connexion, $etat);
    $strategie = mysqli_real_escape_string($connexion, $strategie);

    $requete = "INSERT INTO Partie (idp, date_Partie, Heure_Partie, duree, c1, c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, 
                                   idj, nom, prenom, pseudo, date_naiss, email, cumul_points_cartes, rang_arrivee, 
                                   nb_joueurs_partie, score_final_partie, etat, strategie, id_p) 
                VALUES ('$idPartieMax', '$date', '$heure', '$duree', '$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$c7', '$c8', 
                        '$c9', '$c10', '$c11', '$c12', '$idj', '$nom', '$prenom', '$pseudo', '$date_naiss', '$email', 
                        '$cumul_points_cartes', '$rang_arrivee', '$nb_joueurs_partie', '$score_final_partie', '$etat', 
                        '$strategie', '$id_p')";

    return executer_une_table($requete);
}

function insert_dans_joueur($nom, $prenom, $pseudo, $date_naiss, $email) {
    global $connexion;

    // Récupérer l'ID maximum de Joueur
    $maxJoueurReq = executer_une_requete("SELECT MAX(idj) AS max_id FROM Joueur");
    $maxJoueur = $maxJoueurReq['instances'][0]['max_id'] ?? 0;
    $maxJoueur++;

    // Échapper les valeurs
    $nom = mysqli_real_escape_string($connexion, $nom);
    $prenom = mysqli_real_escape_string($connexion, $prenom);
    $pseudo = mysqli_real_escape_string($connexion, $pseudo);
    $date_naiss = mysqli_real_escape_string($connexion, $date_naiss);
    $email = mysqli_real_escape_string($connexion, $email);

    $requete = "INSERT INTO Joueur (idj, nom, prenom, pseudo, date_naiss, email) 
                VALUES ('$maxJoueur', '$nom', '$prenom', '$pseudo', '$date_naiss', '$email')";
    
    return executer_une_table($requete);
}

function insert_dans_plateau($nb_vert, $nb_jaune, $nb_bleu, $nb_noir) {
    global $connexion;

    $taille = $nb_vert + $nb_jaune + $nb_bleu + $nb_noir;
    $idPlatReq = executer_une_requete("SELECT MAX(id_p) AS max_id FROM Plateau");
    $idPlat = $idPlatReq['instances'][0]['max_id'] ?? 0;
    $idPlat++;

    $requete = "INSERT INTO Plateau (id_p, taille) VALUES ('$idPlat', '$taille')";
    return executer_une_table($requete);
}

function getCarte($couleur) {
    global $connexion;

    $couleur = mysqli_real_escape_string($connexion, $couleur);
    $requeteMin = executer_une_requete("SELECT MIN(id_c) AS min_id FROM Carte WHERE niveau = '$couleur'");
    $requeteMax = executer_une_requete("SELECT MAX(id_c) AS max_id FROM Carte WHERE niveau = '$couleur'");
    $min = $requeteMin['instances'][0]['min_id'] ?? 0;
    $max = $requeteMax['instances'][0]['max_id'] ?? 0;

    if ($min == 0 || $max == 0) {
        return null; // Pas de cartes disponibles
    }

    $indice = rand($min, $max);
    $carteReq = executer_une_requete("SELECT image FROM Carte WHERE id_c = '$indice' LIMIT 1");
    return $carteReq['instances'][0]['image'] ?? null;
}

function recuperer_id_carte($image) {
    global $connexion;

    $image = mysqli_real_escape_string($connexion, $image);
    $carteReq = executer_une_requete("SELECT id_c FROM Carte WHERE image = '$image'");
    return $carteReq['instances'][0]['id_c'] ?? null;
}

function points_carte($image) {
    global $connexion;

    $image = mysqli_real_escape_string($connexion, $image);
    $carteReq = executer_une_requete("SELECT points FROM Carte WHERE image = '$image'");
    return $carteReq['instances'][0]['points'] ?? 0;
}

function nombre_de_joueurs() {
    $nbJoueursReq = executer_une_requete("SELECT COUNT(idj) AS nb FROM Joueur j JOIN Partie p ON p.idj = j.idj AND p.etat = 'C'");
    return $nbJoueursReq['instances'][0]['nb'] ?? 0;
}

function lancer_de($couleur) {
    $rouge = ["deR1.png", "deR2.png", "deR3.png", "deR4.png", "deR5.png", "deR6.png"];
    $bleu = ["deB1.png", "deB2.png", "deB3.png", "deB4.png", "deB5.png", "deB6.png"];
    $jaune = ["deJ1.png", "deJ2.png", "deJ3.png", "deJ4.png", "deJ5.png", "deJ6.png"];

    switch ($couleur) {
        case "rouge":
            shuffle($rouge);
            return $rouge[0];
        case "bleu":
            shuffle($bleu);
            return $bleu[0];
        case "jaune":
            shuffle($jaune);
            return $jaune[0];
        default:
            return null;
    }
}
