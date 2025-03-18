# BDW Projet - Jeu de Cyclisme Stratégique

Bienvenue dans le projet **BDW** ! Ce projet est un jeu en ligne où des joueurs incarnent des cyclistes dans une course stratégique basée sur des lancers de dés et des combinaisons de cartes. Développé dans le cadre d'un travail académique, ce jeu combine une interface web intuitive avec une gestion backend via une base de données SQL.

## Principe du Jeu

Le principe du jeu est simple mais stratégique : chaque joueur est un cycliste qui doit être le premier à atteindre la fin d’un parcours composé de **12 cartes**. Pour avancer sur une case, le joueur doit réaliser la combinaison de dés spécifiée par la carte correspondante. Chaque joueur dispose de :

- **6 dés bleus**
- **6 dés jaunes**
- **6 dés rouges**

À chaque tour, le joueur sélectionne **6 dés** parmi ces 18 disponibles et a droit à un maximum de **3 lancers** pour tenter de valider une ou plusieurs cartes. La stratégie réside dans le choix des dés et le nombre de cartes à valider par tour, offrant une expérience de jeu riche et variée.

## Objectifs du Projet

- **Développer une application web interactive** : Permettre aux joueurs de configurer une partie, jouer, et consulter des statistiques.
- **Gérer une base de données** : Stocker les informations des joueurs, des parties, et des plateaux.
- **Proposer une interface utilisateur claire** : Avec des éléments graphiques (cartes, dés, pions) pour une immersion visuelle.

---

## Organisation des Fichiers

Le projet est structuré en plusieurs dossiers pour une organisation claire et modulaire :

- **`vues/`**  
  Contient les fichiers PHP/HTML responsables de l’apparence et de l’interactivité du site web. Chaque vue est associée à une page spécifique (ex. : configuration des joueurs, affichage du plateau, statistiques).

- **`static/`**  
  Répertoire pour les fichiers statiques du site, comme les initialisations du **menu de navigation** (header) et du **pied de page** (footer). Ces éléments assurent une cohérence visuelle sur toutes les pages.

- **`img/`**  
  Stocke les images décoratives utilisées pour embellir l’interface utilisateur (ex. : logos, arrière-plans, icônes).

- **`controleurs/`**  
  Contient les fichiers PHP qui gèrent la logique métier associée à chaque vue. Ces contrôleurs traitent les données envoyées par les formulaires et interagissent avec le modèle pour les requêtes SQL.

- **`modele/`**  
  Répertoire clé contenant le fichier `modele.php`, qui regroupe toutes les fonctions PHP pour interagir avec la base de données (connexion, insertions, requêtes, etc.). Il inclut également les fichiers liés au schéma SQL (ex. : scripts Mocodo).

- **`ressources_graphiques/`**  
  Dossier dédié aux éléments visuels du jeu, tels que :
  - Les **images des dés** (rouges, bleus, jaunes).
  - Les **cartes du plateau** (départ, arrivée, cartes intermédiaires).
  - Les **pions** représentant les joueurs.  
  Ces ressources sont essentielles pour l’affichage dynamique du jeu.

---

## Prérequis

Pour exécuter ce projet localement, vous aurez besoin de :

- **Serveur Web** : Apache ou Nginx (ex. : via XAMPP, WAMP, ou MAMP).
- **PHP** : Version 7.4 ou supérieure.
- **MySQL** : Pour la gestion de la base de données.
- **Navigateur Web** : Compatible avec HTML5 et CSS3 (ex. : Chrome, Firefox).



```

ID du projet : 33218

- Ba Cheikh  
  Matricule : p2109987  

- Bah Mamadou  
  Matricule : p2107491

```
