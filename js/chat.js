var instanse = false;
var state;
var mes;
var file;
var started = 0;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
    this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "/Projektgruppe/php/include/functions_chat.php",
			   data: {  
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}

//Updates the chat
function updateChat(){
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
             url: "/Projektgruppe/php/include/functions_chat.php",
			   data: {  
			   			'function': 'update',
						'state': state,
                   'file': file,
                   'started': started
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                        }								  
                   }

                   /*
                   var scrollTop = document.getElementById( 'chat-area' ).scrollTop;
                   var scrollHeight = ( document.getElementById( 'chat-area' ) && document.getElementById( 'chat-area' ).scrollHeight ) || document.body.scrollHeight;

                   var innerHeight = $("#chat-area").innerHeight();
                   var scrolledToBottom = ( scrollTop + innerHeight + 50 ) >= scrollHeight;

                   if ( scrolledToBottom )
                   {*/
                       document.getElementById( 'chat-area' ).scrollTop = document.getElementById( 'chat-area' ).scrollHeight;
                   //}
				   instanse = false;
                   state = data.state;
                   started = 1;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//send the message
function sendChat(message, nickname)
{       
    updateChat();
     $.ajax({
		   type: "POST",
         url: "/Projektgruppe/php/include/functions_chat.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}
