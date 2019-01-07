<?php

require_once "../autoloader.php";
require_once "../SQLDB/Session.php";


// Returns a certain GET parameter or $default if the parameter
// does not exist.
function get_param($name, $default)
{
    if (isset($_GET[$name]))
        return urldecode($_GET[$name]);
    else
        return $default;
}

// Changes one parameter of the url
function change_param($name, $value)
{
    if (isset($_GET[$name])) {
        // parse the url
        $pathInfo = parse_url($_SERVER['REQUEST_URI']);
        $queryString = $pathInfo['query'];
        // convert the query parameters to an array
        parse_str($queryString, $queryArray);
        // add the new query parameter into the array
        $queryArray[$name] = $value;
        // build the new query string
        $newQueryStr = http_build_query($queryArray);
        // construct new url
        return $url = $_SERVER['PHP_SELF'] . '?' . $newQueryStr;
    }
}

// Renders the navigation for the passed language and page ID.
function render_leftNav($language, $pageId)
{
    $navigation = array("home", "products", "profile", "adminView");
    foreach ($navigation as $nav) {
        $url ="/shop/".$language."/".$nav;
        $class = $pageId == $nav ? 'active' : 'inactive';
        if ($nav == 'home') {
            echo "<li class=\"$class\"><a href=\"$url\"><img src='/shop/Pictures/home.png' height='14' width='14'> "
                . t($nav) . "</a></li>";
        } elseif ($nav == 'profile') {
            if ($_SESSION["logged_in"] == true) {
                echo "<li class='$class'><a href=\"$url\">" . t($nav) . "</a></li>";
                echo "<div class='profileViewDropDown'><li class='profileViewBtn'>" . t("profileView") . "</li>";
                echo "<div class='profileView-content'>";
                render_profileDropDown($language, $pageId);
                echo "</div></div>";
            }
        } elseif ($nav == "adminView") {
            if (User::isAdmin($_SESSION["username"])) {
                echo "<div class='adminViewDropDown'><li class='adminViewBtn'>" . t("adminView") . "</li>";
                echo "<div class='adminView-content'>";
                render_adminDropDown($language, $pageId);
                echo "</div></div>";
            }
        } elseif ($nav == "products") {
            echo "<div class='productDropDown'><li class='productViewBtn'><a href=\"$url\">" . t($nav) . "</a></li>";
            echo "<div class='product-content'>";
            render_productsDropDown($language, $pageId);
            echo "</div></div>";
        } else {
            echo "<li class=\"$class\"><a href=\"$url\">" . t($nav) . "</a></li>";
        }
    }
}

function render_rightNav($language, $pageId)
{
    $dropDownNav = array("languageDropDown", "searchDropDown");
    foreach ($dropDownNav as $dropDown) {
        if ($dropDown == "languageDropDown") {
            echo "<div class='searchDropDown'><li class='searchbtn'><img src='/shop/Pictures/search.png' height='14' width='14'></li>";
            echo "<div class='search-content'><input type='text' placeholder=" . t('searchDefault') . "></div></div>";
        } elseif ($dropDown == "searchDropDown") {
            echo "<div class='languageDropDown'><button class='languagebtn'><img src='/shop/Pictures/translation.png' height='14' width='14'></button>";
            echo "<div class='language-content'>";
            echo render_languages($language, $pageId) . "</div></div>";
        } else {
            echo "<button></button>";
        }
    }
}

// Renders the navigation for the passed language and page ID.
function render_footer($language, $pageId)
{
    $footerNav = array("impressum", "contact", "faq", "about");
    foreach ($footerNav as $foot) {
        $url ="/shop/".$language."/".$foot;
        $class = $pageId == $foot ? 'active' : 'inactive';
        echo "<li><a class=\"$class\" href=\"$url\">" . t($foot) . "</a></li>";
    }
}


function render_adminDropDown($language, $pageId)
{
    $adminDropDownNav = array("userList", "productList");
    foreach ($adminDropDownNav as $adminNav) {
        $url ="/shop/".$language."/".$adminNav;
        $class = $pageId == $adminNav ? 'active' : 'inactive';
        echo "<a class='$class' href=\"$url\">" . t($adminNav) . "</a>";
    };
}

function render_profileDropDown($language, $pageId)
{
    $profileDropDownNav = array("profile", "orders");
    foreach ($profileDropDownNav as $profileNav) {
        $url ="/shop/".$language."/".$profileNav;
        $class = $pageId == $profileNav ? 'active' : 'inactive';
        echo "<a class='$class' href=\"$url\">" . t($profileNav) . "</a>";
    };
}

function render_productsDropDown($language, $pageId)
{
    $productDropDownNav = Product::getCategories()->fetch_all();
    foreach ($productDropDownNav as $name) {
        $name = $name[0];
        $url ="/shop/".$language."/products/".$name;
        $class = $pageId == $name ? 'active' : 'inactive';
        echo "<a class='$class' href=\"$url\">" . t($name) . "</a>";
    };
}

// Renders the language navigation.
function render_languages($language)
{
    $languages = array('de', 'en');
    foreach ($languages as $lang) {
        $url = "/shop/".$lang."/".get_param('id','home')."/".get_param('q',null);
        $class = $language == $lang ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"" . $url . "\">" . strtoupper($lang) . "</a>";
    }
}

function render_sidebar($pageId)
{
    $sidebarNav = array("loginBtn", "registrationBtn", "logoutBtn", "shoppingCartBtn");
    foreach ($sidebarNav as $sidebar) {
        if ($sidebar == "loginBtn") {
            if ($_SESSION["logged_in"] == false) {
                echo "<li><button id='loginBtn' onclick=document.getElementById('login').style.display='block'>" . t('login') . "</button></li>";
            }
        } elseif ($sidebar == "registrationBtn") {
            if ($_SESSION["logged_in"] == false) {
                echo "<li><button id='registrationBtn' onclick=document.getElementById('registration').style.display='block'>" . t('registration') . "</button></li>";
            }
        } elseif ($sidebar == "logoutBtn") {
            if ($_SESSION["logged_in"] == true) {
                echo "<li><form action='/Shop/SQLDB/Logout.php' method='post'><button type='submit' value='logout' id='logoutBtn' >" . t("logout") . "</button></form></li>";
            }
        } elseif ($sidebar == "shoppingCartBtn") {
            if ($_SESSION["logged_in"] == true) {
                echo "<li><button id='shoppingCartBtn' class='shoppingCartBtn' onclick=document.getElementById('shoppingCart').style.display='block'>" . t("shoppingCart") . "</button></li>";
            }
        } else {
            echo "<li><button id='$sidebar' class='sidebarComponent'>" . t('$sidebar') . "</button></li>";
        }
    }
}


function proceedPaymentSite($language){
    $url ="/shop/".$language."/"."paymentSite";
    echo "<a href='$url'><button type='submit'>" . t('buy') ."</button></a>";
}

// The translation function.
function t($key)
{
    global $language;
    if (file_exists("../Languages/$language.ini")) {
        $text = parse_ini_file("../Languages/$language.ini");
        if (isset($text[$key])) {
            return $text[$key];
        } else {
            return "NEED TRANSLATION $key";
        }
    } else {
        return "Not yet implemented.";
    }
}
