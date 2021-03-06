var instanse = false;
var state;
var mes;
var file;
var started = 0;

function Chat()
{
    this.update = updateChat;
    this.send = sendChat;
    this.getState = getStateOfChat;
    this.delete = deleteChat;
}

//gets the state of the chat
function getStateOfChat()
{
    if ( !instanse )
    {
        instanse = true;
        $.ajax( {
            type: "POST",
            url: "/php/include/functions_chat.php",
            data: {
                'function': 'getState',
                'file': file
            },
            dataType: "json",

            success: function ( data )
            {
                state = data.state;
                instanse = false;
            },
        } );
    }
}

//Updates the chat
function updateChat()
{
    //intended function to delete chat, to prevent the file becoming to big
    deleteChat();

    if ( !instanse )
    {
        instanse = true;
        $.ajax( {
            type: "POST",
            url: "/php/include/functions_chat.php",
            data: {
                'function': 'update',
                'state': state,
                'file': file,
                'started': started
            },
            dataType: "json",
            success: function ( data )
            {
                var scrollHeight = $( '#chat-area' )[0].scrollHeight;
                var scrollTop = $( '#chat-area' )[0].scrollTop;
                var offsetHeight = $( '#chat-area' )[0].offsetHeight;

                if ( data.text )
                {
                    for ( var i = 0; i < data.text.length; i++ )
                    {
                        $( '#chat-area' ).append( $( "<p>" + data.text[i] + "</p>" ) );
                    }
                }

                //autoscroll when scrollbar at bottom
                if ( ( scrollHeight - offsetHeight ) <= scrollTop )
                {
                    document.getElementById( 'chat-area' ).scrollTop = document.getElementById( 'chat-area' ).scrollHeight;
                }

                instanse = false;
                state = data.state;
                started = 1;
            },
        } );
    }
    else
    {
        setTimeout( updateChat, 1500 );
    }
}

//send the message
function sendChat( message, nickname )
{
    updateChat();
    $.ajax( {
        type: "POST",
        url: "/php/include/functions_chat.php",
        data: {
            'function': 'send',
            'message': message,
            'nickname': nickname,
            'file': file
        },
        dataType: "json",
        success: function ( data )
        {
            updateChat();
        },
    } );
}

function deleteChat()
{
    $.ajax( {
        type: "POST",
        url: "/php/include/functions_chat.php",
        data: {
            'function': 'getAll',
            'state': state,
            'file': file
        },
        dataType: "json",
        success: function ( data )
        {
            if ( data.text.length > 10 )
            {
                data.text.splice( 0, data.text.length - 10 );
            }


            /*----------------------------------------------------------------------------------------------------------
             * TODO
             * data.text now contains the last 10 messages
             * need to wipe the whole file and refill it with data.text
             */
            //console.log( data.text );
        },
    } );
    
    
}