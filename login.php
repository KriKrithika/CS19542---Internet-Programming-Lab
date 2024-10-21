<?php
$hostname = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "tasktrack";

$conn = new mysqli($hostname, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$successURL = 'mainpage.php';
$errorURL = 'login.html';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    
    // Check if the username and password are correct
    $sql = "SELECT * FROM user_details WHERE user_name='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $message = "Login successful!";
        // Redirect with JavaScript alert for success
        echo "<script>
            alert('$message');
            window.location.href = '$successURL';
        </script>";
    } else {
        $message = "Error: Invalid username or password.";
        // Redirect with JavaScript alert for error
        echo "<script>
            alert('$message');
            window.location.href='$errorURL';
        </script>";
    }
}

$conn->close();
?>
