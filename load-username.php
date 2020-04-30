<?php

if(!empty($_SESSION)){
$query = 'SELECT username FROM users WHERE id= :iduser';
$sth = $dbh->prepare($query);
$sth->bindValue(':iduser', $_SESSION['userid'], PDO::PARAM_INT);
$sth->execute();
$usernameSession = $sth->fetch();
}