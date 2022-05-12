<?php 
function connexion(){
	$dbh = new PDO(
            "mysql:dbname=mediatheque;host=localhost;port=3308",
            "root",
            "",
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
        );
	return $dbh;
}

function recup($dbh, $recherche, $premier){	//à modifier, ne pas tout sélectionner mais faire recherche précise
    $recherche = "^.*".$recherche.".*$";
    $sql = "SELECT films_id, films_titre, group_concat(DISTINCT genres_nom) AS genres_nom, group_concat(DISTINCT acteurs_nom) AS acteurs_nom, films_resume, films_annee, films_affiche, films_duree, real_nom  FROM films LEFT JOIN realisateurs ON real_id=films_real_id LEFT JOIN films_genres ON films_id=fg_films_id LEFT JOIN genres ON fg_genres_id=genres_id LEFT JOIN films_acteurs ON films_id=fa_films_id LEFT JOIN acteurs ON fa_acteurs_id=acteurs_id WHERE films_titre rlike :recherche OR genres_nom rlike :recherche OR acteurs_nom rlike :recherche OR real_nom rlike :recherche OR films_resume rlike :recherche GROUP BY films_id LIMIT :premier ,10;";
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindValue('recherche', $recherche, PDO::PARAM_STR);
    $stmt -> bindValue('premier', $premier, PDO::PARAM_INT);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab=$stmt->fetchAll();
    return $tab;	
}

function nb($dbh, $recherche){
     $recherche = "^.*".$recherche.".*$";
    $sql = "SELECT count(distinct films_id) as films_cpt FROM (films LEFT JOIN realisateurs ON real_id=films_real_id LEFT JOIN films_genres ON films_id=fg_films_id LEFT JOIN genres ON fg_genres_id=genres_id) LEFT JOIN films_acteurs ON films_id=fa_films_id LEFT JOIN acteurs ON fa_acteurs_id=acteurs_id WHERE films_titre rlike :recherche OR genres_nom rlike :recherche OR acteurs_nom rlike :recherche OR real_nom rlike :recherche OR films_resume rlike :recherche; ";
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindValue('recherche', $recherche, PDO::PARAM_STR);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $tab=$stmt->fetchAll();
    $nb = $tab[0]['films_cpt'];
    return $nb;
}

function heure($duree){
    $min = $duree%60;
    $heure = ($duree - $min)/60;
    return $heure."h".$min;
}

function genre($genres){
    
}