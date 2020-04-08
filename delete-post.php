<?php

require "load-db.php";

// suppression d'article

array_flip($_GET);

if (array_key_exists('id', $_GET) and intval($_GET['id']) > 0) {

	$query = 'DELETE FROM POSTS WHERE id = ? AND userid= ?';
	$sth = $dbh->prepare($query);
    $sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
    $sth->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
    $sth->execute();
    
    $query = 'DELETE FROM IMAGES WHERE postid = ?';
	$sth = $dbh->prepare($query);
	$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
    $sth->execute();

	header('Location: http://localhost/projets/bacheca/dashboard.php');
	exit;
}
