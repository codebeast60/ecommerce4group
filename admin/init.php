<?php

include 'connect.php';


$tpl   = 'include/template/';
$lang  = 'include/languages/';
$func  = 'include/functions/';
$css   = 'layout/css/';    //css directory
$js    = 'layout/js/';    //js directory



//include the important files

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl  . 'header.php';

//include navbar on all pages except the one with $nonavBar variable

if (!isset($noNavbar)) {
    include $tpl . 'navbar.php'; 
}
