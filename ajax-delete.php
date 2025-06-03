<?php
include('functions/connect.php');

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM personal_info WHERE stud_id = '$id'";

    
} else {
    echo "No student ID received";
}
?>
