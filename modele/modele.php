<?php

////////////////////////////////////////////////////////////////////////
///////    Gestion de la connxeion   ///////////////////////////////////
////////////////////////////////////////////////////////////////////////

/**
 * Initialise la connexion à la base de données courante (spécifiée selon constante 
 *	globale SERVEUR, UTILISATEUR, MOTDEPASSE, BDD)			
 */
function open_connection_DB()
{
	global $connexion;

	$connexion = mysqli_connect(SERVEUR, UTILISATEUR, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
		printf("Échec de la connexion : %s\n", mysqli_connect_error());
		exit();
	}
} //il vérifie lui même i la connection a réussi et pour se connecter il utili

/**
 *  	Ferme la connexion courante
 * */
function close_connection_DB()
{ //le controleur sert à avoir accès à toutes les tables
	global $connexion;

	mysqli_close($connexion);
}


////////////////////////////////////////////////////////////////////////
///////   Accès au dictionnaire       ///////////////////////////////////
////////////////////////////////////////////////////////////////////////


/**array
 *  Retourne la liste des tables définies dans la base de données courantes (BDD)
 * */
function get_tables()
{
	global $connexion;

	$requete = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '" . BDD . "'";

	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC); //fonction mysqli pour recup valeurs des instances
	return $instances;
}


/**
 *  Retourne les statistiques sur la base de données courante
 * */
function get_statistiques()
{
	//TODO

	return null;
}

////////////////////////////////////////////////////////////////////////
///////    Informations (structure et contenu) d'une table    //////////
////////////////////////////////////////////////////////////////////////

/**
 *  Retourne le détail des infos sur une table ex1.2
 * */
function get_infos($typeVue, $nomTable)
{
	global $connexion;

	switch ($typeVue) {
		case 'schema':
			return get_infos_schema($nomTable);
			break;
		case 'data':
			return get_infos_instances($nomTable);
			break;
		default:
			return null;
	}
}

/**
 * Retourne le détail sur le schéma de la table
 */
function get_infos_schema($nomTable)
{
	global $connexion;

	// récupération des informations sur la table (schema + instance)
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete); //c'est celui là qui le permets

	// construction du schéma qui sera composé du nom de l'attribut et de son type	
	$schema = array(array('nom' => 'nom_attribut'), array('nom' => 'type_attribut'), array('nom' => 'clé'));

	// récupération des valeurs associées au nom et au type des attributs
	$metadonnees = mysqli_fetch_fields($res);

	$infos_att = array();
	foreach ($metadonnees as $att) {
		//var_dump($att);

		$is_in_pk = ($att->flags & MYSQLI_PRI_KEY_FLAG) ? 'PK' : '';
		$type = convertir_type($att->{'type'});

		array_push($infos_att, array('nom' => $att->{'name'}, 'type' => $type, 'cle' => $is_in_pk));
	}

	return array('schema' => $schema, 'instances' => $infos_att); //le premier tableau contient les schémas le deuxieme les instances

}

function get_infos_requete($getRequete)
{
	global $connexion;


	$res = $getRequete;

	// extraction des informations sur le schéma à partir du résultat précédent
	$iarraynfos_atts = mysqli_fetch_fields($res);

	// filtrage des information du schéma pour ne garder que le nom de l'attribut
	$schema = array();
	$infos_atts = array();
	foreach ($infos_atts as $att) {
		array_push($schema, array('nom' => $att->{'name'})); // syntaxe objet permettant de récupérer la propriété 'name' du de l'objet descriptif de l'attribut courant
	}

	// récupération des données (instances) de la table
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);

	// renvoi d'un tableau contenant les informations sur le schéma (nom d'attribut) et les n-uplets
	return array('schema' => $schema, 'instances' => $instances);
}

/**
 * Retourne les instances de la table
 */
function get_infos_instances($nomTable)
{
	global $connexion;

	// récupération des informations sur la table (schema + instance)
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);

	// extraction des informations sur le schéma à partir du résultat précédent
	$iarraynfos_atts = mysqli_fetch_fields($res);

	// filtrage des information du schéma pour ne garder que le nom de l'attribut
	$schema = array();
	foreach ($infos_atts as $att) {
		array_push($schema, array('nom' => $att->{'name'})); // syntaxe objet permettant de récupérer la propriété 'name' du de l'objet descriptif de l'attribut courant
	}

	// récupération des données (instances) de la table
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);

	// renvoi d'un tableau contenant les informations sur le schéma (nom d'attribut) et les n-uplets
	return array('schema' => $schema, 'instances' => $instances);
}


