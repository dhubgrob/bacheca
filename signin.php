<?php

require "load-db.php";


include 'includes/signin.phtml';

session_start();


if(!empty($_SESSION)){
// requête qui récupère le username du membre connecté
$query = 'SELECT username FROM users WHERE id= :iduser';
$sth = $dbh->prepare($query);
$sth->bindValue(':iduser', trim($_SESSION['userid']), PDO::PARAM_STR);
$sth->execute();
$usernameSession = $sth->fetch();
}

if (!empty($_POST)) {

    require "load-db.php";


	$query = 'INSERT INTO users (username, hashed_password) VALUES (:username, :passwordHash)';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':username', htmlspecialchars(trim($_POST['username'])), PDO::PARAM_STR);
	$sth->bindValue(':passwordHash', password_hash(trim($_POST['password']), PASSWORD_BCRYPT), PDO::PARAM_STR);
	$sth->execute();



	//header('Location:index.php');
	//exit;
}
