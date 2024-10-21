<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Track</title>
    <link rel="stylesheet" href="mainpage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


    <script src="mainpage.js"></script>
    <div class="header">
        <ul>
            <li><a href="mainpage.php">TASK TRACK</a></li>
        </ul>
        <ul id="reverse">
            <li><a href="create.html"><i class='bx bx-plus-circle'></i>CREATE</a></li>
            <li ><a href="calendar.html"><i class='bx bx-calendar'></i>CALENDAR</a></li>
            <li ><a href="myTasks.php"><i class='bx bx-list-ul'></i>MY TASKS</a></li>
            <li>
                <img src="me.png" alt="Rounded Image" class="rounded-img" onclick="toggleDropdown()">
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <button class="red-button" onclick="logout()">Logout</button>
                </div>
            </li>
        </ul>
    </div>
    <hr class="line">

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="1.png" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="2.png" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="3.png" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="4.png" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="5.png" class="d-block w-50" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<br><br>
    
    <div class="task-container">
        <div class="task-column">
            <h2>Pending Tasks</h2>
            <div id="pending-tasks" class="task-cards">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "tasktrack";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $pending_tasks = [];
                $result = $conn->query("SELECT * FROM user_krithika WHERE status = 'Pending'");
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $pending_tasks[] = $row;
                    }
                }

                foreach ($pending_tasks as $task): ?>
                    <div class="task-card">
                        <h3><?php echo htmlspecialchars($task['task_name']); ?></h3>
                        <p>Description: <?php echo htmlspecialchars($task['task_description']); ?></p>
                        <p>Due Date: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="task-column">
            <h2>In Progress Tasks</h2>
            <div id="in-progress-tasks" class="task-cards">
                <?php

                $in_progress_tasks = [];
                $result = $conn->query("SELECT * FROM user_krithika WHERE status = 'In Progress'");
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $in_progress_tasks[] = $row;
                    }
                }

                foreach ($in_progress_tasks as $task): ?>
                    <div class="task-card">
                        <h3><?php echo htmlspecialchars($task['task_name']); ?></h3>
                        <p>Description: <?php echo htmlspecialchars($task['task_description']); ?></p>
                        <p>Due Date: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php $conn->close();?>
</body>
</html>