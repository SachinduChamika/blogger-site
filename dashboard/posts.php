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

<?php
include "./../includes/db-connection.php";

if (isset($_GET['delete'])) {
    $post_id = intval($_GET['delete']);

    $sql = "DELETE FROM post WHERE post_id = $post_id";
    if ($connection->query($sql) === TRUE) {
        header("Location: posts.php");
        exit();
    } else {
        echo "Error deleting post: " . $connection->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts | Neutronix</title>
    <link rel="stylesheet" href="./../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    button {
        padding: 10px 16px;
        background-color: #173C56;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 15px;
    }

    .posts-created h3 {
        margin-top: 30px;
        font-size: 20px;
        color: #173C56;
    }

    #posts p {
        padding: 6px 0;
        margin: 0;
        border-bottom: 1px solid #e5e7eb;
        color: #173C56;
    }
</style>

<body>
    <div class="content">
        <div class="control-panel">
        <h3><a href="./../index.php" target="_self" style="color: inherit;"><i class="fa fa-home"></i></a> Dashboard</h3>
            <ul>
                <li><a href="./posts.php" style="color: inherit;">Posts</a></li>
                <li><a href="./users.php" style="color: inherit;">Users</a></li>
            </ul>
        </div>

        <div class="display-area">
            <h2>Posts</h2>
            <button onclick="window.location.href='./add-post.php';">Add Post</button>

            <div class="posts-created">
                <h3>Posts Created</h3>
                <div id="posts">                
                    <?php
                    include "./../includes/db-connection.php"; 

                    $sql = "SELECT post_id, title FROM post ORDER BY post_id ASC";
                    $result = $connection->query($sql);
    
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>
                                <a href='edit-post.php?post_id={$row['post_id']}' style='display: inline-block; max-width: 100%; word-break: break-word; overflow-wrap: break-word;'>" . htmlspecialchars($row['title']) . "</a>
                                <a href='posts.php?delete={$row['post_id']}' style='color: red; margin-left: 10px;' onclick='return confirm(\"Are you sure you want to delete this post?\");'>trash</a>
                            </p>";
                        }
                    } else {
                        echo "<p>No posts found.</p>";
                    }

                    $connection->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Neutronix
    </footer>
</body>
<script>
    function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
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