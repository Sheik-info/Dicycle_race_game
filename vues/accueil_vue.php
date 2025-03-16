<main class="principal">
    <div>
        <h2>Principe du jeu :</h2>
        <p>
            Le principe du jeu est le suivant : chaque joueur est un cycliste qui doit arriver le premier au bout du
            parcours qui est composé de 12 cartes. Pour avancer sur une case, il faut que le joueur réalise la combinaison de
            dés demandée sur la carte. Pour cela, chaque joueur dispose de 6 dés de couleur bleue, 6 dés de couleur jaune
            et 6 dés de couleur rouge. À chaque tour, le joueur choisit 6 dés parmi les 18 dés de couleurs pour essayer de
            valider une ou plusieurs cases en au plus 3 lancers. Différentes stratégies peuvent être mises en place en fonction
            du nombre de cartes que le joueur souhaite valider en un tour.
        </p>

        <h2>Statistiques :</h2>
        <table class="accueil">
            <?php
            // Liste des statistiques avec leurs titres et requêtes correspondantes
            $stats = [
                "Nombre de joueurs ayant joué" => $nbJoueur,
                "Nombre d'équipes ayant joué" => $nbEquipe,
                "Quantité de classement en donnée" => $nbClassement,
                "Nombre de tournois organisés" => $nbTournois,
                "Moyenne participations aux tournois" => $moyTournoi,
                "Vos données en phase de tournois" => $vosDonnee,
                "Nombre d’équipes classées premières des classements" => $classEquipe,
                "Nombre moyens des participants des 3 dernières années aux tournois" => $troisAnnee,
                "Joueurs classés de manière individuelle dans le top 5" => $rang,
                "Pour chaque taille de plateau le nombre de parties jouées" => $accPlateau,
                "Top 5 des joueurs qui ont joué le plus de parties" => $pseudo
            ];

            // Fonction pour afficher un tableau de résultats
            function displayTable($title, $query) {
                $resultat_requete = executer_une_requete($query);
                echo '<tr>';
                echo '<td>' . $title . ' :</td>';
                echo '<td><div class="resultat_requete">';
                
                if (is_array($resultat_requete)) {
                    echo '<table class="table_resultat">';
                    echo '<thead><tr>';
                    foreach ($resultat_requete['schema'] as $att) {
                        echo '<th>' . htmlspecialchars($att['nom']) . '</th>';
                    }
                    echo '</tr></thead>';
                    echo '<tbody>';
                    foreach ($resultat_requete['instances'] as $row) {
                        echo '<tr>';
                        foreach ($row as $valeur) {
                            echo '<td>' . htmlspecialchars($valeur) . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    $message_details = "Erreur lors de la récupération des données.";
                    echo '<p class="notification">' . htmlspecialchars($message_details) . '</p>';
                }
                echo '</div></td>';
                echo '</tr>';
            }

            // Afficher chaque statistique
            foreach ($stats as $title => $query) {
                displayTable($title, $query);
            }
            ?>
        </table>
    </div>
</main>
