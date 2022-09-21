<?php
session_start();
if (isset($_SESSION["loggedin"])) {
    session_unset();
    session_destroy();
    header("location: ../");
    exit;
} else{
    header("location: ../");
  exit;
}
?>