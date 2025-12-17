<?php 
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/event.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Load events
$eventObj = new Event($db);
$events = $eventObj->getAllEvents();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/htdocs/public/js/addEvent.js"></script>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <title>Admin Panel</title>
</head>

<body class="admin-body">

    <!-- Side Navigation -->
    <?php include '../components/sidenav.php'; ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Bar -->
        <?php include '../components/topbar.php'; ?>

        <!-- Main Content -->
        <main class="content">

            <div class="div">
                <div class="div create-event-bar">
                <button id="openPanelBtn" class="create-btn">
                    <span class="material-symbols-rounded">add_2</span>
                    Create Event
                </button>
                </div>

                <div id="sidePanel" class="side-panel">
                    <button id="closePanelBtn" class="close-btn">
                        <span class="material-symbols-rounded">close</span>
                    </button>

                    <h3 class="createFormTitle">
                        <span class="material-symbols-rounded">add_2</span>
                        Create Event
                    </h3>

                    <form id="eventForm" method="POST" action="add_event.php">
                        <label>Name</label>
                        <input type="text" name="eventName" required>

                        <label>Date</label>
                        <input type="date" name="eventDate" required>

                        <label>Time</label>
                        <input type="time" name="eventTime" required>

                        <label>Location</label>
                        <input type="text" name="location" required>

                        <label>Participant Count</label>
                        <input type="number" name="count" min="1" required>

                        <label>Description</label>
                        <textarea name="eventDescription"></textarea>

                        <button type="submit">Create</button>
                    </form>
                </div>
            </div>

            <div class="event-table-wrapper">
                <table class="event-table">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Expected Count</th>
                        <th>Actions</th>
                    </tr>

                    <?php while ($row = $events->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['title']); ?></td>
                            <td><?= htmlspecialchars($row['description']); ?></td>
                            <td><?= htmlspecialchars($row['date_time']); ?></td>
                            <td><?= htmlspecialchars($row['location']); ?></td>
                            <td><?= htmlspecialchars($row['exp_cnt']); ?></td>
                            <td class="action-cell">
                                <a class="action-btn edit" href="edit_event.php?id=<?= urlencode($row['event_id']); ?>" title="Edit">
                                    <span class="material-symbols-rounded">edit</span>
                                </a>
                                <a class="action-btn delete" href="delete_event.php?id=<?= urlencode($row['event_id']); ?>" title="Delete" onclick="return confirm('Delete this event?');">
                                    <span class="material-symbols-rounded">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

        </main>
    </div>

</body>
