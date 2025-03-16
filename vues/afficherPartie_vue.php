<div>
    <form action="index.php?page=afficherPartie" method="post">
        <label for="fonc">Sélectionner la base que vous voulez voir :</label>
        <select name="fonc" id="fonc">
            <option value="solong">Toutes les parties</option>
            <option value="recent">50 parties les plus récentes</option>
            <option value="fast">Les 50 parties les plus rapides</option>
        </select>
        <input type="submit" name="theform" value="Envoyer" />
        <br><br>

        <?php
        // Fonction pour afficher un tableau de résultats
        function displayTable($resultat_requete) {
            if (is_array($resultat_requete)) {
                echo '<table class="table_resultat">';
                echo '<thead><tr>';
                foreach ($resultat_requete['schema'] as $att) {
                    echo '<th>' . $att['nom'] . '</th>';
                }
                echo '</tr></thead>';
                echo '<tbody>';
                foreach ($resultat_requete['instances'] as $row) {
                    echo '<tr>';
                    foreach ($row as $valeur) {
                        echo '<td>' . $valeur . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                global $message_details;
                echo '<p class="notification">' . $message_details . 'TOOT</p>';
            }
        }

        // Gestion de la soumission du formulaire
        if (isset($_POST['theform'])) {
            switch ($_POST['fonc']) {
                case "solong":
                    $resultat_requete = executer_une_requete($allParties);
                    break;
                case "recent":
                    $resultat_requete = executer_une_requete($cinquantePart);
                    break;
                case "fast":
                    $resultat_requete = executer_une_requete($fast);
                    break;
                default:
                    echo "Il n'y a rien";
                    break;
            }
            displayTable($resultat_requete);
        }
        ?>
    </form>
    <br><br>

    <table>
        <?php
        // Liste des liens avec leurs titres et requêtes correspondantes
        $links = [
            "Votre identifiant dans la partie" => ["lienidp", $idAct],
            "Date et horaire de la partie" => ["dateh", $horaire],
            "Taille du plateau" => ["taillep", $taillePlat],
            "Nombre de cartes rouges" => ["rouge", $nbCarteRouge],
            "Nombre de cartes jaunes" => ["jaune", $nbCarteJaune],
            "Nombre de cartes bleues" => ["bleu", $nbCarteBleu],
            "Votre pseudo" => ["pseudo", $pseudos],
            "Les classements" => ["rang", $rang]
        ];

        // Afficher chaque lien et son tableau correspondant
        foreach ($links as $title => [$requete, $query]) {
            echo '<tr>';
            echo '<td><a href="index.php?page=afficherPartie&requete=' . $requete . '">' . $title . '</a></td>';
            echo '<td><div class="resultat_requete">';
            if (isset($_GET['requete']) && $_GET['requete'] == $requete) {
                $resultat_requete = executer_une_requete($query);
                displayTable($resultat_requete);
            }
            echo '</div></td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
