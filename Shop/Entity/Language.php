<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 28.11.2018
 * Time: 13:58
 */

class Language
{
    private $language;

    public function __construct($language) {
        $this->language = $language;
    }

    public function translate($key){}
}