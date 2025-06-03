<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header('location: index.php');
}

include('ocs/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System - Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color:rgb(255, 255, 255);
        background-image: url('assets/img/5.jpg');
        background-attachment: fixed;
        background-position: center;
        

    }
    td, th {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php"><span style="padding: 5px;">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#insertModal"><span style="padding: 5px;">Add User</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php"><span style="padding: 5px;">Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
