<?php include 'view/header.php'; ?>
<main>
    <section>
        <div class="formContainer">
            <div class="formBox">
                <form action="index.php" method="post">
                    <h1 class="formHeading">Sign up!</h1>
                    <input type="text" name="firstname" placeholder="First Name"><br>
                    <input type="text" name="lastname" placeholder="Last Name"><br>
                    <label>Birthday:</label><br>
                    <input type="date" name="birthday"><br><br>
                    <input type="text" name="email" placeholder="Email Address"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <input type="hidden" name="action" value="register">
                    <input type="submit" class="formButton" value="Register"><br>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include 'view/footer.php'; ?>
