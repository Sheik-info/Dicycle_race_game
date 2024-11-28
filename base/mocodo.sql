mocodo 1

Partie: idp,datePartie,horairePartie,duree,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,nom,prenom,pseudo,etat,date_naiss,email,equipe,cumul_points_cartes,rang_arrivee,nb_joueurs_partie,score_final_partie,état,strategie
Est_Liee, Phase, Partie
Phase: niveau, a_joué,est_qualifié
A_Une, _11 Phase, 1N Tournoi
:

Joue, 1N Partie, 1N Joueur: score,couleur_pion
Joueur: idj,nom,prenom,pseudo,date_nais,email,nb_Parties
Se_Classe, 1N Joueur, 1N Individuel, 1N Tournoi: a_joue, est_qualifie
Tournoi:idt,nom,phase,nom,dateDeb,dateFin
En_Lien, 1N Tournoi, 1N Tournoi

Equipe: ide,nom,
Est_Dans_Une, 01 Joueur, 1N Equipe
Individuel: rang
Resultat, 1N Tournoi, 11 Classement
:

Contient, 1N Equipe, 1N Classement_Equipe
Classement_Equipe: rang
/X\CLASSEMENT -> Classement_Equipe, Individuel
Classement: idc,rang,portee,nom
Est_Lie, 1N Classement, 1N Classement

mocodo 2

Se_Compose, 1N Partie, _1N Tour
Tour: numT,numL,carte_a_valider,de1,de2,de3,de4,de5,de6,main_nb_bleu,main_nb_jaune,main_nb_rouge
COMPOSE, 1N Lancer, _1N Tour
Lancer: idl

Partie: idp,datePartie,horairePartie,duree,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,nom,prenom,pseudo,etat,date_naiss,email,equipe,cumul_points_cartes,rang_arrivee,nb_joueurs_partie,score_final_partie,état,strategie
Tente_Validation, _1N Tour, 1N Carte, 1N Joueur : nbTentative
Joueur: idj,nom,prenom,pseudo,date_nais,email,nb_Parties
Effectue, 1N Joueur, 1N Lancer: rang,couleur,valeur

DISPOSE, 11 Partie, 11 Plateau
Carte: id_c, niveau, image, points,couleur,valeur,sens
A_Comme, 11 Carte, 1N Contrainte
:

Plateau: id_p, taille
Est_Compose, 1N Plateau, 1N Carte
Contrainte: id_Co, couleur
:
