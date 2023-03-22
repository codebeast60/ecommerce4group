<?php
$conn = mysqli_connect('localhost', 'root', '', 'storeV3');
if (!$conn) {
    echo 'Error' . ' ' . mysqli_connect_error();
} /*else
     echo 'connected'; */