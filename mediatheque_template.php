<?php 
require_once("mediatheque_fonctions_template.php");
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Médiathèque cinématographique</title>
	<meta charset="utf-8">
	<script src="https://kit.fontawesome.com/f7292232a8.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<header>
		<form action="mediatheque_controleur.php" method="post" class="imagetop">
			<input type="text" name="recherche" value="" placeholder="Recherchez un film...">
			<button type="submit" name='action'><i class="fas fa-search"></i></button>
		</form>
	</header>
	<p class="menu">
		<a id="prec" href= <?php echo $lienPrec ?> >précédent</a>
		Page <?php echo $page." sur ".$nb ?>
		<a id="suiv" href= <?php echo $lienSuiv ?> >suivant</a>
	</p>
	<?php visualisation($tab) ?>
</body>
</html>