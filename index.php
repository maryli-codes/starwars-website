<?php
include('ocs/connect.php');
session_start();
if (isset($_SESSION['user_name'])) {
    header('location: dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galactic Login - Star Wars System</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet"> <!-- Sci-fi font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
    
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background:
            linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.7)),
            url('assets/img/starwars_bg.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Orbitron', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }


        .login-container {
            max-width: 420px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px #FFD700; /* yellow glow */
            color: #FFD700; /* Star Wars yellow */
        }

        .login-container label {
            color: #FFD700;
        }

        .form-control {
            background-color: #222;
            border: 1px solid #FFD700;
            color: white;
        }

        .form-control:focus {
            background-color: #111;
            border-color: #FFDF00;
            box-shadow: 0 0 5px #FFDF00;
        }

        .btn-primary {
            background-color: #FFD700;
            border: none;
            color: black;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #e6c200;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-container">
            <h3 class="text-center mb-4">
                <img src="assets/img/rebel_logo.png" alt="Rebel Logo" style="width: 40px; vertical-align: middle; margin-right: 10px;">
                Star Wars Access Panel
            </h3>

            <form method="post">
                <div class="mb-3">
                    <label for="user" class="form-label">
                        <img src="assets/img/luke_icon.png" alt="Username Icon" style="width: 20px; vertical-align: middle; margin-right: 5px;">
                        Jedi Name
                    </label>
                    <input type="text" class="form-control" name="user" id="user" placeholder="Enter your Jedi name">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">
                        <img src="assets/img/lightsaber.png" alt="Password Icon" style="width: 20px; vertical-align: middle; margin-right: 5px;">
                        Lightsaber Code
                    </label>
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter your passcode">
                </div>
                <button type="submit" name="sub" id="sub" class="btn btn-primary w-100">
                    <i class="fa fa-sign-in"></i> Engage Hyperdrive
                </button>
            </form>
            <?php
            include('ocs/functions.php');
            check_sub($conn);
            ?>
        </div>
    </div>
</body>

<script src="assets/js/jquery-3.7.1.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

</html>
