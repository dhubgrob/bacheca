<?php

require "load-db.php";

// suppression d'image

array_flip($_GET);

if (array_key_exists('id', $_GET)) {
    
    $query = 'DELETE FROM IMAGES WHERE id = :id';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sth->execute();

	header('Location: http://localhost/projets/bacheca/dashboard.php');
	exit;
}


if (array_key_exists('otherid', $_GET) and intval($_GET['otherid']) > 0) {

	$query = 'UPDATE posts SET featureImg=:newFeatureImg WHERE id = :id';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':newFeatureImg', 'null.jpg', PDO::PARAM_STR);
	$sth->bindValue(':id', $_GET['otherid'], PDO::PARAM_INT);
    $sth->execute();

	header('Location: http://localhost/projets/bacheca/dashboard.php');
	exit;

}