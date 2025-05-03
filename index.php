<?php

require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\Post;

session_start();

// Usage example
$post = new Post();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #555;
        }

        li {
            list-style-type: none;
            padding: 10px;
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>All Blog Posts</h1>
    <?php if (isset($_SESSION['user']['first_name'])): ?>
        <h2>Welcome <?php echo $_SESSION['user']['first_name']; ?></h2>
        <a href="logout.php" class="btn btn-danger">Logout</a> &nbsp; &nbsp;
        <a href="blog.php" class="btn btn-danger">Add post</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-primary">Login</a>
    <?php endif; ?>

    <br>
    <br>

    <!-- <h2>Welcome <?php echo $_SESSION['user']['first_name']; ?></h2> -->
    <?php
    if (isset($_SESSION['user']['first_name'])) {
        echo $_SESSION['user']['first_name'];
    } else {
        echo '';
    }
    ?>
    <?php
    // get all users from the database and return as an array then loop it inside foreach to create a list
    $posts = $post->getPosts();
    foreach ($posts as $key => $value) {
        echo '<li>' . $value['title'] . '</li>';
    }
    ?>
</body>

</html>