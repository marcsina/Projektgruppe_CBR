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


    <title>Chat</title>

    <link rel="stylesheet" href="/Projektgruppe/css/style_chat.css" type="text/css" />



    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="/Projektgruppe/js/chat.js"></script>
    <script type="text/javascript">

        // ask user for name with popup prompt
        var name="<?php echo $_SESSION['username']; ?>";

        // strip tags
        name = name.replace(/(<([^>]+)>)/ig, "");

        // kick off chat
        var chat = new Chat();
        $(function () {

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


    <script>

        var opened = 0;

        function openNav() {
            if (opened == 0) {
                document.getElementById("mySidenav").style.height = "55%";
                opened = 2;
            }
            else
            {
                closeNav();
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.height = "0%";
            opened = 0;
        }
    </script>

</head>

<!--chat.start()-->

<body onload="setInterval('chat.update()', 1000);">


    <span class="Chat_Button" onclick="openNav()">Chat &#9776; </span>

    <div id="mySidenav" class="sidenav">
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