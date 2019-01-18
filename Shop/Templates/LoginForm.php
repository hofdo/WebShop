<?php
$user = t("username");
$password = t('password');
$submit = t("submit");
$cancel = t("cancel");
?>
<div id="login" class="login_container">
    <form class="login_Form" action="/shop/SQLDB/Login.php" method="post">
        <label><b><?php echo $user ?></b></label>
        <input type="text" name="username"
        <?php
        if (isset($_COOKIE["username"])){echo "value=" . $_COOKIE["username"];
        }
        else{
            echo "placeholder=" . $user;
        }
        ?>
        >
        <label><b><?php echo $password ?></b></label>
        <input type="password" name="password" placeholder=<?php echo $password ?>>

        <label class="cookieLabel"><?php echo t("useCookie")?></label>
        <input type="checkbox" name="cookieCheckbox">

        <button type="submit" value="submit"><?php echo $submit ?></button>
        <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancel_Btn">
            <?php echo $cancel ?>
        </button>
    </form>
</div>
