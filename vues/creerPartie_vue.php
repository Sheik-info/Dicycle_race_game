<form action="index.php?page=creerPartie" method="Post">

    <?php
    if (isset($_POST['create']) == false) {
        // pour stocker le formulaire et l'envoyer si le bouton est appuyé
    ?>
        <div class="jouer">

            <h2>Créer une partie</h2>

            <label for="nbCartes">Nombre de cartes constituant le plateau:</label>
            <select name="nbCartes" id="nbCartes">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="nbVertes">Nombre de cartes vertes à sélectionner:</label>
            <select name="nbVertes" id="nbVertes">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="nbOranges">Nombre de cartes vertes à sélectionner:</label>
            <select name="nbOrange" id="nbOrange">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>
            <br><br>

            <label for="nbNoires">Nombre de cartes vertes à sélectionner:</label>
            <select name="nbNoires" id="nbNoires">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
                ?>
            </select>
            <br><br>



            <label for="typeStrat">Choisissez l'ordre de passage:</label>
            <input type="text" id="typeStrat" name="typeStrat" required minlength="4" maxlength="8" size="20" /><br><br>

            <button type="submit" name="create" value="creer" style="width: 60px; height: 30px">Créer</button>

        </div>
    <?php
    } 
    else
    {
      
        echo "<p>La partie a été créée avec succès!</p>";
    }
    ?>
</form>