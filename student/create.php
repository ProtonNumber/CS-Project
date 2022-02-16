<!DOCTYPE html>
<html>
<head>
<title>Maths Revison Tool</title>
<link rel="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="LoginContainer">
<?php
if (isset($_POST["Username"]) && isset($_POST["Password"]) && isset($_POST["Email"])) {
	if (!empty($_POST["Username"]) || !empty($_POST["Password"]) || !empty($_POST["Email"])) {
		if (filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) { 
			$Username = $_POST["Username"]; // Set $Username and $Password to the POSTed values.
			$Password = $_POST["Password"]; // Not strictly neccasary but it saves time.
			$Email = $_POST["Email"];
			$Connection = mysqli_connect("127.0.0.1", "create", "9tkfoh7Pgd8uwYPP", "MathsTool"); // Has read and write access on Students.
			if (!$Connection) {
				echo "<p class='error'>Failed to connect to the database. Please try again later</p>";
			}
			else { // If it can connect
				$Query = "SELECT * FROM Students WHERE UserName = '$Username'";
				$Result = mysqli_query($Connection, $Query); // Retrive the users details
				if (mysqli_num_rows($Result) == 0) {
					$Salt = bin2hex(random_bytes(8)); // Random_bytes creates cryptographically secure random bytes
					$Hash = hash("sha512", $Password.$Salt);
					$Query = "INSERT INTO Students (UserName, PasswordHash, Salt, Email) VALUES ('$Username', '$Hash', '$Salt', '$Email')";
					mysqli_query($Connection, $Query);
					header("Location: login.php");
					die();
				} else echo "<p class='error'>There is already an account with that name. Please try another</p>";
			}
		} else echo "<p class='error'>Please enter a valid email.</p>";
	} else echo "<p class='error'>All fields are required.</p>";
}
?>
<form method="post">
	Username: <br>
	<input class="TextInput" name="Username" type="text" placeholder="Username"><br>
	Email: <br>
	<input class="TextInput" name="Email" type="text" placeholder="Email"><br>
	Password: <br>
	<input class="TextInput" name="Password" type="password" placeholder="Password"><br>
	<input class="LoginButton" type="submit" value="Submit"><br>
</form>
<a href="login.php">Already have an account?</a>
</div>
</body>
</html>
