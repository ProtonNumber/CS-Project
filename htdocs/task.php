<!DOCTYPE html>
<html>
<head>
<title>INSERT TITLE</title>
<link rel="image/x-icon" href="favicon.ico">
</head>
<body>
<p id="Question"></p><br>
<?php include("tasks/testadd.html") 
// Places the task's Answer box in the script
// This would be done in JS but DOM doesnt like it?>
<div id="FeedbackDiv" style="visibility: hidden">
	<p id="Feedback"></p>
	<button type="button" id="ClearFeedback" onclick="Task.NewQuestion()">Next Question</button>
</div> 
<button type="button" id="submit">Submit</button>
<script>
var Task = function () { 	//This creates the object as a singleton. This looks neater and keeps the namespace clear.
	var Difficulty = 5;		//It also lets us store variables in the functions name space, encapsulating the object.
	var Answer = 0;			//This lets us validate data inside the object.
	var Correct = 0;		//It also stops students from being able to use console.log to find the Answers. 
	var RecentCorrect = 0;
	var QuestionNumber = 0;
	
	return{
		CheckAnswer: function(Submitted) {
				if (Submitted == Answer) {
					Correct += 1;
					RecentCorrect +=1;
			}
				if (QuestionNumber % 5 == 0) { // Check how well the student is doing every 5 questions.		
					if (RecentCorrect > 3 && Difficulty < 10) {Difficulty++;}// If they got more than 3 right, increase the difficulty
					else if (RecentCorrect < 3 && Difficulty > 1) {Difficulty--;}// If they got less than 3 right, decrease the difficulty
					RecentCorrect = 0;					// Otherwise do nothing.
			}
		},
		Feedback: function(Valid, Submitted) { 
			document.getElementById("FeedbackDiv").style = "visibility: visible";
			ClearFeedback = document.getElementById("ClearFeedback") // Create variables for HTML elements that are being edited
			Feedback = document.getElementById("Feedback") 
			if (Valid) {
				ClearFeedback.innerHTML = "Next Question";
				ClearFeedback.onclick = function () {Task.ClearFeedback(Task.NewQuestion);};
				if (Submitted == Answer) {
					Feedback.innerHTML = "Thats correct! Well done!";
				}
				else if (Submitted != Answer) {
					Feedback.innerHTML = "Sorry, the correct answer is: " + Answer;
				}
			}
			else {
				ClearFeedback.innerHTML = "Okay";
				ClearFeedback.onclick = Task.HideFeedback;
				Feedback.innerHTML = Submitted + " isnt a valid Answer, Please try again.";
			}
		},
		ClearFeedback: function(run) {
			document.getElementById("FeedbackDiv").style = "visibility: hidden"; // Hides the feedback window
			run()
		},		
		<?php include("tasks/testadd.js") 
		// Places the task code in the script?>
	}
}();

function OnAnswer(Task) {
	Submitted = Task.TestValid();
	if (Submitted != false) {
		Task.CheckAnswer(Submitted);
		Task.Feedback(true, Submitted);
	}
	else {
		Task.Feedback(false, Submitted);
	}
}
Task.NewQuestion();
document.getElementById("submit").addEventListener("click", function(){OnAnswer(Task);});
</script>
</body>
</html>

