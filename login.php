<?php

require_once('koneksi.php');

if(isset($_GET['from']) && $_GET['from'] === 'dashboard') {
    $notification_message = "Please sign up for adding data";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$username' AND password = '$password'");

    if (mysqli_num_rows($query) != 0) {
        // Set session variable
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect to dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Username atau password salah";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <?php if(isset($notification_message)): ?>
        <div class="notification">
            <?php echo $notification_message; ?>
        </div>
    <?php endif; ?>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="<?= 'register.php' ?>">
                <h1>Create Account</h1>
                <span>or use your email for registeration</span>
                <input type="username" name="username" placeholder="Name">
                <input type="email" name="email"placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="<?= 'process_login.php' ?>">
                <h1>Sign In</h1>
                <div class="social-icons">
                </div>
                <span>or use your email password</span>
                <input type="email" name="email"placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>