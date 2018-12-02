<?php include 'view/header.php'; ?>
<main>
    <section>
        <div class='formContainer'>
            <div class='formBox'>
                <form action='index.php' method='post'>
                    <h1 class='formHeading'>Add a question!</h1>
                    <input type='text' name='questionName' placeholder='Question name'><br>
                    <textarea name='questionBody' placeholder='Question body'></textarea><br>
                    <textarea name='questionSkills' placeholder='Enter multiple skills separated by commas'></textarea><br>
                    <input type="hidden" name="action" value="create_new_question">
                    <input type='submit' class='formButton' value='Add'><br>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include 'view/footer.php'; ?>
