<?php 
$GCSE = "";
$ALevel = "";
$use_errors = libxml_use_internal_errors(true);
if (file_exists("tasks/tasks.xml")) {
	$Tasks = simplexml_load_file("tasks/tasks.xml"); //Loads the file
	if ($Tasks === false) {
		$GCSE = "Something has gone horribly wrong. Please try again later.";
		$ALevel = "Something has gone horribly wrong. Please try again later.";
	} else {
		foreach ($Tasks->Task as $Task) { //Iterates through the task objects, which simpleXML puts in an array.
			if(isset($Task->ID) && isset($Task->Name) && isset($Task->Level) && isset($Task->Code)) { // Skips invalid tasks
				$ID = $Task->ID; //Assign attributes of $Task to variables, as objects can't be easily used in strings.
				$Name = $Task->Name;
				if ($Task->Level == 2) {
					$GCSE = $GCSE . "<input type='checkbox' name='Allowed[]' value='$ID'>$Name</input> <br/>";
				} elseif ($Task->Level == 3) {
					$ALevel = $ALevel . "<input type='checkbox' name='Allowed[]' value='$ID'>$Name</input> <br/>";
				}
			}
		}
	}
	unset($Task); 
} else {
	$GCSE = "Something has gone horribly wrong. Please try again later.";
	$ALevel = "Something has gone horribly wrong. Please try again later.";
}
?>
