/**
 * function to call when button is clicked
 * @param {int} currentUserID
 * @param {int} challengedID
 */
function memberButtonClicked( currentUserID, challengedID )
{
    $.ajax(
        {
            type: "POST",
            url: 'include/functions_quiz.php',
            dataType: 'json',
            data: { functionname: 'challengeSomeone', arguments: [currentUserID, challengedID] },
            success: function () { alert( "Herausforderung gesendet" ); }
        }
    );
}