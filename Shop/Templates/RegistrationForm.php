<?php
$user = t("username");
$password = t('password');
$first_name = t("firstName");
$last_name = t("lastName");
$submit = t("submit");
$cancel = t("cancel");
?>
<div id="registration" class="registration_container">
    <form class="registration_Form" action="../SQLDB/Registration.php" method="post">

        <label><b><?php echo $user ?></b></label>
        <input type="text" placeholder="<?php echo $user ?>" id="registrationUsername" name="username" pattern="^([A-Za-z0-9\-_.?!]){3,20}" title="<?php echo t("usernameVal") ?>" required>
        <label><b><?php echo $password ?></b></label>
        <input type="password" placeholder=<?php echo $password ?> id="registrationPassword" name="password"  pattern="^([A-Za-z0-9\-_.?!]){1,30}" title=<?php echo t("passwordVal") ?> required>
        <label><b>E-Mail</b></label>
        <input type="email" placeholder="E-Mail" id="registrationEmail" name="email" pattern="^([A-Za-z0-9.,!?:;\-_]+[@]{1}[A-Za-z0-9]+\.{1}[A-Za-z]{2,5})" title=<?php echo t("emailVal") ?> required>
        <label><b><?php echo $first_name ?></b></label>
        <input type="text" placeholder="<?php echo $first_name ?>" id="registrationFirstName" name="firstName">
        <label><b><?php echo $last_name ?></b></label>
        <input type="text" placeholder="<?php echo $last_name ?>" id="registrationLastName" name="lastName">

        <button type="submit" value="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('registration').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>