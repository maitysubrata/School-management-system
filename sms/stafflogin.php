<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
session_start();
$conn=new mysqli("localhost","root","","sms");
if($conn->connect_error){
	die("Connection failed: ".$conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST['email'];
	$stmt = $conn->prepare("SELECT Email, Name, Username, Salary FROM staff WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {?>
        	<script>
    			function showAlert() {
        		alert("This mail is already registered!");
    		}
			</script>
        	<?php
        }
    } else 
    {
        echo "0 results";
    }
    // Close the statement and connection
    $stmt->close();
}
$conn->close();
?>
</body>
</html>