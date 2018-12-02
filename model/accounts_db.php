<?php
function getUser($email, $password) {
    global $db;

    // Query database for existing user
    $query = 'SELECT email FROM accounts WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();

    if ($account['email'] === $email) {
        $query = 'SELECT email, password FROM accounts WHERE email = :email AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $account = $statement->fetch();
        $statement->closeCursor();

        if ($account['password'] === $password) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    else {
        return 'needToRegister';
    }
}

function createUser($firstName, $lastName, $birthday, $email, $password) {
    global $db;

    // Register new user
    $query = "INSERT INTO accounts (email, fname, lname, birthday, password) VALUES (:email, :firstName, :lastName, :birthday, :password)"; // Change to INSERT statement
    $statement = $db->prepare($query);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":firstName", $firstName);
    $statement->bindValue(":lastName", $lastName);
    $statement->bindValue(":birthday", $birthday);
    $statement->bindValue(":password", $password);
    $statement->execute();
    $statement->closeCursor();
}

function getName($email) {
    global $db;

    // Query database for current user information
    $query = "SELECT fname, lname FROM accounts WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $account = $statement->fetch();
    $statement->closeCursor();

    return $account;
}