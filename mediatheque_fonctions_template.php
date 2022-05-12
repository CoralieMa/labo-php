<?php 
require_once("mediatheque_controleur.php");

function visualisation($tab){
	

	$i = 0;

	foreach ($tab as $row) {
		$i++;
		$titre = $row["films_titre"];
		$image  = $row["films_affiche"];
		$date = $row["films_annee"];
		$resume = $row["films_resume"];
		$duree = heure($row["films_duree"]);
		$real = $row["real_nom"];
		$genre = $row["genres_nom"];
		$acteur = $row["acteurs_nom"];

		if ($i%2 == 0){
			$couleur = "bleu";
		}
		else{
			$couleur = "rouge";
		}
		echo '<div class="'.$couleur.'">
			<div><img class="affiche" src="images_films/'.$image.'"></div>
			<div class="description">
				<h1>'.$titre.'</h1>
				<p>'.$genre.'</p>
				<p><em>Réalisateur   </em>'.$real.'</p>
				<p><em>Acteurs   </em>'.$acteur.'</p>
				<p><em>Durée   </em>'.$duree.' min</p>
				<p class="texte">'.$resume.'</p>
			</div>
			<div class="date">'.$date.'</div>
		</div>';
	}
}

?>