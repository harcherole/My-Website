<?php

$authoized_languages = ['fr', 'en'];

if(!empty($_GET['lang']) && in_array($_GET['lang'], $authoized_languages)){
    $_SESSION['locale'] = $_GET['lang'];
}else{
    if(empty($_SESSION['locale'])){
        $_SESSION['locale'] = $authoized_languages[0];
    }
    
}

require 'locales/menu.php';
require 'locales/long_text.php';