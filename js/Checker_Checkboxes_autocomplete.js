function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
	/*execute a function when someone writes in the text field:*/
	inp.addEventListener("input", function (e) {
		var a, b, i, val = this.value;
		/*close any already open lists of autocompleted values*/
		closeAllLists();
		if (!val) {
			resetList();
			return false;
		}

		/*create a DIV element that will contain the items (values):*/

		/*append the DIV element as a child of the autocomplete container:*/

		/*for each item in the array...*/
		for (i = 0; i < arr.length; i++) {
			/*check if the item starts with the same letters as the text field value:*/
			if (arr[i].toUpperCase().includes(val.toUpperCase())) {
				

				const index = cbr.incomingCase.Symptoms.map(e => e.name).indexOf(arr[i]);

				$('#form_symptoms').append('<div id=' + 'div_' + cbr.incomingCase.Symptoms[index].anzeigeNummer + ' class="row symptom"><label class="col-md-11" style="word-wrap:break-word;max-width:90%">' + cbr.incomingCase.Symptoms[index].anzeigeNummer + ': ' + cbr.incomingCase.Symptoms[index].name + '</label><input class="checkboxes" type="checkbox" name="1" id=' + 'checkbox_' + cbr.incomingCase.Symptoms[index].anzeigeNummer + '></div>');
				
				if (cbr.incomingCase.Symptoms[index].wert > 0) {
					autocompleteVariableCheck = 1;
					$('#' + 'checkbox_' + cbr.incomingCase.Symptoms[index].anzeigeNummer).click();				
				}
				else {
					autocompleteVariableCheck = 0;
				}
			}		
		}

	});
	
	function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
		$('#form_symptoms').html("");
	}

	function resetList() {
		// Shows all Sympoms
		var i;
		for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
			$('#form_symptoms').append('<div id=' + 'div_' + cbr.incomingCase.Symptoms[i].anzeigeNummer + ' class="row symptom"><label class="col-md-11" style="word-wrap:break-word;max-width:90%">' + cbr.incomingCase.Symptoms[i].anzeigeNummer + ': ' + cbr.incomingCase.Symptoms[i].name + '</label><input class="checkboxes" type="checkbox" name="1" id=' + 'checkbox_' + cbr.incomingCase.Symptoms[i].anzeigeNummer + '></div>');
			if (cbr.incomingCase.Symptoms[i].wert > 0) {
				autocompleteVariableCheck = 1;
				$('#' + 'checkbox_' + cbr.incomingCase.Symptoms[i].anzeigeNummer).click();
			}
			else {
				autocompleteVariableCheck = 0;
			}
		}		
	}

} 