<?php include 'view/header.php'; ?>
<main>
    <section>
        <div class="formContainer">
            <div class="formBox">
                <h1>Errors</h1>
                <p><?php echo $error; ?></p>
                <p><?php if (count($goodEmail) > 1) {foreach($goodEmail as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodPassword) > 1) {foreach($goodPassword as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodFirst) > 1) {foreach($goodFirst as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodLast) > 1) {foreach($goodLast as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodBirthday) > 1) {foreach($goodBirthday as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodName) > 1) {foreach($goodName as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodBody) > 1) {foreach($goodBody as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p><?php if (count($goodSkills) > 1) {foreach($goodSkills as $message) {if ($message !== 'TRUE' && $message !== 'FALSE') {echo $message;}}} ?></p>
                <p class='errorMessage'>Please go back and retry.</p>
            </div>
        </div>
    </section>
</main>
<?php include 'view/footer.php'; ?>