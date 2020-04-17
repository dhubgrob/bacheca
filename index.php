<?php

require "load-db.php";

session_start();

//require "check-auth.php";

require "load-username.php";

// requête qui récupère les articles déjà publiés
$query = 'SELECT publication_date, title, price, posts.id AS postid, users.id AS userid, username, featureImg FROM posts INNER JOIN users ON posts.userid = users.id ORDER BY posts.publication_date DESC';
$sth = $dbh->prepare($query);
$sth->execute();
$allAds = $sth->fetchAll();

//var_dump($allAds);
// requête qui récupère la première image de chaque article


include 'includes/index.phtml';