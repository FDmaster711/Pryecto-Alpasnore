<?php
session_start();

$_SESSION = array();

session_destroy();

header("Location: /Artesania_Alpasnore/public/index.php");

exit();