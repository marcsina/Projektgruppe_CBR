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
<html lang="de">

<head>

    <!-- include Header -->
    <?php
        include(ROOT_PATH.'Projektgruppe/php/include/header.php');
    ?>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!--external css-->
    <!-- font icon -->


    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles -->



    <link href="css/style-responsive.css" rel="stylesheet" />

    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">

</head>

<!-- include Navbar -->
		<?php
			include ("php/include/navbar.php");
		?>

<body>






    <!-- _________________________Content________________________________-->
    <!-- Scripts -->
    <!--<script src="js/german-porter-stemmer.js"></script>-->
    <script src="js/snowball-german.js"></script>
    <script src="js/stopWords.js"></script>
    <script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>


</body>

</html>