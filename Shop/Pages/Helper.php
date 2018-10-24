<?php
// Returns a certain GET parameter or $default if the parameter
// does not exist.
function get_param($name, $default)
{
    if (isset($_GET[$name]))
        return urldecode($_GET[$name]);
    else
        return $default;
}

// Adds a GET parameter to the url. The url is passed by reference.
function add_param(&$url, $name, $value)
{
    $sep = strpos($url, '?') !== false ? '&' : '?';
    $url .= $sep . $name . "=" . urlencode($value);
    return $url;
}

// Renders the page mainContent for a certain page ID.
function render_mainContent($pageId)
{
    echo t("mainContent_$pageId");
}

// Renders the navigation for the passed language and page ID.
function render_navigation($language, $pageId)
{
    $navigation = array("home", "products");
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    foreach ($navigation as $nav) {
        $url = $urlBase;
        add_param($url, "id", $nav);
        $class = $pageId == $nav ? 'active' : 'inactive';
        if ($nav == 'home') {
            echo "<li class=\"$class\"><a href=\"$url\"><img src='../Pictures/home.png' height='14' width='14'> "
                . t($nav) . "</a></li>";
        } else {
            echo "<li class=\"$class\"><a href=\"$url\">" . t($nav) . "</a></li>";
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

// Renders the language navigation.
function render_languages($language, $pageId)
{
    $languages = array('de', 'en');
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, 'id', $pageId);
    foreach ($languages as $lang) {
        $url = $urlBase;
        $class = $language == $lang ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"" . add_param($url, 'lang', $lang) . "\">" . strtoupper($lang) . "</a>";
    }
}

// The translation function.
function t($key)
{
    global $lang_file;
    if (isset($lang_file[$key])) {
        return $lang_file[$key];
    } else {
        return "NEED TRANSLATION $key";
    }
}