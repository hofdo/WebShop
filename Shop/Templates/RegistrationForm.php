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
        <input type="text" placeholder="<?php echo $user ?>" id="registrationUsername" name="username" title="Username should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 20" required>
        <label><b><?php echo $password ?></b></label>
        <input type="password" placeholder=<?php echo $password ?> id="registrationPassword" name="password"   title="Password should only contain letters, numbers, the following characters: {-_.?!} and must not be longer than 30" required>
        <label><b>E-Mail</b></label>
        <input type="email" placeholder="E-Mail" id="registrationEmail" name="email"  title="Email-address should only contain letters, numbers and the following characters: {.,!?:;\-_}" required>
        <label><b><?php echo $first_name ?></b></label>
        <input type="text" placeholder="<?php echo $first_name ?>" id="registrationFirstName" name="firstName">
        <label><b><?php echo $last_name ?></b></label>
        <input type="text" placeholder="<?php echo $last_name ?>" id="registrationFirstLastName" name="lastName">

        <button type="submit" value="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('registration').style.display='none'" onsubmit="validateRegistration()" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>