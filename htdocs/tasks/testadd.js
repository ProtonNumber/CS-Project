		NewQuestion: function() { 
			var int1 = Math.floor(Math.random() * 2^Difficulty);	// genarates two random integers, one smaller than the other.
			var int2 = Math.floor(Math.random() * 2^(Difficulty-1));	// genarates the smaller ingegrer
			Answer = int1+int2;// finds the Answer
			QuestionNumber++;	// Increments QuestionNumber
			console.log(QuestionNumber);
			document.getElementById("Question").innerHTML = "Question " + QuestionNumber + ": " + int1 + "+" + int2; //puts it in the document
		},
		TestValid: function() { //Gets and validates the Answer. Returns False if the Answer is invalid.
			var Submitted = document.getElementById("AnswerBox").value;
			if (Number.isInteger(Number(Submitted))) { // Checks if the submitted value is an int.
				return Submitted;
			}
			else {
				return false;
			}
		}
	
