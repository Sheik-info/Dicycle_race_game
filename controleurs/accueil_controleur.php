<!--
Pas de fonctionnalité pour l'accueil
-->
<?php
//nombres de joueurs en base
$nbJoueur = "SELECT COUNT(idj) FROM Joueur";

//nombre d'équipes en base
$nbEquipe = "SELECT COUNT(ide) FROM Equipe";

//la quantité de classement en base
$nbClassement = "SELECT COUNT(idc) FROM Classement";

//le nombre de tournois organisés
$nbTournois = "SELECT COUNT(idt) FROM Tournoi";

//La moyenne de participation lors des tournois
$moyTournoi = "SELECT AVG(j.idj) FROM Joueur j JOIN Se_Classe s ON j.idj = s.idj AND s.a_joue = 1 
JOIN Tournoi t1 ON t1.idt = s.idt JOIN Tournoi t2 ON t2.idt = s.idt AND t1.idt <> t2.idt";

//données du joueur courant
$vosDonnee = "SELECT t.nom,t.dateDeb,h.niveau FROM Tournoi t
JOIN Phase h ON h.idt = t.idt
JOIN Se_Classe s ON s.idt = t.idt
JOIN Joueur j ON j.idj = s.idj
JOIN Partie p ON p.idj = j.idj WHERE p.etat = 'C'";

//Equipes des premières places mais pas de premières places individuels
$classEquipe = "SELECT COUNT(e.ide) FROM Equipe e
JOIN Classement_Equipe ce ON ce.ide = e.ide AND ce.rang = 1
JOIN Individuel i ON i.idc = ce.idc
WHERE i.rang != 1";

//moyenne des joueurs des tournois des trois dernières années
$troisAnnee = "SELECT AVG(j.idj) FROM Joueur j 
	JOIN Se_Classe s ON j.idj = s.idj AND s.a_joue = 1
    JOIN Tournoi t ON s.idt = t.idt
    GROUP BY YEAR(dateDeb)
    ORDER BY YEAR(dateDeb) DESC
    LIMIT 1,3";

//noms et prenoms des joueurs qui ont fait top 5 dans un tournoi de portée nationale 
$rang = "SELECT j.nom,j.prenom FROM Joueur j
JOIN Individuel i ON i.idj = j.idj AND i.rang <= 5
JOIN Classement c ON c.idc = i.idc AND c.portee = 'nationale'";

//parties joués par plateaux
$accPlateau = "SELECT DISTINCT p.id_p,COUNT(pa.idp) FROM Plateau p
JOIN Partie pa ON pa.id_p = p.id_p";

//pseudo du top 5 par nombre de parties
$pseudo = "SELECT pseudo FROM Joueur  
ORDER BY nb_Parties DESC
LIMIT 5";


?>