function convertir_type($code)
{
	switch ($code) {
		case 1:
			return 'BOOL/TINYINT';
		case 2:
			return 'SMALLINT';
		case 3:
			return 'INTEGER';
		case 4:
			return 'FLOAT';
		case 5:
			return 'DOUBLE';
		case 7:
			return 'TIMESTAMP';
		case 8:
			return 'BIGINT/SERIAL';
		case 9:
			return 'MEDIUMINT';
		case 10:
			return 'DATE';
		case 11:
			return 'TIME';
		case 12:
			return 'DATETIME';
		case 13:
			return 'YEAR';
		case 16:
			return 'BIT';
		case 246:
			return 'DECIMAL/NUMERIC/FIXED';
		case 252:
			return 'BLOB/TEXT';
		case 253:
			return 'VARCHAR/VARBINARY';
		case 254:
			return 'CHAR/SET/ENUM/BINARY';
		default:
			return '?';
	}
}

////////////////////////////////////////////////////////////////////////
///////    Traitement de requêtes                             //////////
////////////////////////////////////////////////////////////////////////

/**
 * Retourne le résultat (schéma et instances) de la requ$ete $requete
 * */
function executer_une_requete($requete)
{
	global $connexion;
	$resultat = mysqli_query($connexion, $requete);


	return get_infos_requete($resultat);
}
function executer_une_table($requete)
{
	global $connexion;
	$resultat = mysqli_query($connexion, $requete);
}


//fonction pour inserer la partie dans la base 
//on définit l'état C comme en cours et l'état T comme terminée
function insert_dans_partie(
	$duree,
	$c1,
	$c2,
	$c3,
	$c4,
	$c5,
	$c6,
	$c7,
	$c8,
	$c9,
	$c10,
	$c11,
	$c12,
	$idj,
	$nom,
	$prenom,
	$pseudo,
	$date_naiss,
	$email,
	$cumul_points_cartes,
	$rang_arrivee,
	$nb_joueurs_partie,
	$score_final_partie,
	$etat,
	$strategie,
	$id_p
) {
	foreach ($idPartieMax['instances'] as $row) {
		foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

			$idPartieMax = $valeur;
		}
	}
	//on recupère la date et heure courante avec une fonction prédéfinie par sql
	$date = "SELECT CURRENT_DATE()";
	$heure = "SELECT CURRENT_TIME";
	$date = executer_une_requete($date);
	$heure = executer_une_requete($heure);

	$idPartieMax++;
	$partie = "INSERT INTO Partie (idp,date_Partie,Heure_Partie,duree,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,idj
    			,nom,prenom,pseudo,date_naiss,email,cumul_points_cartes,rang_arrivee,nb_joueurs_partie,score_final_partie,etat,strategie,id_p) VALUES
    ('$idPartieMax','$date','$heure',$duree,$c1,$c2,$c3,$c4,$c5,$c6,$c7,$c8,$c9,$c10,$c11,$c12,$idj
    			,'$nom','$prenom','$pseudo','$date_naiss','$email',$cumul_points_cartes,$rang_arrivee,$nb_joueurs_partie,$score_final_partie,'$etat','$strategie',$id_p)";

	executer_une_table($partie);
}
//inserer un joueur dans la base
function insert_dans_joueur($nom, $prenom, $pseudo, $date_naiss, $email)
{
	$maxJoueur = "SELECT MAX(idj) FROM Joueur";
	$maxJoueur = executer_une_requete($maxJoueur);

	foreach ($maxJoueur['instances'] as $row) {
		foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

			$maxJoueur = $valeur;
		}
	}
	$maxJoueur++;
	$joueurs = "INSERT INTO Joueur (idj, nom, prenom, pseudo, date_naiss, email) VALUES ($maxJoueur,'$nom','$prenom','$pseudo','$date_naiss','$email')";
	executer_une_table($joueurs);

	$prepare = mysqli_prepare($connexion, $joueurs);
	$res2 = mysqli_stmt_execute($prepare);
}

