<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "Lab_7");

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE matric='$matric'");
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $update = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if (mysqli_query($conn, $update)) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<h2>Edit User</h2>
<form method="POST" action="">
    <input type="hidden" name="matric" value="<?php echo $user['matric']; ?>">
    Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>
    Role:
    <select name="role" required>
        <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
        <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
    </select><br><br>
    <input type="submit" value="Update">
</form>
