<?php

// error reporting

ini_set('display_errors', 'On');
error_reporting(E_ALL);

include 'admin/connect.php';

$sessionUser = '';
 
if (isset($_SESSION['user'])) {
    $sessionUser = $_SESSION['user'];
     
}


$tpl   = 'include/template/';
$lang  = 'include/languages/';
$func  = 'include/functions/';
$css   = 'layout/css/';    //css directory
$js    = 'layout/js/';    //js directory



//include the important files

include $func . 'functions.php';
include $lang . 'english.php';
include $tpl  . 'header.php';
