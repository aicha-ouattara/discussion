<?php
session_start();
require ('../config/functions.php');
logout();
redirect('../index.php');
?>