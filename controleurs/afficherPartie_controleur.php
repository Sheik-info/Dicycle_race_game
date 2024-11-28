<?php

//la taille du plateau du joueur courant
$taillePlat = "SELECT p.taille FROM Plateau p JOIN Partie P ON p.id_p = P.id_p WHERE P.etat = 'C";

//ll'identifiant du joueur courant
$idAct = "SELECT j.idj FROM Joueur j JOIN Partie p ON j.idj = p.idj AND p.etat = 'C'";

//l'heure et la date de la partie du joueur courant
$horaire = "SELECT p.datePartie,p.HeurePartie FROM Partie p JOIN Joueur j ON j.idj = p.idj WHERE p.etat = 'C' ";

//le nombre de carte rouges choisis par le joueur courant
$nbCarteRouge = "SELECT COUNT(c.idc) FROM Carte c JOIN Partie p ON p.id_p = c.id_p AND p.etat = 'C' WHERE c.couleur = 'rouge' ";

//le nombre de carte jaunes choisis par le joueur courant
$nbCarteJaune = "SELECT COUNT(c.idc) FROM Carte c JOIN Partie p ON p.id_p = c.id_p AND p.etat = 'C' WHERE c.couleur = 'jaune' ";

//le nombre de carte bleus choisis par le joueur courant
$nbCarteBleu = "SELECT COUNT(c.idc) FROM Carte c JOIN Partie p ON p.id_p = c.id_p AND p.etat = 'C' WHERE c.couleur = 'bleu' ";

//le pseudo choisi par le joueur courant
$pseudos = "SELECT j.pseudo FROM Joueur j JOIN Partie p ON p.idj = j.idj AND p.etat = 'C'";

//le rang des 3 premiers joueurs courant
$rang = "SELECT i.rang,p.cumul_points_cartes FROM Individuel i
    JOIN Partie p ON p.idj = i.idj AND p.etat = 'C' 
    WHERE i.rang <= 3
    GROUP BY i.rang
    ORDER BY i.rang DESC
    LIMIT 1,3";

//pour avoir toutes les parties
$allParties = "SELECT * FROM Partie";

//les 50 dernières parties 
$cinquantePart = "SELECT * FROM Partie ORDER BY idp DESC LIMIT 50";

//les 50 parties les plus rapides
$fast = "SELECT * FROM Partie ORDER BY duree DESC LIMIT 50";
