<?php
include("connect.php");

function login($conn, $username, $password)
{
    $sql = "SELECT user_name FROM user_info WHERE user_name='$username' AND user_password='$password' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_name'] = $row['user_name'];
        header('location: dashboard.php');
    } else {
        echo "<h6 style='color:red; margin-top: 5%; text-align:center;'>No user found! Please try again.</h6>";
    }
}
function check_sub($conn)
{
    if (isset($_POST['sub'])) {
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
        login($conn, $user, $pwd);
    }
}


?>