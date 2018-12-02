<?php
session_start();

require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

$action = $_GET['action'];
if ($action === NULL) {
    $action = $_POST['action'];
    if ($action === NULL) {
        $action = 'display_login';
    }
}

if ($action === 'display_login') {
    include('view/loginForm.php');
}
elseif ($action === 'login') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $goodEmail = checkEmail($email);
    $goodPassword = checkPassword($password);

    if ($goodEmail[0] && $goodPassword[0]) { // If Email and Password are VALID, check if user is in database
        $userExists = getUser($email, $password);
        if ($userExists === TRUE) {
            $_SESSION['email'] = $email;
            header("Location: index.php?action=display_questions");
        }
        elseif ($userExists === FALSE){
            $error = "<p class='errorMessage'><span class='errorType'>Login error: </span><span class='errorDescription'>Incorrect email or password.</span></p>";
            include 'errors/error.php';
        }
        elseif ($userExists == 'needToRegister') {
            // Redirect to registration page
            header( "Location: index.php?action=display_registration");
        }
    }
    else { // If Email or Password is NOT VALID
        include 'errors/error.php';
    }
}
elseif ($action === 'display_registration') {
    include 'view/registrationForm.php';
}
elseif ($action === 'register') {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $goodFirst = checkFirstName($firstName);
    $goodLast = checkLastName($lastName);
    $goodBirthday = checkBirthday($birthday);
    $goodEmail = checkEmail($email);
    $goodPassword = checkPassword($password);

    if ($goodFirst[0] && $goodLast[0] && $goodBirthday[0] && $goodEmail[0] && $goodPassword[0]) {
        createUser($firstName, $lastName, $birthday, $email, $password);

        $_SESSION['email'] = $email;
        header("Location: index.php?action=display_questions");
    }
    else {
        include 'errors/error.php';
    }
}
elseif ($action === 'display_questions') {
    $email = $_SESSION['email'];

    $account = getName($email);
    $questions = getQuestions($email);

    include 'view/userPage.php';
}
elseif ($action === 'display_new_question') {
    include 'view/questionForm.php';
}
elseif ($action === 'create_new_question') {
    $email = $_SESSION['email'];

    $questionName = $_POST['questionName'];
    $questionBody = $_POST['questionBody'];
    $questionSkills = $_POST['questionSkills'];

    $goodName = checkQuestionName($questionName);
    $goodBody = checkQuestionBody($questionBody);
    $goodSkills = checkQuestionSkills($questionSkills);

    if ($goodName[0] && $goodBody[0] && $goodSkills[0]) {
        createQuestion($email, $questionName, $questionBody, $questionSkills);

        $_SESSION['email'] = $email;
        header("Location: index.php?action=display_questions");
    }
    else {
        include 'errors/error.php';
    }
}
elseif ($action === 'display_edit_question') {
    $questionId = $_POST['questionId'];

    $question = getQuestion($questionId);

    include 'view/editForm.php';
}
elseif ($action === 'edit_question') {
    $title = $_POST['questionName'];
    $body = $_POST['questionBody'];
    $skills = $_POST['questionSkills'];
    $questionId = $_POST['questionId'];

    $goodName = checkQuestionName($title);
    $goodBody = checkQuestionBody($body);
    $goodSkills = checkQuestionSkills($skills);

    if ($goodName[0] && $goodBody[0] && $goodSkills[0]) {
        editQuestion($questionId, $title, $body, $skills);

        header("Location: index.php?action=display_questions");
    }
    else {
        include 'errors/error.php';
    }
}
elseif ($action === 'delete_question') {
    $questionId = $_POST['questionId'];

    deleteQuestion($questionId);

    header("Location: index.php?action=display_questions");
}

