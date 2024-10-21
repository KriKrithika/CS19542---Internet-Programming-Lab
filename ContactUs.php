<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "tasktrack";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$feedbackSubmitted = false; // Flag to trigger modal

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $feedback = $conn->real_escape_string($_POST['feedback']);
    
    $sql = "INSERT INTO contact_us (user_name, email, feedback) VALUES ('$username', '$email', '$feedback')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Feedback submitted successfully!');
                window.location.href = 'homepage.html'; // Change to your home page URL
                </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
