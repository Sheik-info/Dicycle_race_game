<form action="index.php?page=jouerPartie" method="post">
    <?php
    // Fonction pour générer un menu déroulant
    function generateSelect($name, $label, $options, $id = '') {
        echo "<label for=\"$name\">$label :</label>";
        echo "<select name=\"$name\"" . ($id ? " id=\"$id\"" : "") . ">";
        foreach ($options as $value => $text) {
            echo "<option value=\"$value\">$text</option>";
        }
        echo "</select><br><br>";
    }

    // Initialisation du nombre de joueurs et de la stratégie
    if (!isset($_POST['nbjoueur']) && !isset($_POST['partie']) && !isset($_POST['commencez']) && !isset($_POST['lancer']) && !isset($_POST['tourSuivant'])) {
        echo '<div class="jouer">';
        $nbJoueursOptions = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];
        generateSelect("nbjoue", "Nombre de joueurs", $nbJoueursOptions);

        $strategieOptions = [
            "ALEA" => "Aléatoire",
            "+JEUNE" => "Le plus jeune",
            "-EXPE" => "Le moins d'expérience"
        ];
        generateSelect("contrainte", "Pour l'ordre de passage", $strategieOptions);

        echo '<input type="submit" value="Envoyer" name="nbjoueur" style="width: 60px; height: 30px" />';
        echo '</div>';
    }
    // Formulaire pour les données des joueurs
    else if (isset($_POST['nbjoueur'])) {
        echo '<div class="jouer">';
        for ($i = 1; $i <= $_POST['nbjoue']; $i++) {
            echo "<h2>Données du Joueur $i</h2>";
            echo "<label for=\"nom$i\">Saisissez votre nom :</label>";
            echo "<input type=\"text\" id=\"nom$i\" name=\"nom$i\" required minlength=\"2\" maxlength=\"11\" size=\"20\" /><br><br>";
            echo "<label for=\"prenom$i\">Saisissez votre prénom :</label>";
            echo "<input type=\"text\" id=\"prenom$i\" name=\"prenom$i\" required minlength=\"2\" maxlength=\"11\" size=\"20\" /><br><br>";
            echo "<label for=\"pseudo$i\">Saisissez votre pseudo :</label>";
            echo "<input type=\"text\" id=\"pseudo$i\" name=\"pseudo$i\" required minlength=\"4\" maxlength=\"11\" size=\"20\" /><br><br>";
            echo "<label for=\"mail$i\">Saisissez votre email :</label>";
            echo "<input type=\"email\" id=\"mail$i\" name=\"mail$i\" required minlength=\"4\" maxlength=\"20\" size=\"20\" /><br><br>";
            echo "<label for=\"naiss$i\">Saisissez votre date de naissance :</label>";
            echo "<input type=\"date\" id=\"naiss$i\" name=\"naiss$i\" required /><br><br><br>";
        }
        echo '<input type="submit" name="partie" value="Commencer" style="width: 90px; height: 30px" /><br><br>';

        // Affichage des pions
        echo "<p>Pions :</p>";
        shuffle($pions);
        for ($i = 0; $i < $_POST['nbjoue']; $i++) {
            echo "<a><img src=\"./ressources_graphiques/{$pions[$i]}\" alt=\"Pion $i\" /></a>";
        }

        // Affichage des cartes du plateau
        echo "<p>Les cartes du plateau :</p><br>";
        echo '<a><img src="./ressources_graphiques/carteDépart.png" alt="Carte de départ"></a>';
        for ($i = 1; $i <= 75; $i++) {
            $cardNumber = str_pad($i, 2, "0", STR_PAD_LEFT); // Format C01, C02, etc.
            echo "<a><img src=\"./ressources_graphiques/C$cardNumber.png\" alt=\"Carte $i\" /></a>";
        }
        echo '<a><img src="./ressources_graphiques/carteArrivée.png" alt="Carte d\'arrivée" /></a><br><br>';
        echo '</div>';
    }
    // Formulaire pour sélectionner les cartes
    else if (isset($_POST['partie'])) {
        echo '<div class="jouer">';
        echo '<h2>Jouer une partie</h2>';
        echo '<p>12 cartes maximum</p>';

        $cardOptions = range(0, 12);
        generateSelect("nbcv", "Nombre de cartes vertes à sélectionner", array_combine($cardOptions, $cardOptions), "nombre de cartes");
        generateSelect("nbcj", "Nombre de cartes jaunes à sélectionner", array_combine($cardOptions, $cardOptions), "nombre de cartes");
        generateSelect("nbcb", "Nombre de cartes bleues à sélectionner", array_combine($cardOptions, $cardOptions), "nombre de cartes");
        generateSelect("nbcn", "Nombre de cartes noires à sélectionner", array_combine($cardOptions, $cardOptions), "nombre de cartes");

        echo '<input type="submit" name="commencez" value="Envoyer" style="width: 60px; height: 60px" />';
        echo '</div>';
    }
    ?>

    <div class="joueur">
        <?php
        // Gestion des tours
        if (isset($_POST['commencez']) || isset($_POST['tourSuivant']) || isset($_POST['lancer'])) {
            static $tour = 0; // Utilisation de static pour conserver la valeur entre les appels
            $tour += 1;
            echo "Il s'agit du tour $tour<br><br>";

            // Sélection des dés
            $diceOptions = range(0, 6);
            echo '<label for="nbde">Choisissez 6 dés au total :</label><br><br>';
            generateSelect("nbdr", "Nombre de dés rouges", array_combine($diceOptions, $diceOptions), "nombre de dés rouges");
            generateSelect("nbdb", "Nombre de dés bleus", array_combine($diceOptions, $diceOptions), "nombre de dés bleus");
            generateSelect("nbdo", "Nombre de dés oranges", array_combine($diceOptions, $diceOptions), "nombre de dés oranges");
            echo '<input type="submit" name="lancer" value="Lancer" style="width: 60px; height: 30px" /><br><br>';

            // Lancer des dés et affectation
            if (isset($_POST['lancer'])) {
                $des = [];
                for ($i = 0; $i < $_POST['nbdr']; $i++) $des[] = lancer_de("rouge");
                for ($i = 0; $i < $_POST['nbdb']; $i++) $des[] = lancer_de("bleu");
                for ($i = 0; $i < $_POST['nbdo']; $i++) $des[] = lancer_de("jaune");

                $cardOptions = range(1, 12);
                foreach ($des as $index => $de) {
                    echo "<a><img src=\"./ressources_graphiques/éléments_graphiques/$de\" alt=\"Dé $index\" style=\"width: 80px; height: 80px\" /></a>";
                    echo "<label for=\"affectation$index\">Affecter à une carte :</label>";
                    echo "<select name=\"affectation[$index]\" id=\"affectation$index\">";
                    foreach ($cardOptions as $value) {
                        echo "<option value=\"$value\">Carte $value</option>";
                    }
                    echo "</select><br><br>";
                }
            }

            // Affichage du plateau de jeu
            echo '<a><img src="./ressources_graphiques/carteDépart.png" alt="Départ" /></a>';
            for ($i = 0; $i < 1; $i++) {
                echo "<a><img src=\"./ressources_graphiques/{$pions[$i]}\" alt=\"Pion $i\" class=\"absolute\" /></a>";
            }

            $cartes = [];
            foreach (["bleu" => "nbcb", "vert" => "nbcv", "jaune" => "nbcj", "noir" => "nbcn"] as $color => $nbKey) {
                for ($i = 1; $i < $_POST[$nbKey]; $i++) {
                    $temp = getCarte($color);
                    $cartes[] = $temp;
                    echo "<a><img src=\"./ressources_graphiques/$temp\" alt=\"Carte $color\" class=\"relative\" /></a>";
                }
            }
            echo '<a><img src="./ressources_graphiques/carteArrivée.png" alt="Arrivée" class="relative" /></a><br><br>';
            echo '<input type="submit" name="tourSuivant" value="Tour suivant" style="width: 90px; height: 30px" />';
        }
        ?>
    </div>
</form>
