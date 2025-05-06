<?php

require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\User;

session_start();

// Usage example
$user = new User();

if (isset($_POST['submit'])) {
    $user_info = $user->login([
        'username' => $_POST['username'],
    ]);

    if ($user_info && password_verify($_POST['password'], $user_info['password'])) {
        $_SESSION['user'] = $user_info;
        header('Location: index.php');
        exit;
    } else {
        $message = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Inline style for bold/solid buttons and form layout -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-link {
            display: inline-block;
            margin-top: 10px;
            width: 48%;
            text-align: center;
        }
    </style>
</head>

<body>
    <form method="POST" action="login.php">
        <h1>Login</h1>
        <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        
        <input type="submit" name="submit" value="Login" class="btn">

        <div style="display: flex; justify-content: space-between;">
            <a href="register.php" class="btn btn-link">Register</a>
            <a href="index.php" class="btn btn-link">Home</a>
        </div>
    </form>
</body>

</html>
