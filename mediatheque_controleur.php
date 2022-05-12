<?php 
require_once("mediatheque_modele.php");
$recherche = "";
$premier = 0;
$page = 1;

try{
	if(isset($_GET['rch'])){
		$recherche = $_GET['rch'];
	}

	if(isset($_POST["recherche"])){
		$recherche = $_POST["recherche"];
	}

	if(isset($_GET['premier'])){
		$premier = $_GET['premier'];
	}

	if(isset($_GET['page'])){
		$page = $_GET['page'];
		if ($page < 1){
			$page = 1;
			$premier = 0;
		}
	}

	$dbh=connexion();
	$tab = recup($dbh, $recherche, $premier);
	$nb = nb($dbh, $recherche);
	$nb = ($nb - $nb%10)/10 +1;

	$premier = ($page-1)*10;
	$dernier = $page*10;

	if ($premier < 0){
		$premier = 0;
	}
	if (($page + 1) > $nb){
		$lienSuiv = "mediatheque_controleur.php?premier=".($premier)."&page=".($page)."&rch=".$recherche;
	}
	else{
		$lienSuiv = "mediatheque_controleur.php?premier=".$dernier."&page=".($page+1)."&rch=".$recherche;
	}

	$lienPrec = "mediatheque_controleur.php?premier=".($premier-10)."&page=".($page-1)."&rch=".$recherche;
	

}
catch(Exception $ex){
    	die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
    }

require_once("mediatheque_template.php");
 ?>