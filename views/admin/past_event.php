<?php 
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/event.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Load events
$past_eventObj = new Event($db);
$past_events = $past_eventObj->getPastEvents();
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
    <h2 class = "h2_center">past events</h2>

    <table border="1" cellpadding="10" style="width: 80%; margin: auto; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date & Time</th>
            <th>Location</th>
            <th>Expected Count</th>
        </tr>

        <?php 
        // Correct PDO fetch method
        while ($row = $past_events->fetch(PDO::FETCH_ASSOC)) : 
        ?>
            <tr>
                <td><?= htmlspecialchars($row['event_id']); ?></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td>
                <td><?= htmlspecialchars($row['date_time']); ?></td>
                <td><?= htmlspecialchars($row['location']); ?></td>
                <td><?= htmlspecialchars($row['exp_cnt']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>