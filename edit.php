<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';

// Mendapatkan ID dari URL
$id = $_GET['id'];

// Mengambil data yang akan diedit dari database
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Memeriksa apakah data ditemukan
if (!$row) {
    echo "Data not found!";
    exit;
}

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang di-submit dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Melakukan update data ke database
    // Jika password diisi, lakukan update termasuk password
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET name = '$name', email = '$email', password = '$hashed_password' WHERE id = $id";
    } else {
        // Jika password tidak diisi, lakukan update tanpa memperbarui password
        $query = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
    }

    $result = mysqli_query($koneksi, $query);

    // Memeriksa apakah update berhasil
    if ($result) {
        echo "Data updated successfully!";
    } else {
        echo "Error updating data: " . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
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

        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            background-color: #eee;
            border: none;
            margin-bottom: 15px;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 8px;
            outline: none;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        button {
            background-color: #512da8;
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

        button:hover {
            background-color: #4527a0;
        }

        a {
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

        a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Data</h1>
        <form action="#" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">
            <div class="btn-container">
                <button type="submit">Submit</button>
                <a href="dashboard.php">Back to Dashboard</a>
            </div>
        </form>
    </div>
</body>
</html>
