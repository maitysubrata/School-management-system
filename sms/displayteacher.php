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
			border-collapse: collapse;
			width: 95%;
			font-size: 18px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			top:40%;
		}
		th {
			padding: 12px 15px;
			border: 1px solid #ddd;
			text-align: center;
		}
		td{
			padding: 12px 15px;
			border: 1px solid #ddd;
			text-align: left;
		}
		th {
			background-color: #d96459;
			color: #fff;
			text-transform: uppercase;
		}
        .login-btn1 {
        	position: absolute;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 18px;
            font-size: 16px;
            width: 80px;
            height: 35px;
            top: 50px;
            right: 345px;
        }
        /* Dropdown container */
		.dropdown, .dropdown1 {
			position: relative;
			display: inline-block;
		}
		/* Dropdown button */
		.dropdown button {
			position: absolute;
			background-color: #1a73e8;
			color: white;
			border: none;
			border-radius: 18px;
			font-size: 16px;
			width: 100px;
			right: -130px;
			top: -23px;
			height: 35px;
			cursor: pointer;
		}
		.dropdown1 button {
			position: absolute;
			background-color: #1a73e8;
			color: white;
			border: none;
			border-radius: 18px;
			font-size: 16px;
			width: 90px;
			right: -165px;
			top: -23px;
			height: 35px;
			cursor: pointer;
		}
		/* Dropdown content (hidden by default) */
		.dropdown-content, .dropdown-content1 {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
		}
		/* Links inside the dropdown */
		.dropdown-content a, .dropdown-content1 a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
		}
		/* Show the dropdown menu on hover */
		.dropdown:hover .dropdown-content, .dropdown1:hover .dropdown-content1 {
			display: block;
		}
		/* Change color of dropdown links on hover */
		.dropdown-content a:hover, .dropdown-content1 a:hover {
			background-color: #1a73e8;
			color: white;
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
            top: 30%;
            left: 92.5%;
        }
        .login-btn:hover {
            background-color: #165cb1;
        }
        .login-btn_new {
        	position: absolute;
            background-color: #009999;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            width: 20%;
            cursor: pointer;
            margin-bottom: 20px;
            top: 65%;
            left: 40%;
        }
        .login-btn_new:hover {
            background-color: #165cb1;
        }
	</style>
</head>
<body>
<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Username</th>
		<th>Address</th>
		<th>Date of Birth</th>
		<th>Date of Join</th>
	</tr>
<?php
session_start();
$conn=new mysqli("localhost","root","","sms");
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST['email'];
	$psw=$_POST['password'];
	//echo "Email is : ".$email." and Password is : ".$psw;
	$stmt = $conn->prepare("SELECT Email, Name, Username,Address,dob,doj FROM teacher WHERE Email = ?");
    $stmt->bind_param("s", $email); // "s" specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Output data of each row
        //echo "<table>";
        while ($row = $result->fetch_assoc()) {?>
        	<tr>
        		<td><?php echo $row["Name"]; ?></td>
        		<td><?php echo $row["Email"]; ?></td>
        		<td><?php echo $row["Username"]; ?> </td>
        		<td><?php echo $row["Address"]; ?></td>
        		<td><?php echo $row["dob"]; ?></td>
        		<td><?php echo $row["doj"]; ?></td>
           	</tr>
 		<?php
        }
    } else {
        echo "0 results";
    }
    // Close the statement and connection
    $stmt->close();
}
$conn->close();
?>
</table>
<form action="showteacher.html" method="post">
		<button type="submit" class="login-btn">Logout</button>
</form>
</body>
</html>