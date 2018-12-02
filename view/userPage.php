<?php include 'view/header.php'; ?>
<main>
    <section>
        <div class="formContainer">
            <div class="formBox">
                <h1 class='formHeading'>Welcome&nbsp;<?php echo $account['fname']; ?>&nbsp;<?php echo $account['lname']; ?>!</h1>
                <h2 class='formHeading whiteUnderline' id='yourQuestions'>Your questions:</h2>
                <?php $questionCounter = 1; ?>
                <?php foreach ($questions as $question) : ?>
                <h2 class='questionHeading whiteUnderline'>Question:</h2><p class='questionContent'>&nbsp;<?php echo $questionCounter; ?></p><br>
                <h2 class='questionHeading'>Title:&nbsp;</h2><p class='questionContent'><?php echo $question['title']; ?></p><br>
                <h2 class='questionHeading'>Body:&nbsp;</h2><p class='questionContent'><?php echo $question['body']; ?></p><br><br>
                <form action="index.php" method="post">
                    <input type="hidden" name="questionId" value="<?php echo $question['id']; ?>">
                    <input type="hidden" name="action" value="display_edit_question">
                    <input type="submit" value="Edit" class='formButton'>
                </form>
                <form action="index.php" method="post">
                    <input type="hidden" name="questionId" value="<?php echo $question['id']; ?>">
                    <input type="hidden" name="action" value="delete_question">
                    <input type="submit" value="Delete" class='formButton'>
                </form>
                <?php $questionCounter++; ?>
                <?php endforeach; ?>
                <form action='index.php' method='post'>
                    <input type="hidden" name="action" value="display_new_question">
                    <input type='submit' class='formButton' value='New question'><br>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include 'view/footer.php'; ?>
