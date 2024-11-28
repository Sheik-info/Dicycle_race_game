<form action="index.php?page=jouerPartie" method="post">

    <?php
    //les nombre de joueurs vont être initialisé et la stratégie
    if (isset($_POST['nbjoueur']) == false && isset($_POST['partie']) == false && isset($_POST['commencez']) == false && isset($_POST['lancer']) == false) {
        echo "    <div class=\"jouer\">
	
	     <label for=\"nbjoueur\">Nombre de joueurs:</label>
        <select name=\"nbjoue\">
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
        </select>
        <br><br>
       <label for=\"strat\">Pour l'ordre de passage:</label>
        <select name=\"contrainte\">
            <option value=\"ALEA\">Aléatoire</option>
            <option value=\"+JEUNE\">Le plus jeune</option>
            <option value=\"-EXPE\">Le moins d'experience</option>
        </select>
        <br><br>
        
        <input type=\"submit\" value=\"envoyer\" name=\"nbjoueur\" style=\"width: 60px; height: 30px\"/>";
        //le formulaire pour les données des joueurs vont être mis dans la base
    } else if (isset($_POST['nbjoueur'])) {


        // géneration des formulaires des joueus pour le mettre dans la base
        for ($i = 1; $i <= $_POST['nbjoue']; $i++) {
            echo  "<h2>Données des Joueurs $i</h2>";

            echo "<label for=\"nom$i\">Saisissez votre nom:</label>
        <input type=\"text\" id=\"nom$i\" name=\"nom$i\" required minlength=\"2\" maxlength=\"11\" size=\"20\" /><br><br>
        
        <label for=\"prenom$i\">Saisissez votre prenom:</label>
        <input type=\"text\" id=\"prenom$i\" name=\"prenom$i\" required minlength=\"2\" maxlength=\"11\" size=\"20\" /><br><br>
        
        <label for=\"pseudo$i\">Saisissez votre pseudo:</label>
        <input type=\"text\" id=\"pseudo$i\" name=\"pseudo$i\" required minlength=\"4\" maxlength=\"11\" size=\"20\" /><br><br>
        
        <label for=\"mail$i\">Saisissez votre email:</label>
        <input type=\"text\" id=\"mail$i\" name=\"mail$i\" required minlength=\"4\" maxlength=\"20\" size=\"20\" /><br><br>
        
        <label for=\"naiss$i\">Saisissez votre date de naissance:</label>
        <input type=\"text\" id=\"naiss$i\" name=\"naiss$i\" required minlength=\"4\" maxlength=\"20\" size=\"20\" /><br><br><br><br>";
        }
        echo "<input type=\"submit\" name=\"partie\" value=\"Commencer\" style=\"width: 90px; height: 30px\"/><br><br><br><br>";

        echo "<p>Pions</p>";
        //mélange de pions aléatoire
        shuffle($pions);
        for ($i = 0; $i < $_POST['nbjoue']; ++$i) {

            echo "
        <a>
		<img src=\"./ressources_graphiques/$pions[$i]\" />
		</a>";
        }
        //je montre les cartes
        echo "<p>Les cartes du plateau:</p><br>
                <a>
		<img src=\"./ressources_graphiques/carteDépart.png\">
		</a>
		
        ";
        for ($i = 1; $i <= 75; ++$i) {
            echo   " <a>
		<img src=\"./ressources_graphiques/C0$i.png\" />
		</a>";
        }
        echo "
		<a>
		<img src=\"./ressources_graphiques/carteArrivée.png\"/>
		</a>
        <br><br>";

        echo " </div>";
    }
    //formulaire pour mettre en place le jeu
    if (isset($_POST['partie'])) {
        //formulaire pour la selection des cartes
        echo "    <div class=\"jouer\">

        <h2>Jouer une partie</h2>
        <p>12 cartes maximum </p>
        
        <label for=\"nbverte\">Nombre de cartes vertes à sélectionner:</label>
        <select name=\"nbcv\" id=\"nombre de cartes\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
        </select>
        <br><br>
        
        <label for=\"nbjaune\">Nombre de cartes jaunes à sélectionner:</label>
        <select name=\"nbcj\" id=\"nombre de cartes\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
        </select>
        <br><br>
        
        <label for=\"nbbleu\">Nombre de cartes bleus à sélectionner:</label>
        <select name=\"nbcb\" id=\"nombre de cartes\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
        </select>
        <br><br>

        <label for=\"nbnoir\">Nombre de cartes noires à sélectionner:</label>
        <select name=\"nbcn\" id=\"nombre de cartes\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
            <option value=10>10</option>
            <option value=11>11</option>
            <option value=12>12</option>
        </select>
        <br><br>
        
        
        <input type=\"submit\" name=\"commencez\" value=\"envoyer\" style=\"width: 60px; height: 60px\"/>
        
        
        </div>";
    }

    ?>
    <div class="joueur">

        <?php

        $tour = 0;
        //commencement de la partie, gestion du tour
        if (isset($_POST['commencez']) || isset($_POST['tourSuivant']) || isset($_POST['lancer'])) {
            $tour += 1;


            //$pions $i jusqu'à $_POST['nbj']
            echo "Il s'agit du tour $tour<br><br>";
            // echo getCarte("bleu"); testé il marche bien

            //selections des dés et lancement des dés
            echo "<label for=\"nbde\">Choisissez 6 dés au total:</label><br><br>
	<label for=\"nbrouge\">Nombre de dés rouges:</label>
        <select name=\"nbdr\" id=\"nombre de dés rouges\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
        </select>
        <br><br>
        <label for=\"nbbleus\">Nombre de dés bleus:</label>
                <select name=\"nbdb\" id=\"nombre de dés bleus\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
        </select>
        <br><br>
        <label for=\"nbjaune\">Nombre de dés oranges:</label>
            <select name=\"nbdo\" id=\"nombre de dés oranges\">
            <option value=0>0</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
        </select>
        <br><br>
        
        <input type=\"submit\" name=\"lancer\" value=\"lancer\" style=\"width: 60px; height: 30px\"/><br><br>";

            if (isset($_POST['lancer'])) {
                for ($i = 0; $i < $_POST['nbdr']; ++$i) {
                    $des[] = lancer_de("rouge");
                }
                for ($i = 0; $i < $_POST['nbdb']; ++$i) {
                    $des[] = lancer_de("bleu");
                }
                for ($i = 0; $i < $_POST['nbdo']; ++$i) {
                    $des[] = lancer_de("jaune");
                }
                for ($i = 0; $i < 6; ++$i) {
                    echo    "<a>
		        <img src=\"./ressources_graphiques/éléments_graphiques/$des[$i]\" alt=\"dé\" style=\"width: 80px; height: 80px\"/>
		        </a>
                <label for=\"nbjaune\">Affecter à une carte</label>
                <select name=\"affectation\" id=\"nombre de dés oranges\">
                <option value=1>carte 1</option>
                <option value=2>carte 2</option>
                <option value=3>carte 3</option>
                <option value=4>carte 4</option>
                <option value=5>carte 5</option>
                <option value=6>carte 6</option>
                <option value=7>carte 7</option>
                <option value=7>carte 8</option>
                <option value=7>carte 9</option>
                <option value=7>carte 10</option>
                <option value=7>carte 11</option>
                <option value=7>carte 12</option>
                </select><br><br>
                ";
                }
            }
            echo "<br><br>";


            //je mets pas ce genre de variables dans le controleur car le site web ne le détecte pas
            $temp;
            echo "<a>
		<img src=\"./ressources_graphiques/carteDépart.png\" alt=\"départ\" />
		</a>";
            //j'aurais mis $nombre de joueurs mais vu que les requetes ne marchent pas
            for ($i = 0; $i < 1; ++$i) {
                echo "<a>
		<img src=\"./ressources_graphiques/$pions[$i]\" alt=\"imagine\" class=\"absolute\"/>
		</a>";
            }

            //affichage du plateau de jeu
            for ($i = 1; $i < $_POST['nbcb']; ++$i) {

                $temp = getCarte("bleu");
                $cartes[] = "$temp";
                $temp = "./ressources_graphiques/" . '$temp';
                echo "<a>
		<img src='$temp' alt=\"cartebleu\" class=\"relative\"/>
		</a>";
            }
            for ($i = 1; $i < $_POST['nbcv']; ++$i) {

                $temp = getCarte("vert");
                $cartes[] = "$temp";
                $temp = "./ressources_graphiques/" . '$temp';
                echo "<a>
		<img src='$temp' alt=\"carteverte\" class=\"relative\"/>
		</a>";
            }
            for ($i = 1; $i < $_POST['nbcj']; ++$i) {
                $temp = getCarte("orange");
                $cartes[] = "$temp";
                $temp = "./ressources_graphiques/" . '$temp';
                echo "<a>
		<img src='$temp' alt=\"carteorange\" class=\"relative\"/>
		</a>";
            }
            for ($i = 1; $i < $_POST['nbcn']; ++$i) {
                $temp = getCarte("noir");
                $cartes[] = "$temp";
                $temp = "./ressources_graphiques/" . '$temp';
                echo "<a>
		<img src='$temp' alt=\"cartenoir\" class=\"relative\"/>
		</a>";
            }
            echo "<a>
		<img src=\"./ressources_graphiques/carteArrivée\" alt=\"fin\" class=\"relative\"/>
		</a>";


            echo "<br><br>";
        }

        ?>

    </div>

</form>