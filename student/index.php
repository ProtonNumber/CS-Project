<!DOCTYPE html>
<?php include("verifyaccount.php") ?>
<?php include("formfromXML.php") ?>
<?php $t = time(); // Used to force the browser to load task from the server, rather than cache?>
<html>
<head>
<title><?php echo "$Username's Homepage" ?></title>
<link rel="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="../style.css">
<script>
function LevelToggle(On, Off) {
	document.getElementById(On).style.display = "block";
	document.getElementById(Off).style.display = "none";
	document.getElementById("ToggleGCSE").setAttribute("onClick", "LevelToggle('"+Off+"','"+On+"')");
	document.getElementById("ToggleA-Level").setAttribute("onClick", "LevelToggle('"+Off+"','"+On+"')");
	document.getElementById("Toggle"+On).setAttribute("class", "LoginButton");
	document.getElementById("Toggle"+Off).setAttribute("class", "LoginButtonDisabled");
}
</script>
</head>
<body>
<div class="Centre">
	<div class="Nav">
		<ul>
			<li><a class="NavButton">Homework</a></li>
			<li><a class="NavButton">Results</a></li>
			<li><a class="NavButton">Logout</a></li>
		<ul>
	</div>
	<div class="ContentTall">
		<div class="LHS">
			<p style="margin-top:0px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<div class="TaskSelect">
			<button class="LoginButton" onclick="LevelToggle('GCSE', 'A-Level')" id="ToggleGCSE">GCSE</button><button class="LoginButton" onclick="LevelToggle('GCSE', 'A-Level')" id="ToggleA-Level">A-Level</button>
			<form method="post" action=<?php echo "task.php?time".$t?>>
				<div class="ButtonHolder" id="GCSE" style="display:none">
					<?php echo $GCSE?>
				</div>
				<div class="ButtonHolder" id="A-Level" style="display:block">
					<?php echo $ALevel?>
				</div>
				<input class="LoginButton" type="submit" value="Go!">
			</form>
		</div>
	</div>
</div>
</body>
</html>
