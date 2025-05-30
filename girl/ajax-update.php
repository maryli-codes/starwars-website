<?php
include('functions/connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['stud_id'], $_POST['fn'], $_POST['gender'], $_POST['age'])) {
        $id = (int)$_POST['stud_id'];
        $fn = mysqli_real_escape_string($conn, $_POST['fn']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = (int)$_POST['age'];

        $stmt = $conn->prepare("UPDATE personal_info SET stud_fullname=?, stud_gender=?, stud_age=? WHERE stud_id=?");
        if ($stmt === false) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]);
            exit();
        }
        $bind = $stmt->bind_param("ssii", $fn, $gender, $age, $id);
        if ($bind === false) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Bind param failed: ' . $stmt->error]);
            exit();
        }
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Record updated successfully!']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
