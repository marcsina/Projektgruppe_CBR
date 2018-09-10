<?php

include_once 'conn.php';
include_once 'functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';

}

?>


<html>

<head>
    <link rel="stylesheet" href="/css/style_chat.css" type="text/css" />
</head>

<!--chat.start()-->

<body onload="setInterval('chat.update()', 1000);">


    <span class="Chat_Button" onclick="openNav()">Chat &#9776; </span>

    <div id="mySidenav" class="sidenav">
        <label id="Label_Header">
            MedChat
        </label>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div id="page-wrap">

            <div id="chat-wrap">
                <div id="chat-area"></div>
            </div>

            <form id="send-message-area">
                <p>Schreibe eine Nachricht: </p>
                <textarea id="sendie" maxlength='100'></textarea>
            </form>

        </div>

    </div>



</body>

</html>

<script>

    //store the chat-show status
    var opened = 0;

    //If the Chat was opened before than this method will be called
    function showChatStart() {
        document.getElementById("mySidenav").style.height = "55%";
        //store the status in a local variable
        opened = 1;
    }

    //Show the chat and store it in a local and a session variable
    function openNav() {
        if (opened == 0) {
            document.getElementById("mySidenav").style.height = "55%";
            opened = 1;
            sessionStorage.setItem('ChatShow', '1');
        }
        else {
            closeNav();
        }
    }

    //Close the chat and store it in session and local
    function closeNav() {
        document.getElementById("mySidenav").style.height = "0%";
        opened = 0;
        sessionStorage.setItem('ChatShow', '0');
    }

</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="/js/chat.js"></script>

<script type="text/javascript">

        //If the Chat was shown on the previous site than show it again
        if(sessionStorage.getItem('ChatShow') == 1)
        {
            showChatStart();
        }


        // set username
        var name="<?php echo $_SESSION['username']; ?>";

        // strip tags
        name = name.replace(/(<([^>]+)>)/ig, "");

        // kick off chat
        var chat = new Chat();
        $(function ()
        {

            chat.getState();

            // watch textarea for key presses
            $("#sendie").keydown(function (event) {

                var key = event.which;

                //all keys including return.
                if (key >= 33) {

                    var maxLength = $(this).attr("maxlength");
                    var length = this.value.length;

                    // don't allow new content if length is maxed out
                    if (length >= maxLength) {
                        event.preventDefault();
                    }
                }
            });
            // watch textarea for release of key press
            $('#sendie').keyup(function (e) {

                if (e.keyCode == 13) {

                    var text = $(this).val();
                    var maxLength = $(this).attr("maxlength");
                    var length = text.length;

                    // send
                    if (length <= maxLength + 1) {

                        chat.send(text, name);
                        $(this).val("");

                    } else {

                        $(this).val(text.substring(0, maxLength));

                    }


                }
            });

        });
</script>