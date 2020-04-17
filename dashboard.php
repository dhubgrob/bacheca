<?php

require "load-db.php";

session_start();

require "check-auth.php";

require "load-username.php";


// requête qui récupère les articles déjà publiés
$query = 'SELECT title, publication_date, id FROM posts WHERE userid= :writerid';
$sth = $dbh->prepare($query);
$sth->bindValue(':writerid', $_SESSION['userid'], PDO::PARAM_STR);
$sth->execute();
$publishedAds = $sth->fetchAll();

include "includes/dashboard.phtml";