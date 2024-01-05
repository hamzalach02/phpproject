<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Handle post submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    // File upload handling
    $img_path = "pic/" . basename($_FILES["img"]["name"]);
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $img_path)) {
        // Insert post into the database
        $insert_query = "INSERT INTO post (title, description, img) VALUES ('$title', '$description', '$img_path')";
        mysqli_query($con, $insert_query);

        // Redirect to prevent form resubmission
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $upload_error = "File upload failed.";
    }
}

// Fetch all posts
$select_query = "SELECT * FROM post";
$result = mysqli_query($con, $select_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: right;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .post {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <a href="logout.php" style="color: #fff; text-decoration: none;">Logout</a>
</header>

<h1>This is the index page</h1>

<!-- Form to add a new post -->
<form method="post" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="img">Image:</label>
    <input type="file" name="img" accept="image/*" required>

    <input type="submit" value="Add Post">
    <?php if(isset($upload_error)) echo "<p style='color: red;'>$upload_error</p>"; ?>
</form>

<!-- Display all posts -->
<h2>All Posts</h2>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='post'>";
    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    echo "<img src='" . htmlspecialchars($row['img']) . "' alt='Post Image'>";
    echo "</div>";
}
?>

</body>
</html>
