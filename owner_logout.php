<?php

include 'dbcon.php';

session_start();
session_unset();
session_destroy();

header('location:owner_login.php');

?>