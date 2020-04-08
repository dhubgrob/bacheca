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

if (!empty($_POST)) {

    $query = 'UPDATE posts 
        SET title=:title,
         price=:price,
         content=:content,
        WHERE id = :id';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
    $sth->bindValue(':price', $_POST['price'], PDO::PARAM_STR);
    $sth->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
    $sth->bindValue(':id', $articleEdition['id'], PDO::PARAM_STR);
    $sth->execute();


    header('Location: http://localhost/projets/bacheca/dashboard.php');
    exit;
}



include 'includes/edit-post.phtml';