function insert_dans_plateau($nb_vert, $nb_rouge, $nb_jaune, $nb_noir)
{
	$taille = $nb_vert + $nb_rouge + $nb_jaune + $nb_noir;
	$idplat = "SELECT MAX(id_p) FROM Plateau";
	executer_une_requete($idplat);
	foreach ($idplat['instances'] as $row) {
		foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

			$idplat = $valeur;
		}
	}
	$idplat = $idplat++;
	$plateau = "INSERT INTO Plateau (id_p,taille) VALUES
    ($idplat,$taille)";
	executer_une_table($plateau);
}



//fonction qui va prendre un carte au hasard selon sa couleur
function getCarte($couleur)
{
	$requeteMin = "SELECT MIN(id_c) FROM Carte WHERE niveau = '$couleur'";
	$requeteMax = "SELECT MAX(id_c) FROM Carte WHERE niveau = '$couleur'";
	$requeteMin = executer_une_requete($requeteMin);
	$requeteMax = executer_une_requete($requeteMax);

	//on recupere la valeur minimum et maximum pour un rand plus tard
	foreach ($requeteMin['instances'] as $row) {
		foreach ($row as $valeur) {

			$min = $valeur;
		}
	}

	foreach ($requeteMax['instances'] as $row) {
		foreach ($row as $valeur) {

			$max = $valeur;
		}
	}


	$indice = rand($min, $max);
	//le LIMIT c'est juste pour être sur
	$carte = "SELECT image FROM Carte WHERE id_c = $indice LIMIT 1";
	$carte = executer_une_requete($carte);


	foreach ($carte['instances'] as $row) {
		foreach ($row as $valeur) {

			$carte = $valeur;
		}
	}
	//boucle de selection des cartes dans la base
	//avec une fonction qui prend un tableau et la quantité de cartes à mettre dedans avec une requete sql et la fonction rand





	return $carte;
}
//l'id en fonction de l'url de la carte
function recuperer_id_carte($image)
{
	$carte = "SELECT id_c FROM Carte WHERE image = '$image'";
	executer_une_requete($carte);
	foreach ($carte['instances'] as $row) {
		foreach ($row as $valeur) {

			$carte = $valeur;
		}
	}

	return $carte;
}
//le nombre de points que donne une carte
function points_carte($image)
{
	$carte = "SELECT points FROM Carte WHERE image = '$image'";
	executer_une_requete($carte);
	foreach ($carte['instances'] as $row) {
		foreach ($row as $valeur) {

			$carte = $valeur;
		}
	}

	return $carte;
}
//retourne le nombre de joueurs en jeu
function nombre_de_joueurs()
{
	$nb_joueurs = "SELECT COUNT(idj) FROM Joueur j JOIN Partie p ON  p.idj = j.idj AND p.etat = 'C'";
	$nb_joueurs = executer_une_requete($nb_joueurs);
	foreach ($nb_joueurs['instances'] as $row) {
		foreach ($row as $valeur) {

			$nb_joueurs = $valeur;
		}
	}

	return $nb_joueurs;
}
//pour lancer les dés aléatoirement
function lancer_de($couleur)
{
	//on va initialiser trois tableaux de dés avec les images de dés et les tirer aléatoirement
	$rouge = array("deR1.png", "deR2.png", "deR3.png", "deR4.png", "deR5.png", "deR6.png");
	$bleu = array("deB1.png", "deB2.png", "deB3.png", "deB4.png", "deB5.png", "deB6.png");
	$jaune = array("deJ1.png", "deJ2.png", "deJ3.png", "deJ4.png", "deJ5.png", "deJ6.png");

	//on mélange aléatoirement et on mets la premiere la valeur dans la variable
	if ($couleur == "bleu") {
		shuffle($bleu);
		$resultat = $bleu[0];
	} else if ($couleur == "rouge") {
		shuffle($rouge);
		$resultat = $rouge[0];
	} else {
		shuffle($jaune);
		$resultat = $jaune[0];
	}

	return $resultat;
}
