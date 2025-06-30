<?php
include "./../includes/db-connection.php";

$bannedUsers = array();
$sql = "SELECT username FROM user WHERE role_id = 3";  
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bannedUsers[] = $row['username'];
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Post | Neutronix</title>
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/ui/trumbowyg.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/trumbowyg.min.js"></script>
    <script src="./../assets/js/main.js"></script>
    <link rel="icon" type="image/png" href="./../assets/images/neutronix.png">
</head>

<style>
    .content {
        display: flex;
        width: 100%;
        min-height: calc(100vh - 80px);
    }

    .control-panel {
        width: 280px;
        background-color: #173C56;
        color: #ffffff;
        padding: 30px 20px;
    }

    .control-panel h3 {
        margin-bottom: 20px;
        color: #ffffff;
    }

    .control-panel ul {
        list-style: none;
        padding: 0;
    }

    .control-panel li {
        margin-bottom: 15px;
        cursor: pointer;
    }

    .display-area {
        flex: 1;
        padding: 30px;
        background-color: #ffffff;
    }

    .display-area h2 {
        font-size: 28px;
        margin-bottom: 15px;
        color: #173C56;
    }

    .add-post-box {
        background-color: #ffffff;
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .add-post-box p {
        margin-bottom: 5px;
        font-size: 20px;
        color: #173C56;
    }

    .add-post-box input[type="text"],
    .add-post-box input[type="url"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #cccfff;
        font-size: 14px;
        color: #173C56;
    }

    .keywords {
        display: flex;
        justify-content: space-between;
    }

    .keywords input {
        width: 30%;
        padding: 10px;
        margin-bottom: 15px;
        margin-right: 10px;
        border-radius: 5px;
        border: 1px solid #cccfff;
        font-size: 14px;
        color: #173C56;
    }

    .keywords input:last-child {
        margin-right: 0;
    }

    .options {
        display: inline-block;
        color: #173C56;
        font-size: 15px;
    }

    input[type="submit"] {
        padding: 10px 16px;
        background-color: #173C56;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 15px;
    }
</style>

<body>
    <div class="content">
        <div class="control-panel">
            <h3><a href="./../index.php" target="_self"><i class="fa fa-home"></i></a> Dashboard</h3>
            <ul>
                <li><a href="./posts.php">Posts</a></li>
                <li><a href="./users.php">Users</a></li>
            </ul>
        </div>

        <div class="display-area">
            <h2>Add New Post</h2>
            <div class="add-post-box">
                <form action="" method="post">
                    <p>Title</p>
                    <input type="text" name="title" placeholder="How to Build a REST API with Flask" required>

                    <p>Description</p>
                    <input type="text" name="description" placeholder="Step-by-step guide to creating a RESTful API in Python" required>

                    <p>Keywords</p>
                    <div class="keywords">
                        <input type="text" name="keyword1" placeholder="Python API development" required>
                        <input type="text" name="keyword2" placeholder="RESTful services" required>
                        <input type="text" name="keyword3" placeholder="Flask tutorial" required>
                    </div>

                    <p>Featured Image URL (Make sure its valid)</p>
                    <input type="url" name="featured-image-url" placeholder="https://example.com/image.jpg" required>

                    <p>Content</p>
                    <textarea id="content" name="content" placeholder="Creating a REST API with Flask involves setting up routes, handling requests, and returning JSON responses..."></textarea><br>

                    <p>Status</p>
                    <div class="options">
                        <input type="radio" name="status" value="published" checked required>
                        Published&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="archived" required> Archived
                    </div><br><br>
                    <input type="hidden" name="author" id="author">

                    <input type="submit" value="Publish">
                </form>
                
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    include "./../includes/db-connection.php";

                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $keyword1 = $_POST['keyword1'];
                    $keyword2 = $_POST['keyword2'];
                    $keyword3 = $_POST['keyword3'];
                    $content = $_POST['content'];
                    $featured_image_url = $_POST['featured-image-url'];
                    $status = $_POST['status'];
                    $author = $_POST['author']; 

                    $sql = "INSERT INTO post (title, description, keyword1, keyword2, keyword3, featured_image_url, content, status, author) VALUES ('$title', '$description', '$keyword1', '$keyword2', '$keyword3', '$featured_image_url', '$content', '$status', '$author')";

                    if ($connection->query($sql) === TRUE) {
                        header("Location: ./posts.php");
                        exit();
                    } else {
                        echo "<script>alert('Database Error: $error_message'";
                    }
                    $connection->close();
                }   
                ?>
                
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Neutronix
    </footer>
</body>
<script>
    $(document).ready(function () {
        $('#content').trumbowyg();
    });
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    const sessionName = getCookie("session");
    if (sessionName) {
        document.getElementById("author").value = sessionName;
    }

    if (getCookie("session_id") !== "1") {
        document.body.innerHTML = `
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; background-color: #f5f7fa; font-family: sans-serif; color: #2c3e50;">
                <h1 style="font-size: 48px; margin-bottom: 10px; color: #000000;">🚫 Access Denied</h1>
                <p style="font-size: 20px; color: #7f8c8d;">You do not have permission to view this page.</p>
            </div>
        `;
    }

        const bannedUsers = <?php echo json_encode($bannedUsers);?>;

    const sessionName = getCookie("session");

    if (bannedUsers.includes(sessionName)) {
        document.body.innerHTML = `
      <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; background-color: #f5f7fa; font-family: sans-serif; color: #2c3e50;">
          <h1 style="font-size: 48px; margin-bottom: 10px; color: #000000;">🚫 Access Denied</h1>
          <p style="font-size: 20px; color: #7f8c8d;">Your account has been banned and you do not have permission to access this page.</p>
      </div>
    `;
    }

</script>

</html>