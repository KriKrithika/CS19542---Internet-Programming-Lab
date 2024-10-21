<?php
$month = $_GET['month'];
$year = $_GET['year'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tasktrack";  // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tasks for the given month and year, including task status
$sql = "SELECT task_name, due_date, status FROM user_krithika WHERE MONTH(due_date) = ? AND YEAR(due_date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $month, $year);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

$stmt->close();
$conn->close();

// Return tasks as JSON
echo json_encode(['tasks' => $tasks]);
?>
