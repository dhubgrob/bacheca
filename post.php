<?php

require "load-db.php";

session_start();

require "check-auth.php";

require "load-username.php";



// requête pour récupération des textes de l'article en question

$query = 'SELECT * FROM posts INNER JOIN users ON posts.userid = users.id WHERE posts.id= :id';
$sth = $dbh->prepare($query);
$sth->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
$sth->execute();
$post = $sth->fetch();

$query = 'SELECT * FROM images WHERE postid= :id';
$sth = $dbh->prepare($query);
$sth->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
$sth->execute();
$postImages = $sth->fetchAll();



include 'includes/post.phtml';