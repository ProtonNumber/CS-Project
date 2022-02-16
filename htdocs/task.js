function Question (Difficulty) {	// A function to create an object, because JS.
	this.Difficulty = Difficulty;
	this.Awnser = 0;
	this.Correct = 0;
	this.RecentCorrect = 0;
	this.QuestionNumber = 0;

	this.NewQuestion = NewQuestion;
	this.CheckAwnser = CheckAwnser;
}
function CheckAwnser(Submitted) {
	if (Submitted == this.Awnser) {
		this.Correct += 1;
		this.RecentCorrect +=1;
	}
	if (this.QuestionNumber % 5 == 0) { // Check how well the student is doing every 5 questions.		
		if (this.RecentCorrect > 3 && this.Difficulty < 10) {this.Difficulty++;}// If they got more than 3 right, increase the difficulty
		else if (this.RecentCorrect < 3 && this.Difficulty > 1) {this.Difficulty--;}// If they got less than 3 right, decrease the difficulty
		this.RecentCorrect = 0;					// Otherwise do nothing.
		document.getElementById("Difficulty").innerHTML = this.Difficulty;
	}
}
function OnAwnser(Task) {
	Submitted = Task.TestValid();
	if (Submitted != false) {
		Task.CheckAwnser(Submitted);
		Task.NewQuestion();
	}
}
var Task = new Question(5);
Task.NewQuestion();
document.getElementById("submit").addEventListener("click", function(){OnAwnser(Task);});
