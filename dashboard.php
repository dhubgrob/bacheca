<?php

require "load-db.php";



session_start();

//	Si l'utilisateur n'est pas authentifié
if (!array_key_exists('userid', $_SESSION)) {
	//	Redirection vers la page d'accueil
	header('Location: ./');
	exit;
}


if(!empty($_SESSION)){
// requête qui récupère le username du membre connecté
$query = 'SELECT username FROM users WHERE id= :iduser';
$sth = $dbh->prepare($query);
$sth->bindValue(':iduser', trim($_SESSION['userid']), PDO::PARAM_STR);
$sth->execute();
$usernameSession = $sth->fetch();
}

// requête qui récupère les articles déjà publiés
$query = 'SELECT title, publication_date, id FROM posts WHERE userid= :writerid';
$sth = $dbh->prepare($query);
$sth->bindValue(':writerid', $_SESSION['userid'], PDO::PARAM_STR);
$sth->execute();
$publishedAds = $sth->fetchAll();

include "includes/dashboard.phtml";