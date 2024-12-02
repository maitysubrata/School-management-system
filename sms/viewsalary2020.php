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
        .login-btn_new {
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
        .login-btn_new:hover {
            background-color: #165cb1;
        }
	</style>
</head>
<body>
<table>
	<tr>
		<th>Month</th>
		<th>Salary</th>
	</tr>
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM salary2020");
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {?>
    	<tr>
    		<td><?php echo $row["month"] ?></td>
    		<td><?php echo $row["salary"] ?></td>
    	</tr><?php
    }
} else {
    echo "0 results";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
</table>
<form action="showteacher.html.html" method="post">
		<button type="submit" class="login-btn">Logout</button>
</form>
<form action="teacher_salary.html" method="post">
		<button type="submit" class="login-btn_new">Back</button>
</form>
</body>
</html>