<?php

require "load-db.php";

session_start();


// requête qui récupère le username du membre connecté
$query = 'SELECT username FROM users WHERE id= :iduser';
$sth = $dbh->prepare($query);
$sth->bindValue(':iduser', trim($_SESSION['userid']), PDO::PARAM_STR);
$sth->execute();
$usernameSession = $sth->fetch();



$query = 'SELECT * FROM posts WHERE id = ?';
$sth = $dbh->prepare($query);
$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
$sth->execute();
$articleEdition = $sth->fetch();

var_dump($articleEdition);


$query = 'SELECT * FROM images WHERE postid = ?';
$sth = $dbh->prepare($query);
$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
$sth->execute();
$articleImages = $sth->fetchAll();






include 'includes/edit-post.phtml';
