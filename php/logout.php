<?php

session_start();

// destruction des variables
unset($_SESSION['user']);
unset($_SESSION['error']);


header("Location:../index.php");
