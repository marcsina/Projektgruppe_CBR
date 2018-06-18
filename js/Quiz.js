$(document).ready(function () {
	loadRandomQuestion();
	/*var allWells = $('.questionsection');
        var allWellsExceptFirst = $('.questionsection:not(:first)');
        allWellsExceptFirst.hide();
        next.click(function(e)
        {
            e.preventDefault();

            var target = 
            $('#' + target).show();
        });*/
});

$time_limit = "2018-06-11 00:10:00"
var d = new Date($time_limit);
var hours = d.getHours(); //00 hours
var minutes = d.getMinutes(); //10 minutes
var seconds = 60 * minutes; // 600seconds

if (typeof (Storage) !== "undefined") {
	if (localStorage.seconds) {
		seconds = localStorage.seconds;
	}
}

function secondPassed() {
	var minutes = Math.round((seconds - 30) / 60);
	console.log(minutes);
	var hours = Math.round((minutes) / 60);
	var remainingSeconds = seconds % 60;
	if (remainingSeconds < 10) {
		remainingSeconds = "0" + remainingSeconds;
	}

	if (typeof (Storage) !== "undefined") {
		localStorage.setItem("seconds", seconds);
	}
	document.getElementById('timer').innerHTML = minutes + ":" + remainingSeconds;
	if (minutes < 2) {
		document.getElementById('timer').style.color = "red";
	}


	if (seconds == 0) {
		clearInterval(myVar);
		document.getElementById('timer').innerHTML = "Time Out";
		$("next").click(function () {

		});
		if (typeof (Storage) !== "undefined") {
			localStorage.removeItem("seconds");
		}
	} else {
		seconds--;
		console.log(seconds);
	}

}
var myVar = setInterval(secondPassed, 1000);

$('#btn_next').click(function () {
	loadRandomQuestion(1);

});

$('#btn_prev').click(function () {
	loadRandomQuestion(2);
});

function loadRandomQuestion(mode) {

	// Aktualisert Fragenummer
	// Mode 1 = Nächste Frage
	// Mode 2 = Vorherige Frage
	if (mode == 1) {
		var newNumber = parseInt(document.getElementById("span_QuestionNumber").innerHTML);
		if (newNumber < 12) {
			document.getElementById("span_QuestionNumber").innerHTML = newNumber + 1;
		}
		else {
			return;
		}
	}
	else if (mode == 2) {
		var newNumber = parseInt(document.getElementById("span_QuestionNumber").innerHTML);
		if (newNumber > 1) {
			document.getElementById("span_QuestionNumber").innerHTML = newNumber - 1;
		}
		else {
			return;
		}
	}

	// Läd zufällige Frage aus der Datenbank
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