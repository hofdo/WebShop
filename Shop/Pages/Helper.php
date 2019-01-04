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

// Adds a GET parameter to the url. The url is passed by reference.
function add_param(&$url, $name, $value)
{
    $sep = strpos($url, '?') !== false ? '&' : '?';
    $url .= $sep . $name . "=" . urlencode($value);
    return $url;
}

// Renders the navigation for the passed language and page ID.
function render_leftNav($language, $pageId)
{
    $navigation = array("home", "products", "profile", "adminView");
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    foreach ($navigation as $nav) {
        $url = $urlBase;
        add_param($url, "id", $nav);
        $class = $pageId == $nav ? 'active' : 'inactive';
        if ($nav == 'home') {
            echo "<li class=\"$class\"><a href=\"$url\"><img src='../Pictures/home.png' height='14' width='14'> "
                . t($nav) . "</a></li>";
        } elseif ($nav == 'profile') {
            if ($_SESSION["logged_in"] == true) {
                echo "<li class='$class'><a href=\"$url\">" . t($nav) . "</a></li>";
            }
        } elseif ($nav == "adminView") {
            if (User::isAdmin($_SESSION["username"])) {
                echo "<div class='adminViewDropDown'><button class='adminViewBtn'>" . t("adminView") . "</button>";
                echo "<div class='adminView-content'>";
                render_adminDropDown($language, $pageId);
                echo "</div></div>";
            }
        } elseif ($nav == "products") {
            echo "<div class='productDropDown'><button class='productViewBtn'><a href=\"$url\">" . t($nav) . "</a></button>";
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
            echo "<div class='searchDropDown'><button class='searchbtn'><img src='../Pictures/search.png' height='14' width='14'></button>";
            echo "<div class='search-content'><input type='text' placeholder=" . t('searchDefault') . "></div></div>";
        } elseif ($dropDown == "searchDropDown") {
            echo "<div class='languageDropDown'><button class='languagebtn'><img src='../Pictures/translation.png' height='14' width='14'></button>";
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
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    foreach ($footerNav as $foot) {
        $url = $urlBase;
        add_param($url, "id", $foot);
        $class = $pageId == $foot ? 'active' : 'inactive';
        echo "<li><a class=\"$class\" href=\"$url\">" . t($foot) . "</a></li>";
    }
}


function render_adminDropDown($language, $pageId)
{
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    $adminDropDownNav = array("userList", "productList");
    foreach ($adminDropDownNav as $adminNav) {
        $url = $urlBase;
        add_param($url, "id", $adminNav);
        $class = $pageId == $adminNav ? 'active' : 'inactive';
        echo "<a class='$class' href=\"$url\">" . t($adminNav) . "</a>";
    };
}

function render_productsDropDown($language, $pageId)
{
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    $query = "SELECT cid FROM categories";
    $productDropDownNav = (DB::doQuery($query))->fetch_all();
    foreach ($productDropDownNav as $categories_id) {
        $categories_id = $categories_id[0];
        $query = "SELECT category FROM categories WHERE cid = $categories_id";
        $name = (DB::doQuery($query))->fetch_all();
        $url = $urlBase;
        add_param($url, "id", 'products');
        add_param($url, "categories", $categories_id);
        $class = $pageId == $categories_id ? 'active' : 'inactive';
        echo "<a class='$class' href=\"$url\">" . t($name[0][0]) . "</a>";
    };
}

// Renders the language navigation.
function render_languages($language, $pageId)
{
    $languages = array('de', 'en');
    foreach ($languages as $lang) {
        $class = $language == $lang ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"" . change_param('lang', $lang) . "\">" . strtoupper($lang) . "</a>";
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
                echo "<li><form action='../SQLDB/Logout.php' method='post'><button type='submit' value='logout' id='logoutBtn' >" . t("logout") . "</button></form></li>";
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
    $url = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    $url = $urlBase;
    add_param($url, "id", "paymentSite");
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
