<?php
function getQuestions($email) {
    global $db;

    $query = "SELECT id, title, body FROM questions WHERE owneremail = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $questions = $statement->fetchAll();
    $statement->closeCursor();

    return $questions;
}

function createQuestion($email, $questionName, $questionBody, $questionSkills) {
    global $db;

    // Insert new question
    $query = "INSERT INTO questions (owneremail, title, body, skills) VALUES (:email, :questionName, :questionBody, :questionSkills)";
    $statement = $db->prepare($query);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":questionName", $questionName);
    $statement->bindValue(":questionBody", $questionBody);
    $statement->bindValue(":questionSkills", $questionSkills);
    $statement->execute();
    $statement->closeCursor();
}

function getQuestion($questionId) {
    global $db;

    $query = "SELECT id, title, body, skills FROM questions WHERE id = :questionId";
    $statement = $db->prepare($query);
    $statement->bindValue(":questionId", $questionId);
    $statement->execute();
    $question = $statement->fetch();
    $statement->closeCursor();

    return $question;
}

function editQuestion($questionId, $title, $body, $skills) {
    global $db;

    $query = "UPDATE questions SET title = :title, body = :body, skills = :skills WHERE id = :questionId";
    $statement = $db->prepare($query);
    $statement->bindValue(":title", $title);
    $statement->bindValue(":body", $body);
    $statement->bindValue(":skills", $skills);
    $statement->bindValue(":questionId", $questionId);
    $statement->execute();
    $statement->closeCursor();
}

function deleteQuestion($questionId) {
    global $db;

    $query = "DELETE FROM questions WHERE id = :questionId";
    $statement = $db->prepare($query);
    $statement->bindValue(":questionId", $questionId);
    $statement->execute();
    $statement->closeCursor();
}