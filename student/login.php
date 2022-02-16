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
if (isset($_POST["Username"]) && isset($_POST["Password"])) {
	if (!empty($_POST["Username"]) || !empty($_POST["Password"])) { //Checks if $Username and $Password are empty.
		$Username = $_POST["Username"]; // Set $Username and $Password to the POSTed values.
		$Password = $_POST["Password"]; // Not strictly neccasary but it saves time.
		$Connection = mysqli_connect("127.0.0.1", "login", "mb42DhAVOvXDyCfw", "MathsTool"); // Can only SELECT on Students.
		if (!$Connection) {
			echo "<p class='error'>Failed to connect to the database. Please try again later</p>";
		}
		$Query = "SELECT * FROM Students WHERE UserName = '$Username'";
		$Result = mysqli_query($Connection, $Query); // Retrive the users details
		if (mysqli_num_rows($Result) == 0) {
			echo "<p class='error'>We could not find that account. Please check if the username is spelt correctly.</p>";
		}
		else {
			$Account = mysqli_fetch_assoc($Result); 	// Convert the result to an array
			$Salt = $Account["Salt"]; 					// Retrive Salt from the array
			$Hash = hash("sha512", $Password. $Salt);	// Concatenate password and salt, hash the result
			if ($Hash == $Account["PasswordHash"]) {
				session_start(['cookie_lifetime' => 86400,]); // Makes a cookie that lasts a day
				$_SESSION["Username"] = $Username;		// Save Username and Password
				$_SESSION["Password"] = $Password;
				header("Location: index.php");	// Redirect
				die();
			}
		}
	} else echo "<p class='error'>Please enter a username/password.</p>";
}
?>
<form method="post">
	Username: <br>
	<input class="TextInput" name="Username" type="text" placeholder="Username"><br>
	Password: <br>
	<input class="TextInput" name="Password" type="password" placeholder="Password"><br>
	<input class="LoginButton" type="submit" value="Submit"><br>
</form>
<a href="create.php">Create an account</a>
</div>
</body>
</html>
