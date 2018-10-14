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

function render_header()
{
    echo t("header");
}

function render_footer()
{
    echo t("footer");
}

// Renders the page mainContent for a certain page ID.
function render_mainContent($pageId)
{
    echo t("mainContent_$pageId");
}

// Renders the page sideContent for a certain page ID.
function render_sideContent($pageId)
{
    echo t("sideContent_$pageId");
}

// Renders the navigation for the passed language and page ID.
function render_navigation($language, $pageId)
{
    $navigation = array("home", "products");
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);
    foreach ($navigation as $nav){
        $url = $urlBase;
        add_param($url, "id", $nav);
        $class = $pageId == $pageId ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"$url\">".t($nav);
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
    global $language;
    if (file_exists("../Languages/$language.ini")) {
        $text = parse_ini_file("../Languages/$language.ini");
        if (isset($text[$key])) {
            return $text[$key];
        } else {
            return "$key";
        }
    } else {
        echo "Not yet implemented";
    }
}
