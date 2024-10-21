<?php
// Database connection details
$hostname = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "tasktrack";

// Create connection to MySQL
$conn = new mysqli($hostname, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $username = $conn->real_escape_string($_POST['username']);
    $taskname = $conn->real_escape_string($_POST['taskname']);
    $description = $conn->real_escape_string($_POST['description']);
    $duedate = $conn->real_escape_string($_POST['duedate']);
    $status = $conn->real_escape_string($_POST['status']);

    // Dynamic table name: user_<username>
    $tableName = "user_" . $username;

    // Insert task data into the user's pre-existing table
    $insertTaskSQL = "INSERT INTO `$tableName` (task_name, task_description, due_date, status) VALUES ('$taskname', '$description', '$duedate', '$status')";

    if ($conn->query($insertTaskSQL) === TRUE) {
        echo "<script>
            alert('Task created successfully for user $username.');
            window.location.href = 'mainpage.php'; // Redirect to a success page
        </script>";
    } else {
        echo "<script>
            alert('Error inserting task: " . $conn->error . "');
            window.location.href = 'create.html'; // Redirect back to the create page
        </script>";
    }
}

// Close connection
$conn->close();
?>
