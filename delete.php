<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
$id = $_GET['id'];

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Melakukan penghapusan data dari database
    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    // Memeriksa apakah penghapusan berhasil
    if ($result) {
        // Jika penghapusan berhasil, arahkan kembali ke dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error deleting data: " . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #c9d6ff;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #512da8;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .confirmation {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-container button, .btn-container a {
            flex: 1; /* Distribute the available space equally */
            margin: 0 5px; /* Add some spacing between buttons */
        }

        .btn-container button {
            background-color: #d32f2f;
            color: #fff;
            font-size: 14px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-container button:hover {
            background-color: #b71c1c;
        }

        .btn-container a {
            display: inline-block;
            text-align: center;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
            font-size: 14px;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-container a:hover {
            color: #512da8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Data</h1>
        <p class="confirmation">Are you sure you want to delete this data?</p>
        <form action="#" method="post" class="btn-container">
            <button type="submit">Yes</button>
            <a href="dashboard.php">No</a>
        </form>
    </div>
</body>
</html>
