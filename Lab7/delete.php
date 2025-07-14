<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "Lab_7");

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $delete = "DELETE FROM users WHERE matric='$matric'";
    if (mysqli_query($conn, $delete)) {
        header("Location: dashboard.php");
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
