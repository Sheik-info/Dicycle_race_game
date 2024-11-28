<main class="principal">

	<div>
		<h2> Principe du jeu: <br> </h2>
		<p>
			Le principe du jeu est le suivant : chaque joueur est un cycliste qui doit arriver le premier au bout du
			parcours qui est composé de 12 cartes. Pour avancer sur une case, il faut que le joueur réalise la combinaison de
			dés demandée sur la carte. Pour cela, chaque joueur dispose de 6 dés de couleur bleue, 6 dés de couleur jaune
			et 6 dés de couleur rouge. À chaque tour, le joueur choisit 6 dés parmi les 18 dés de couleurs pour essayer de
			valider une ou plusieurs cases en au plus 3 lancers. Différentes stratégies peuvent être mises en place en fonction
			du nombre de cartes que le joueur souhaite valider en un tour.
		</p> <br>


		<h2> Statistiques: <br> </h2>

		<table class="accueil">
			<tr>
				<td>Nombre de joueurs ayant joué:</td>
				<td>
					<div class="resultat_requete">

						<?php //affichage de quelques statistiques en base
						$resultat_requete;
						$resultat_requete = executer_une_requete($nbJoueur);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Nombre d'équipes ayant joué:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($nbEquipe);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Quantité de classement en donnée:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($nbClassement);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Nombre de tournois organisés:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($nbTournois);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Moyenne participations aux tournois:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($moyTournoi);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Vos données en phase de tournois:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($vosDonnee);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Nombre d’équipes classées premières des classements:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($classEquipe);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Nombre moyens des participants des 3 dernières années aux tournois:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($troisAnnee);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Joueurs classés de manière individuelle dans le top 5:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($rang);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Pour chaque taille de plateaule nombre de parties jouées:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($accPlateau);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
			<tr>
				<td>Top 5 des joueurs qui ont joué le plus de parties:</td>
				<td>
					<div class="resultat_requete">

						<?php
						$resultat_requete;
						$resultat_requete = executer_une_requete($pseudo);

						if (is_array($resultat_requete)) {
						?>
							<table class="table_resultat">
								<thead>
									<tr>
										<?php
										//var_dump($resultats);
										foreach ($resultat_requete['schema'] as $att) {  // pour parcourir les attributs

											echo '<th>';
											echo $att['nom'];
											echo '</th>';
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php
									foreach ($resultat_requete['instances'] as $row) {  // pour parcourir les n-uplets

										echo '<tr>';
										foreach ($row as $valeur) { // pour parcourir chaque valeur de n-uplets

											echo '<td>' . $valeur . '</td>';
										}
										echo '</tr>';
									}
									?>
								</tbody>
							</table>

						<?php } else { ?>

							<p class="notification"><?= $message_details . 'TOOT' ?></p>

						<?php }

						?>



					</div>
				</td>
			</tr>
		</table>

	</div>




</main>