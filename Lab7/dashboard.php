<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "Lab_7");

// Query to fetch all users
$sql = "SELECT matric, name, role FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<style>
    table { width: 70%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #444; padding: 10px; text-align: center; }
    a { text-decoration: none; color: blue; }
</style>

<body>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <p><a href="logout.php">Logout</a></p>

    <h3>User List</h3>
    <table>
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['matric']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
            echo "<td>
                    <a href='edit.php?matric=" . $row['matric'] . "'>Edit</a> | 
                    <a href='delete.php?matric=" . $row['matric'] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
