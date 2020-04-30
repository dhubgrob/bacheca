<?php




if (!empty($_POST)) {

	require "load-db.php";

		session_start();

	$query = 'SELECT id, username, hashed_password FROM users WHERE username = :username';
	$sth = $dbh->prepare($query);
	$sth->bindValue(':username', htmlspecialchars(trim($_POST['username'])), PDO::PARAM_STR);
	$sth->execute();
	$user = $sth->fetch();


	//	Si l'authentification est réussie…
	if ($user !== false and password_verify(trim($_POST['password']), $user['hashed_password'])) {
		session_start();

		$_SESSION['userid'] = intval($user['id']);

		//	Redirection vers la page privée
		header('Location: ./dashboard.php');
		exit;
	}
	//	Sinon…
	else {
		//	Redirection vers la page login
		header('Location: ./login.php');
		exit;
	}
}

include 'includes/login.phtml';
