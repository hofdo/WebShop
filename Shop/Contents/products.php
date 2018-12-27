<?php
require_once "../SQLDB/Session.php";
require_once "../Entity/Product.php";
require_once "../Entity/DB.php";
?>

<section>
    <table>
        <tr><th>ID</th><th>Name</th><th>Kategorie</th><th>Beschreibung</th></tr>
        <?php Product::renderProductList() ?>
    </table>
</section>