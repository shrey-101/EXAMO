<?php
session_start();
session_destroy();
header("locaion: index.php");
?>