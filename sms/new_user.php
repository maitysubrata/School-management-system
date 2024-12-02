<!DOCTYPE html>
<html>
<head>
	<title>New User?</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<style type="text/css">
		.box{
			position: absolute;
			background-color: white;
			top:40%;
			left: 25%;
			height: 50%;
			width: 50%;
			background: linear-gradient(to bottom, #ffffff 0%, #ffff99 100%);
			border-style: 2px solid #66ccff;
			border-radius: 12px;
			padding: 5px;
		}
		.upper{
			position: absolute;
			font-family: "Lucida Console", "Courier New", monospace;
			font-size: 24px;
			top: 20%;
			left: 32%;
		}
		.login-btn {
        	position: absolute;
            background-color: #1a73e8;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            width: 50%;
            cursor: pointer;
            margin-bottom: 20px;
            top: 70%;
            left: 25%;
        }
        .login-btn:hover {
            background-color: #165cb1;
        }
        .radio{
        	position: absolute;
        	left: 10%;
        }
        .input-group {
            margin-bottom: 35px;
            position: relative;
            text-align: left;
            left: 20%;
            top: 40%;
        }
        .input-group input {
            width: calc(70% - 40px);
            padding: 15px 15px 10px 40px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .image{
        	position: absolute;
        	top: 3%;
        	left: 43%;
        }
        .photo{
        	height: 50%;
        	width: 50%;
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
            top: 92%;
            left: 48%;
        }
        .login-btn_new:hover {
            background-color: #165cb1;
        }
	</style>
</head>
<body>
	<div class="image">
		<img src="s2.png" class="photo">
	</div>
	<form action="#" method="post">
	<div class="box">
		<div class="upper">
			Enter your Email ID<br><br><br>
		</div>
		<div class="input-group">
        	<i class="fas fa-user"></i>
        	<input type="text" placeholder="Email" name="email">
    	</div>
	<button value="submit" class="login-btn">Submit</button>
	</div>
	</form>
</body>
</html>
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST['email'];
	$stmt = $conn->prepare("SELECT Email FROM staff WHERE Email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        	?><script>alert("This mail is already exists. \nPlease login")
        		window.location.href = 'staff.html';
        	</script><?php
    	}
	} else {
    ?><script>alert("This mail doesnot exists. \nPlease contact to the authority")
        		window.location.href = 'homepage.html';
        	</script><?php
	}
	// Close the statement and connection
	$stmt->close();
}?>
<form action="staff.html" method="post">
		<button type="submit" class="login-btn_new">Back</button>
</form><?php
$conn->close();
?>