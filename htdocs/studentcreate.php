<!DOCTYPE html>
<html>
<head>
<title>Maths Revison Tool</title>
<link rel="image/x-icon" href="favicon.ico">
</head>
<body>
<div>
<?php
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
	$Username = $_POST["username"]; // Set $Username and $Password to the POSTed values.
	$Password = $_POST["password"]; // Not strictly neccasary but it saves time.
	$Email = $_POST["email"];
	$Connection = mysqli_connect("127.0.0.1", "create", "9tkfoh7Pgd8uwYPP", "MathsTool"); // Has read and write access on Students.
	if (!$Connection) {
		echo "<p class='error'>Failed to connect to the database. Please try again later</p>";
	}
	else { // If it can connect
		$Query = "SELECT * FROM Students WHERE UserName = $Username";
		$Result = mysqli_query($Connection, $Query); // Retrive the users details
		if (mysqli_num_rows($Result) == 0) {
			$Salt = random_bytes(8); // Random_bytes creates cryptographically secure random bytes
			$Hash = hash("sha512", $Password.$Salt);
			$Query = "INSERT INTO Students (UserName, PasswordHash, Salt, Email) VALUES ($Username, $Hash, $Salt, $Email)";
			mysqli_query($Connection, $Query);
			header("Location: studentlogin.php");	// Redirect
			die();
		}
		else {
			echo "<p class='error'>There is already an account with that name. Please try another</p>";
		}
	}
}
?>
<form method="post">
	Username: <br>
	<input name="username" type="text" placeholder="Username"><br>
	Email: <br>
	<input name="email" type="text" placeholder="Email"><br>
	Password: <br>
	<input name="password" type="password" placeholder="Password"><br>
	<input type="submit" value="submit"><br>
</form>
<a href="studentcreate.php">Create an account</a>
</div>
</body>
</html>
