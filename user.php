<?php


require "load-db.php";

session_start();

//require "check-auth.php";

require "load-username.php";



// requête pour récupération des articles de l'auteur

$query = 'SELECT * FROM posts WHERE userid= :id';
$sth = $dbh->prepare($query);
$sth->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
$sth->execute();
$posts = $sth->fetchAll();

include 'includes/user.phtml';
