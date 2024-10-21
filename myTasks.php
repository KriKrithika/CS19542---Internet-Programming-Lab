<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "tasktrack";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  task_name, task_description, due_date, status FROM user_Krithika"; // Adjust the table and column names accordingly
$result = $conn->query($sql);

$tasks = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
} else {
    echo "<p>No tasks found.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link rel="stylesheet" href="myTasks.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <script src="create.js"></script>
    <div class="header">
        <ul>
            <li><a href="mainpage.php">TASK TRACK</a></li>
        </ul>
        <ul id="reverse">
            <li><a href="create.html"><i class='bx bx-plus-circle'></i>CREATE</a></li>
            <li ><a href="calendar.html"><i class='bx bx-calendar'></i>CALENDAR</a></li>
            <li><img src="me.png" alt="Rounded Image" class="rounded-img" onclick="toggleDropdown()">
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <button class="red-button" onclick="window.location.href='homepage.html'">Logout</button>
                </div>
            </li>
        </ul>
    </div>
    <hr>
    <div class="content">
        <p class="headingg"><i class='bx bx-list-ul'></i>My Tasks</p>
        <div class="task-list">
        <?php
            if (!empty($tasks)) {
                foreach ($tasks as $task) {
                    $statusClass = '';
                    // Determine the class based on the status
                    switch ($task['status']) {
                        case 'In Progress':
                            $statusClass = 'status-yellow';
                            break;
                        case 'Completed':
                            $statusClass = 'status-green';
                            break;
                        case 'Pending':
                            $statusClass = 'status-red';
                            break;
                        default:
                            $statusClass = ''; // No special class for other statuses
                    }

                    echo '<div class="task-card">';
                    echo '<h3>' . htmlspecialchars($task["task_name"]) . '</h3>';
                    echo '<p>Description : ' . htmlspecialchars($task["task_description"]) . '</p>';
                    echo '<p>Due Date : ' . htmlspecialchars($task["due_date"]) . '</p>';
                    // Apply the class to the status div
                    echo '<p>Status : <div id="s" class="' . $statusClass . '">' . htmlspecialchars($task["status"]) . '</div></p>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
