<?php include 'view/header.php'; ?>
<main>
    <section>
        <div class="formContainer">
            <div class="formBox">
                <form action="index.php" method="post">
                    <h1 class="formHeading">Welcome!</h1>
                    <input type="text" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <input type="hidden" name="action" value="login">
                    <input type="submit" class="formButton" value="Log in"><br>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include 'view/footer.php'; ?>