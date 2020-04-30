<?php

require "load-db.php";
require "check-auth.php";


session_start();
var_dump($_SESSION);

//array_flip($_GET);

if (array_key_exists('id', $_GET)) {

	$query = 'DELETE FROM POSTS WHERE id = :id AND userid= :userid';
	$sth = $dbh->prepare($query);
    $sth->bindValue(':id' , $_GET['id'], PDO::PARAM_INT);
    $sth->bindValue(':userid', $_SESSION['userid'], PDO::PARAM_INT);
    $sth->execute();
	
	//Requête pas nécessaire car contrainte CASCADE ON DELETE
	/*
    $query = 'DELETE FROM IMAGES WHERE postid = ?';
	$sth = $dbh->prepare($query);
	$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
    $sth->execute();
	*/
	header('Location: http://localhost/projets/bacheca/dashboard.php');
	exit;
}
