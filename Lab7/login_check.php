<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "Lab_7");

// Validate that the form was submitted correctly
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matric']) && isset($_POST['password'])) {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Query user from DB
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['matric'] = $user['matric'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "❌ Incorrect password.";
        }
    } else {
        echo "❌ Matric number not found.";
    }
} else {
    echo "⚠️ Please submit the form correctly.";
}
?>
