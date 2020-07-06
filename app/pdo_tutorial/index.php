<?php

$host = 'localhost';
$user = 'admin';
$password = 'X9pjG5HEvHHa'; // 6 // It changes every time you run the Docker Image!
$dbname = 'pdo_test';

// Set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// Create PDO instance
$pdo = new PDO($dsn, $user, $password);

$status = 'admin';
$sqlQuery = 'SELECT * FROM users WHERE status = :status';
$sqlQuery = $pdo->prepare($sqlQuery);
$sqlQuery->execute(['status' => $status]);

// READ DATABASE: -----------------------------
// Way 1:
// $users = $sqlQuery->fetchAll();
// foreach($users as $user) {
//     echo $user['name'];
// }
// Way 2:
$users = $sqlQuery->fetchAll(PDO::FETCH_OBJ);
foreach($users as $user) {
    echo $user->name;
}


// INSERT TO DATABASE: ------------------------------
$name = 'Asghar Taragheh';
$email = 'assi@iri.ir';
$status = 'guest';
// $id = We set the ID Auto-Incrementing in the MySQL

$sqlQuery2 = 'INSERT INTO users(name, email, status) VALUES(:name, :email, :status)';

$sqlQuery2 = $pdo->prepare($sqlQuery2);
$sqlQuery2->execute(['name' => $name, 'email' => $email, 'status' => $status]);
echo 'User added successfully';
