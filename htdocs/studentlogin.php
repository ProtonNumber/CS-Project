<!DOCTYPE html>
<html>
<head>
<title>Maths Revison Tool</title>
<link rel="image/x-icon" href="favicon.ico">
</head>
<body>
<div>
<?php
if (isset($_POST["username"]) && isset($_POST["password"])) {
	$Username = $_POST["username"]; // Set $Username and $Password to the POSTed values.
	$Password = $_POST["password"]; // Not strictly neccasary but it saves time.
	$Connection = mysqli_connect("127.0.0.1", "login", "mb42DhAVOvXDyCfw", "MathsTool"); // Can only SELECT on Students.
	if (!$Connection) {
		echo "<p class='error'>Failed to connect to the database. Please try again later</p>";
	}
	$Query = "SELECT * FROM Students WHERE UserName = $Username";
	$Result = mysqli_query($Connection, $Query); // Retrive the users details
	if (mysqli_num_rows($Result) == 0) {
		echo "<p class='error'>We could not find that account. Please check if the username is spelt correctly.</p>";
	}
	else {
		$Account = mysqli_fetch_assoc($Result); 	// Convert the result to an array
		$Salt = $Account["Salt"]; 					// Retrive Salt from the array
		$Hash = hash("sha512", $Password. $Salt);	// Concatenate password and salt, hash the result
		if ($Hash == $Account["PasswordHash"]) {
			session_start();
			$_SESSION["Username"] = $Username;		// Save Username and Password
			$_SESSION["Password"] = $Password;
			header("Location: studenthome.php");	// Redirect
			die();
		}
	}
}
?>
<form method="post">
	Username: <br>
	<input name="username" type="text" placeholder="Username"><br>
	Password: <br>
	<input name="password" type="password" placeholder="Password"><br>
	<input type="submit" value="submit"><br>
</form>
<a href="studentcreate.php">Create an account</a>
</div>
</body>
</html>
