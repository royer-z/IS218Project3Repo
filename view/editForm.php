<?php include 'view/header.php'; ?>
<main>
    <section>
        <div class='formContainer'>
            <div class='formBox'>
                <form action='index.php' method='post'>
                    <h1 class='formHeading'>Edit the question!</h1>
                    <input type='text' name='questionName' value="<?php echo $question['title']; ?>"><br>
                    <textarea name='questionBody'><?php echo $question['body']; ?></textarea><br>
                    <textarea name='questionSkills'><?php echo $question['skills']; ?></textarea><br>
                    <input type="hidden" name="questionId" value="<?php echo $question['id']; ?>">
                    <input type="hidden" name="action" value="edit_question">
                    <input type='submit' class='formButton' value='Update'><br>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include 'view/footer.php'; ?>
