<?php

//	Si l'utilisateur n'est pas authentifié
if (!array_key_exists('userid', $_SESSION)) {
	//	Redirection vers la page d'accueil
	header('Location: ./');
	exit;
}