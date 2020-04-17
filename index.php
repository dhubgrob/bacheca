<?php

require "load-db.php";

session_start();

require "check-auth.php";

require "load-username.php";

// requête qui récupère les articles déjà publiés
$query = 'SELECT * FROM posts INNER JOIN images ON posts.id = images.postid INNER JOIN users ON posts.userid = users.id ORDER BY posts.publication_date DESC';
$sth = $dbh->prepare($query);
$sth->execute();
$allAds = $sth->fetchAll();



include 'includes/index.phtml';