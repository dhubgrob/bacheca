<?php





require "check-auth.php";

session_start();

require "load-db.php";

require "load-username.php";

$query = 'SELECT * FROM posts WHERE id = ?';
$sth = $dbh->prepare($query);
$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
$sth->execute();
$articleEdition = $sth->fetch();


$query = 'SELECT * FROM images WHERE postid = ?';
$sth = $dbh->prepare($query);
$sth->bindValue(1, $_GET['id'], PDO::PARAM_INT);
$sth->execute();
$articleImages = $sth->fetchAll();






include 'includes/edit-post.phtml';
