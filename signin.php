<?php


require "load-db.php";

session_start();



require "load-username.php";

if (!empty($_POST)) {

    require "load-db.php";


	$query = 'INSERT INTO users (username, hashed_password) VALUES (:username, :passwordHash)';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':username', htmlspecialchars(trim($_POST['username'])), PDO::PARAM_STR);
	$sth->bindValue(':passwordHash', password_hash(trim($_POST['password']), PASSWORD_BCRYPT), PDO::PARAM_STR);
	$sth->execute();



	header('Location:index.php');
	exit;
}

include 'includes/signin.phtml';