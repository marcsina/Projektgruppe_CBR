<?php
//config file with all includes and variables we need
include_once 'config.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';

}
?>
<!doctype html>
<html lang='de'>

<head>

    <!-- include Header -->
    <?php
    include(ROOT_PATH.'Projektgruppe/php/include/header.php');
    ?>

    <!-- Bootstrap CSS -->
    <link href='css/bootstrap.min.css' rel='stylesheet' />

    <!--external css-->
    <!-- font icon -->

    <link href='css/font-awesome.min.css' rel='stylesheet' />

    <!-- Custom styles -->

    <link href='css/style-responsive.css' rel='stylesheet' />

    <link href='css/jquery-ui-1.10.4.min.css' rel='stylesheet' />
</head>

<!-- include Navbar -->
<?php
include ('php/include/navbar.php');
?>

<body>
    <div class='container'>
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <h2>
                <b>Willkommen auf der Webseite der Uni Siegen MedAusbild</b>
            </h2>
            <p>
                Sind Sie Student der Universität Siegen?
                <br />
                Möchten Sie sich im Bereich der Medizin fortbilden?
                <br />
                Zusammen mit Ihren Kommilitonen Spaß haben?
                <br />
                <br />
                Dann sind Sie hier genau richtig!
                <br />
                <br />
                Bestreiten Sie spannende und fordernde Quizduelle gegen ihre Kommilitonen und vergleichen Sie ihre Ergebnisse. Verfolgen Sie die letzten Vorlesungen Ihrer Professoren und Dozenten. Werden Sie zum MedDuell-Master!
            </p>
            <?php
            if($logged == 'out')
            {
                echo"
                <div class='col-sm-6 col-md-6'>
                    <p>Sind Sie schon Mitglied? Dann loggen Sie sich hier ein!</p>
                    <a role ='button' class='btn btn-sm' href='php/login.php'>Login</a>
                </div>
                <div class='col-sm-6 col-md-6'>
                    <p>Werden Sie Mitglied! Registrieren Sie sich hier</p>
                    <a role ='button' class='btn btn-sm' href='php/register.php'>Registrieren</a>
                </div>";
            }
            else
            {
                echo "
                <h3>Neuigkeiten</h3>
                <ul class='nav nav-tabs'>
                    <li class='active'>
                        <a data-toggle='tab' href='#quiz'>Quiz</a>
                    </li>
                    <li>
                        <a data-toggle='tab' href='#forum'>Forum</a>
                    </li>
                    <li>
                        <a data-toggle='tab' href='#classroom'>Classroom</a>
                    </li>
                </ul>
                <div class='tab-content'>
                    <div class='tab-pane fade in active' id='quiz'>
                        <a href='php/Quiz_uebersicht.php'><img src='img/team/3.jpg' width='30%' height='30%'/></a>
                    </div>
                    <div class='tab-pane fade in' id='forum'>
                        <a href='php/forum.php'><img src='img/team/1.jpg' width='30%' height='30%'/></a>
                    </div>
                    <div class='tab-pane fade in' id='classroom'>
                        <a href=''><img src='img/team/4.jpg' width='30%' height='30%'/></a>
                    </div>
                </div>";
            }
            ?>
           
        </div>
    </div>

    <!-- _________________________Content________________________________-->
    <!-- Scripts -->
    <script src='js/snowball-german.js'></script>
    <script src='js/stopWords.js'></script>
    <script src='js/jquery-2.2.2.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <script type='text/JavaScript' src='js/sha512.js'></script>
    <script type='text/JavaScript' src='js/forms.js'></script>
</body>
</html>