<?php

require "load-db.php";

// suppression d'image

array_flip($_GET);

if (array_key_exists('id', $_GET) and intval($_GET['id']) > 0) {
    
    $query = 'DELETE FROM IMAGES WHERE id = :id';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sth->execute();

	//header('Location: http://localhost/projets/bacheca/dashboard.php');
	//exit;
}
