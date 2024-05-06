<?php
function check_login() {
    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Access Denied</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body { display: flex; justify-content: center; align-items: center; height: 100vh; }
</style>
</head>
<body>
<div class="text-center">
    <h1>Access Denied</h1>
    <p>You must be logged in to view this page.</p>
    <a href="login.php" class="btn btn-primary">Login</a>
</div>
</body>
</html>';
        exit;
    }
}
function check_admin() {
    if ($_SESSION['role'] !== 'admin') {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Unauthorized Access</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body { display: flex; justify-content: center; align-items: center; height: 100vh; }
</style>
</head>
<body>
<div class="text-center">
    <h1>Unauthorized Access</h1>
    <p>Only admins are allowed to view this page.</p>
    <a href="index.php" class="btn btn-primary">Go Home</a>
</div>
</body>
</html>';
        exit;
    }
}
function check_doctor_or_admin() {
    if ($_SESSION['role'] !== 'doctor' && $_SESSION['role'] !== 'admin') {
        echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Unauthorized Access</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    body { display: flex; justify-content: center; align-items: center; height: 100vh; }
</style>
</head>
<body>
<div class="text-center">
    <h1>Unauthorized Access</h1>
    <p>Only doctors and admins are allowed to view this page.</p>
    <a href="index.php" class="btn btn-primary">Go Home</a>
</div>
</body>
</html>';
        exit;
    }
}
?>