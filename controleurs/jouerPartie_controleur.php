<?php
//va stocker les cartes choisies
$cartes = array();

//on stocke aussi  les dés
$des = array();


//compteurs de tour
$tour;



//on stocke les pions pour les attribuer aléatoirement aux joueurs
$pions = array("pion1.png", "pion2.png", "pion3.png", "pion4.png", "pion5.png", "pion6.png");

//pour mettre les infos des joueurs dans la base
//je rentre les données des joueurs dans la table en vérifiant bien qu'ils soient templies
if (isset($_POST['partie'])) {



  if (!empty($_Post['nom1'])) {
    insert_dans_joueur($_POST['nom1'], $_POST['prenom1'], $_POST['pseudo1'], $_POST['mail1'], $_POST['naiss1']);
  }
  if (!empty($_POST['nom2'])) {
    insert_dans_joueur($_POST['nom2'], $_POST['prenom2'], $_POST['pseudo2'], $_POST['mail2'], $_POST['naiss2']);
  }
  if (!empty($_Post['nom3'])) {
    insert_dans_joueur($_POST['nom3'], $_POST['prenom3'], $_POST['pseudo3'], $_POST['mail3'], $_POST['naiss3']);
  }
  if (!empty($_Post['nom4'])) {
    insert_dans_joueur($_POST['nom4'], $_POST['prenom4'], $_POST['pseudo4'], $_POST['mail4'], $_POST['naiss4']);
  }
}

//on va mettre le plateau dans la base et la partie aussi


if (isset($_POST['commencez'])) {
  $nbJoueurs = nombre_de_joueurs();
  insert_dans_plateau($_POST['nbcv'], $_POST['nbcr'], $_POST['nbcj'], $_POST['nbcn']);
}
