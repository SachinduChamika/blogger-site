<?php
include "./includes/db-connection.php";

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
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Neutronix</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="./assets/js/main.js"></script>
    <link rel="icon" type="image/png" href="./assets/images/neutronix.png">
</head>
<style>
    .cover {
        min-height: 100vh;
        background: url('./assets/images/cover.jpg') center/cover no-repeat;
        color: #ffffff;
        text-align: center;
        padding: 100px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    h1 {
        font-size: 5rem;
        margin-bottom: 10px;
    }

    .search-bar {
        margin-top: 20px;

    }

    .search-bar input {
        width: 100%;
        max-width: 500px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #cccfff;
        font-size: 14px;
        color: #173C56;
    }
</style>

<body>
    <nav>
        <div class="neutronix-logo">
            <a href="./index.php" target="_self">
                <img src="./assets/images/neutronix.png" height="60px">
            </a>
        </div>

        <div class="nav-links">
            <a href="./index.php" target="_self">Home</a>
            <a href="./blog.php" target="_self">Blog</a>
            <a href="/contact" target="_self">Contact</a>
            <a href="./auth/login.html" target="_blank" id="auth-link">Login</a>

        </div>
    </nav>
    <section class="cover">
        <h1>Welcome to My Blog</h1>
        <p>Welcome</p>
        <div class="search-bar">
            <form method="get" action="blog.php" class="search-bar">
                <input type="text" name="query" placeholder="What are you looking for?">
            </form>
        </div>
    </section>

    <footer>
        2025 © Neutronix
    </footer>
</body>
<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    const session = getCookie("session");
    const session_id = getCookie("session_id");

    if (session && session_id) {
        const authLink = document.getElementById("auth-link");
        authLink.textContent = "Logout";
        authLink.href = "#";
        authLink.target = "_self";
        authLink.addEventListener("click", function (e) {
            e.preventDefault();
            document.cookie = "session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "session_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.reload();
        });

        if (session_id === "1") {
            const navLinks = document.querySelector(".nav-links");
            const dashboardLink = document.createElement("a");
            dashboardLink.target = "_blank"
            dashboardLink.href = "./dashboard/posts.php";
            dashboardLink.textContent = "Dashboard";
            navLinks.insertBefore(dashboardLink, authLink);
        }
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