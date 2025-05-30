<?php
session_start();
include('ocs/connect.php');

if (isset($_POST['sub_add'])) {
    $fn = mysqli_real_escape_string($conn, $_POST['fn']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);

    $sql = "INSERT INTO personal_info (stud_fullname, stud_gender, stud_age)
            VALUES ('$fn', '$gender', '$age')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['msg'] = "New student added successfully!";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

include('template/header.php');
include('template/footer.php');
?>