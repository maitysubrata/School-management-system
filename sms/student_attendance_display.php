<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $date = $_POST['date'];
    $attendance = $_POST['attendance'];

    // Check if the attendance record already exists
    $checkQuery = "SELECT name, class, date FROM student_attendance WHERE name = ? AND class = ? AND date = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("sss", $name, $class, $date); // Three placeholders, three arguments
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        ?><script>alert("Attendance record for this student already exists.")
        window.location.href = 'displayteacher.php';
        </script><?php
    } else {
        // If no duplicate record exists, insert the data
        $insertQuery = "INSERT INTO student_attendance (name, class, date, attendance) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ssss", $name, $class, $date, $attendance); // Four placeholders, four arguments

        if ($insertStmt->execute()) {
            ?><script>alert("Data inserted successfully!")
            window.location.href = 'student_attendance.html';
            </script><?php
        } else {
            ?><script>alert("Check the data properly ")
            window.location.href = 'student_attendance.html';
            </script><?php
            echo $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}

$conn->close();
?>
</body>
</html>