function checkEmail($data) {
    $errorTrail = array();
    $validEmail = TRUE;
    array_push($errorTrail, $validEmail);
    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Email error: </span><span class='errorDescription'>please enter an email address.</span></p><br>");
        $errorTrail[0] = FALSE;
    }
    if (strpos($data, '@') === FALSE) {
        if (strlen($data) == 0) {
            array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Email error: </span><span class='errorDescription'>please use '@' in your email address.</span></p><br>");
            $errorTrail[0] = FALSE;
        }
        else {
            array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Email error: </span><span class='errorDescription'>please use '@' in your email address. Your entry: $data</span></p><br>");
            $errorTrail[0] = FALSE;
        }
    }
    return $errorTrail;
}
function checkPassword ($data) {
    $errorTrail = array();
    $validPassword = TRUE;
    array_push($errorTrail, $validPassword);
    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Password error: </span><span class='errorDescription'>please enter a password.</span></p><br>");
        $errorTrail[0] = FALSE;
    }
    if (strlen($data) < 8) {
        if (strlen($data) == 0) {
            array_push($errorTrail,"<p class='errorMessage'><span class='errorType'>Password error: </span><span class='errorDescription'>please enter a password that is at least 8 characters long. Your entry is ".strlen($data)." characters long.</span></p><br>");
        }
        else {
            array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Password error: </span><span class='errorDescription'>please enter a password that is at least 8 characters long. Your entry '".$data."' is ".strlen($data)." character(s) long.</span></p><br>");
        }
        $errorTrail[0] = FALSE;
    }
    return $errorTrail;
}

function checkFirstName($data) {
    $errorTrail = array();
    $validFirst = TRUE;
    array_push($errorTrail, $validFirst);

    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>First name error: </span><span class='errorDescription'>please enter your first name.</span></p><br>");
        $errorTrail[0] = FALSE;
    }

    return $errorTrail;
}

function checkLastName($data) {
    $errorTrail = array();
    $validLast = TRUE;
    array_push($errorTrail, $validLast);

    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Last name error: </span><span class='errorDescription'>please enter your last name.</span></p><br>");
        $errorTrail[0] = FALSE;
    }

    return $errorTrail;
}

function checkBirthday($data) {
    $errorTrail = array();
    $validBirthday = TRUE;
    array_push($errorTrail, $validBirthday);

    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Birthday error: </span><span class='errorDescription'>please enter your birthday.</span></p><br>");
        $errorTrail[0] = FALSE;
    }

    return $errorTrail;
}

function checkQuestionName ($data) {
    $errorTrail = array();
    $validQuestionName = TRUE;
    array_push($errorTrail, $validQuestionName);

    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Question name error: </span><span class='errorDescription'>please enter a question name.</span></p><br>");
        $errorTrail[0] = FALSE;
    }
    if (strlen($data) < 3) {
        if (strlen($data) == 0) {
            array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Question name error: </span><span class='errorDescription'>please enter a question name that is at least 3 characters long. Your entry is ".strlen($data)." characters long.</span></p><br>");
        }
        else {
            array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Question name error: </span><span class='errorDescription'>please enter a question name that is at least 3 characters long. Your entry '".$data."' is ".strlen($data)." character(s) long.</span><br>");
        }
        $errorTrail[0] = FALSE;
    }
    return $errorTrail;
}

function checkQuestionBody ($data) {
    $errorTrail = array();
    $validQuestionBody = TRUE;
    array_push($errorTrail, $validQuestionBody);

    if (empty($data)) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Question body error: </span><span class='errorDescription'>please enter a question body.</span><br>");
        $errorTrail[0] = FALSE;
    }
    if (strlen($data) >= 500) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Question body error: </span><span class='errorDescription'>please enter a question body that is less than 500 characters long. Your entry is ".strlen($data)." characters long.</span></p><br>");
        $errorTrail[0] = FALSE;
    }
    return $errorTrail;
}

function checkQuestionSkills($data) {
    $errorTrail = array();
    $validSkills = TRUE;
    array_push($errorTrail, $validSkills);

    $data = str_replace(' ', '', $data);
    $data = explode(',', $data);
    if(count($data) < 2) {
        array_push($errorTrail, "<p class='errorMessage'><span class='errorType'>Question skills error: </span><span class='errorDescription'>please enter at least 2 question skills.</span></p><br>");
        $errorTrail[0] = FALSE;
    }
    return $errorTrail;
}
