$('#btn_submit').click(function () {
	var i;
	alert("Hello");
	for (i = 0; i < 10; i++) {
		$('#section_symptoms').append('<div id=' + 'div_impairment_' + i + ' class="row"><br><div class="col-md-3 col-sm-3">' + i + '</div > <div class=" col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-7 btn-group " data-toggle="buttons"><button id=' + 'btn_klein_' + i + ' class="btn btn-info btn-sm impairmentbutton">klein</button><button id=' + 'btn_mittel_' + i + ' class="btn btn-warning btn-sm impairmentbutton">mittel</button><button id=' + 'btn_hoch_' + i + ' class="btn btn-danger btn-sm impairmentbutton">hoch</button></div> <div class=" col-md-1"> <button type="button" id=' + 'btn_close_' + i + ' class="close btn btn-info xbutton">x</button></div></div>');
	}		
});

$('#btn_start').click(function () {
	
});


