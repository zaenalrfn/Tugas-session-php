<?php
ob_start();
session_start();
ob_end_clean();
$username = $_POST["username"];
$password = $_POST["password"];
if ($username == "admin" and $password == "admin") {
    $_SESSION["username"] = $username;
    header("location:form_buku.php");
} else {
    header("location:index.php?login_gagal");
}
