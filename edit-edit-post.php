<?php

require "load-db.php";

session_start();

require "load-username.php";

$query = 'SELECT * FROM posts WHERE id = ?';
$sth = $dbh->prepare($query);
$sth->bindValue(1, $_POST['hiddenid'], PDO::PARAM_INT);
$sth->execute();
$articleEdition = $sth->fetch();


// !! ajouter un truc du genre : if (array_key_exists('id', $_GET)) pour sécuriser !!


if (!empty($_POST)) {

$query = 'UPDATE posts 
    SET title=:title,
     price=:price,
     content=:content
    WHERE id = :id';
$sth = $dbh->prepare($query);
$sth->bindValue(':title', $_POST['product'], PDO::PARAM_STR);
$sth->bindValue(':price', $_POST['price'], PDO::PARAM_STR);
$sth->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
$sth->bindValue(':id', $_POST['hiddenid'], PDO::PARAM_INT);
$sth->execute();


header('Location: http://localhost/projets/bacheca/dashboard.php');
exit;
}