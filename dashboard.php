<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) && !isset($_COOKIE['loggedin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_COOKIE['loggedin'])) {
    $_SESSION['loggedin'] = $_COOKIE['loggedin'];
}

// Proses logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    setcookie('loggedin', '', time() - 3600, "/"); // Hapus cookie dengan waktu yang sudah kadaluarsa
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        td.actions {
            text-align: center;
        }
        td.actions a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 3px;
            margin-right: 5px;
        }
        td.actions a:hover {
            background-color: #45a049;
        }
        .button-container {
            width: 80%;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add-button, .logout-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }
        .add-button:hover, .logout-button:hover {
            background-color: #0056b3;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'koneksi.php'; ?>
            <?php
            $query = "SELECT * FROM users";
            $result = mysqli_query($koneksi, $query);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td class='actions'>";
                echo "<a href='edit.php?id=".$row['id']."'>Edit</a>"; // Mengarahkan ke halaman edit
                echo "<a href='delete.php?id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this data?\")'>Delete</a>"; // Menampilkan konfirmasi penghapusan
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="button-container">
        <div>
            <a href="login.php?from=dashboard" class="add-button">Add Data</a>
        </div>
        <div>
            <a href="?action=logout" class="logout-button">Logout</a>
        </div>
    </div>
</body>
</html>


