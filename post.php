<?php

require "load-db.php";

session_start();

require "load-username.php";



// requête pour récupération des textes de l'article en question

$query = 'SELECT * FROM posts INNER JOIN users ON users.id=posts.userid WHERE posts.id= :id';
$sth = $dbh->prepare($query);
$sth->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
$sth->execute();
$post = $sth->fetch();
var_dump($post);

$query = 'SELECT * FROM images WHERE postid= :id';
$sth = $dbh->prepare($query);
$sth->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
$sth->execute();
$postImages = $sth->fetchAll();


include 'includes/post.phtml';