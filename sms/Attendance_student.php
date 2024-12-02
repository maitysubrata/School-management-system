<!DOCTYPE html>
<html>
<head>
	<title>Value</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			margin: 40px;
			background-color: #f4f4f4;
		}
		table {
			position: absolute;
			left: 5%;
			top: 15%;
			border-collapse: collapse;
  			width: 90%;
		}
		th {
			text-align: center;
  			padding: 8px;
  			text-transform: uppercase;
  			background-color: #66ffcc;
		}
		td{
			text-align: center;
  			padding: 8px;
		}
		tr:nth-child(odd) {
  			background-color: #D6EEEE;
		}
		.login-btn {
        	position: absolute;
            background-color: #1a73e8;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            width: 5%;
            cursor: pointer;
            margin-bottom: 20px;
            top: 5%;
            left: 92.5%;
        }
        .login-btn:hover {
            background-color: #165cb1;
        }
        .login-btn1 {
        	position: absolute;
            background-color: #1a73e8;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            width: 5%;
            cursor: pointer;
            margin-bottom: 20px;
            top: 5%;
            left: 2.5%;
        }
        .login-btn1:hover {
            background-color: #165cb1;
        }
	</style>
</head>
<body>
<form action="homepage.html" method="post">
		<button type="submit" class="login-btn">Logout</button>
</form>
<form action="showstudent.html" method="post">
		<button type="submit" class="login-btn1">Back</button>
</form>
<table>
	<tr>
		<th>Date</th>
		<th>Attendance</th>
	</tr>
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST['email'];
	$psw=$_POST['password'];
	$stmt = $conn->prepare("SELECT * FROM student WHERE Email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
    $studentName = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentName = $row["Name"];
    }
    $stmt = $conn->prepare("SELECT date, attendance FROM student_attendance WHERE Name = ?");
    $stmt->bind_param("s", $studentName);
    $stmt->execute();
    $result = $stmt->get_result();
	// Check if any rows are returned
	if ($result->num_rows > 0) {
    	while ($row = $result->fetch_assoc()) {?>
    		<tr>
    			<td><?php echo $row["date"] ?></td>
    			<td><?php echo $row["attendance"] ?></td>
    		</tr><?php
    	}
	} else {
    	echo "0 results";
	}
}
// Close the statement and connection
$stmt->close();
$conn->close();
?>