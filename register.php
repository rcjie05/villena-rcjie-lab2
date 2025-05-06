<?php

require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\User;

session_start();

$user = new User();

if (isset($_POST['submit'])) {
    $registered = $user->register([
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Same CSS as login page -->
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
            color: green;
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
            //SUBMIT
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
            //login/home
            display: inline-block;
            width: 45%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-link:hover {
            background-color: #0056b3;
        }

        .btn-row {
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <form method="POST" action="register.php">
        <h1>Register</h1>

        <?php if (isset($registered)): ?>
            <div class="message">You have successfully registered! You may now login.</div>
        <?php endif; ?>

        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <input type="submit" name="submit" value="Submit" class="btn">

        <div class="btn-row">
            <a href="login.php" class="btn-link">Login</a>
            <a href="index.php" class="btn-link">Home</a>
        </div>
    </form>
</body>


</html>
