<div>
	<form action="index.php?page=afficherPartie" method="post">
		<!--bloc pour le selecteur et l'affichage de la 
	la table sql selectionné -->
		<label for="strat">Selectionner la base que vous voulez voir:</label>
		<select name="fonc">
			<option value="solong">Toutes les parties</option>
			<option value="recent">50 parties les plus récentes</option>
			<option value="fast">Les 50 parties les plus rapides</option>
		</select>
		<input type="submit" name="theform" value="envoyer" />
		<br><br>
		<?php
		//gestion du lien cliqué pour l'affichage des données actuelles
		//test avec un switch du lien hypertexte clické
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
					echo "il n'y'a rien";
					break;
			}

			if (is_array($resultat_requete)) {

				echo	"<table class=\"table_resultat\">
					<thead>
						<tr>";

				//var_dump($resultats);
				foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

					echo '<th>';
					echo $att['nom'];
					echo '</th>';
				}

				echo	"</tr>
					</thead>
					<tbody>";


				foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

					echo '<tr>';
					foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

						echo '<td>' . $valeur . '</td>';
					}
					echo '</tr>';
				}

				echo	"</tbody>
				</table>";
			} else {

				echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
			}





			echo	"</div>
	</td>
</tr>";
		}
		?> <br><br>

	</form>
</div>
<br><br>
<table>

	<tr>
		<td><a href="index.php?page=afficherPartie&requete=lienidp">Votre identifiant dans la partie</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'lienidp') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>

	<tr>


		<td><a href="index.php?page=afficherPartie&requete=dateh">Date et horaire de la partie</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'dateh') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>


	<tr>


		<td><a href="index.php?page=afficherPartie&requete=taillep">Taille du plateau</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'taillep') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>




	<tr>


		<td><a href="index.php?page=afficherPartie&requete=rouge">Nombre de cartes rouges</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'rouge') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>
	<tr>


		<td><a href="index.php?page=afficherPartie&requete=jaune">Nombre de cartes jaunes</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'jaune') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>



	<tr>


		<td><a href="index.php?page=afficherPartie&requete=bleu">Nombre de cartes bleues</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'bleu') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>

	<tr>


		<td><a href="index.php?page=afficherPartie&requete=pseudo">Votre pseudo</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'pseudo') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>


	<tr>


		<td><a href="index.php?page=afficherPartie&requete=rang">Les classements</a></td>
		<td>
			<div class="resultat_requete">

				<?php
				if ($_GET['requete'] == 'rang') {
					$resultat_requete = executer_une_requete($idAct);


					if (is_array($resultat_requete)) {

						echo	"<table class=\"table_resultat\">
						<thead>
							<tr>";

						//var_dump($resultats);
						foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

							echo '<th>';
							echo $att['nom'];
							echo '</th>';
						}

						echo	"</tr>
						</thead>
						<tbody>";


						foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

							echo '<tr>';
							foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

								echo '<td>' . $valeur . '</td>';
							}
							echo '</tr>';
						}

						echo	"</tbody>
					</table>";
					} else {

						echo	"<p class=\"notification\"><?= $message_details . 'TOOT' ?></p>";
					}
				}
				?>



			</div>
		</td>
	</tr>
</table>


</div>


</div>