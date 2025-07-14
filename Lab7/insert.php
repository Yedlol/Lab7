<?php
$conn = mysqli_connect("localhost", "root", "", "Lab_7");

$matric = $_POST['matric'];
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (matric, name, password, role)
        VALUES ('$matric', '$name', '$password', '$role')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful. <a href='login.php'>Login here</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
