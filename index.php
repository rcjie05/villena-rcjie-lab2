<?php

require_once 'vendor/autoload.php';

use Aries\Dbmodel\Models\Post;

session_start();

// Usage example
$post = new Post();

// Handle search
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$posts = $post->getPosts();

if ($searchTerm !== '') {
    $searchTermLower = strtolower($searchTerm);
    $posts = array_filter($posts, function ($postItem) use ($searchTermLower) {
        return strpos(strtolower($postItem['title']), $searchTermLower) !== false ||
               strpos(strtolower($postItem['content']), $searchTermLower) !== false;
    });
}

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
            background-color:rgb(255, 255, 255);
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #555;
        }

        a {
            text-decoration: none;
            padding: 8px 16px;
            margin-right: 10px;
            border-radius: 4px;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-danger {
            background-color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-box button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }

    </style>
</head>

<body>
    <h1>All Blog Posts</h1>

    <?php if (isset($_SESSION['user']['first_name'])): ?>
        <h2>Welcome <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="blog.php" class="btn btn-danger">Add Post</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-primary">Login</a>
    <?php endif; ?>

    <br><br>

    <div class="search-box">
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search posts..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($posts)) {
                foreach ($posts as $postItem) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($postItem['title']) . '</td>';
                    echo '<td>' . nl2br(htmlspecialchars($postItem['content'])) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="2">No posts found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>
