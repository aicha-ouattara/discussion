<?php
session_start();
require ('functions.php');
logout();
redirect('index.php');
?>