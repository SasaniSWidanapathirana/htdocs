<?php 
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/user.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Load users
$userObj = new Event($db);
$users = $userObj->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Admin Screen</title>
</head>

<body class="body">
    <div>
        <a href="../../index.php">
            <img src="/public/images/logo.jpg" alt="logo image">    
        </a>    
        <button onclick="location.href='../../index.php'">Log out</button>
    </div>
    <h1 class = "h1_center">Admin Panel</h1>
   <?php include '../components/admin_menu.php'; ?>
    <h2 class = "h2_center">Current Members</h2>

     <table border="1" cellpadding="10" style="width: 80%; margin: auto; border-collapse: collapse;">
        <tr>
            <th>user_id</th>
            <th>nic</th>
            <th>email</th>
            <th>password</th>
            <th>role</th>
            <th>field Count</th>
            <th>status</th>
        </tr>

        <?php 
        // Correct PDO fetch method
        while ($row = $users->fetch(PDO::FETCH_ASSOC)) : 
        ?>
            <tr>
                <td><?= htmlspecialchars($row['user_id']); ?></td>
                <td><?= htmlspecialchars($row['nic']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['password']); ?></td>
                <td><?= htmlspecialchars($row['role']); ?></td>
                <td><?= htmlspecialchars($row['field']); ?></td>
                <td><?= htmlspecialchars($row['status']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <button onclick="location.href='add_members.html'">add new members</button>
</body>
</html>