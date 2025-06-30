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

if (isset($_GET['ban'])) {
    $user_id = intval($_GET['ban']);

    $sql = "UPDATE user SET role_id = 3 WHERE user_id = $user_id";
    if ($connection->query($sql) === TRUE) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error banning user: " . $connection->error;
    }
}

if (isset($_GET['unban'])) {
    $user_id = intval($_GET['unban']);

    $sql = "UPDATE user SET role_id = 2 WHERE user_id = $user_id";
    if ($connection->query($sql) === TRUE) {
        header("Location: users.php");
        exit();
    } else {
        echo "Error unbanning user: " . $connection->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users | Neutronix</title>
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

    .users-created h3 {
        margin-top: 30px;
        font-size: 20px;
        color: #173C56;
    }

    #users p {
        padding: 6px 0;
        margin: 0;
        border-bottom: 1px solid #e5e7eb;
        color: #173C56;
    }
</style>

<body>
    <div class="content">
        <div class="control-panel">
            <h3><a href="./../index.php" target="_self" style="color: inherit;"><i class="fa fa-home"></i></a>
                Dashboard</h3>
            <ul>
                <li><a href="./posts.php" style="color: inherit;">Posts</a></li>
                <li><a href="./users.php" style="color: inherit;">Users</a></li>
            </ul>
        </div>

        <div class="display-area">
            <h2>Users</h2>

            <div class="users-created">
                <h3>Users of the Site</h3>
                <div id="users">
                    <?php
                    include "./../includes/db-connection.php"; 

                    $sql = "SELECT user.user_id, user.username, role.role_id, role.role_name FROM user JOIN role ON user.role_id = role.role_id ORDER BY user.user_id ASC"; 
                    $result = $connection->query($sql);
    
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>
                            <span style='display: inline-block; max-width: 100%; word-break: break-word; overflow-wrap: break-word;'>" . htmlspecialchars($row['username']) . "</span>";

                            if ($row['role_id'] == 3) {
                                echo "<a href='users.php?unban={$row['user_id']}' style='color: green; margin-left: 10px;' onclick='return confirm(\"Unban this user?\");'>unban</a>";
                            } else {
                                echo "<a href='users.php?ban={$row['user_id']}' style='color: red; margin-left: 10px;' onclick='return confirm(\"Ban this user?\");'>ban</a>";
                            }
                        }
                    } else {
                        echo "<p>No users found.</p>";
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