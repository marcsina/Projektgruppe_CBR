$(document).ready(function () {
	loadRandomQuestion();
});

$('#btn_next').click(function () {
	loadRandomQuestion();
	changeQuestionnumber(document.getElementById("span_QuestionNumber").innerHTML, 1); 
});

$('#btn_prev').click(function () {
	loadRandomQuestion();
	changeQuestionnumber(document.getElementById("span_QuestionNumber").innerHTML, 2);
});

function loadRandomQuestion() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("div_question").innerHTML = this.responseText;
		}
	};	
	xmlhttp.open("GET", "php/include/getQuestionText.php", true);
	xmlhttp.send();
}

function changeQuestionnumber(number, mode) {

	// Mode 1 = Next Question
	// Mode 2 = Previous Question
	if (mode == 1) {
		var newNumber = parseInt(number);
		if (newNumber < 12) {
			document.getElementById("span_QuestionNumber").innerHTML = newNumber + 1;
		}
	}
	else {
		var newNumber = parseInt(number);
		if (newNumber > 1) {
			document.getElementById("span_QuestionNumber").innerHTML = newNumber - 1;
		}
	}
	
}

