<?php
//config file with all includes and variables we need
include_once 'php/include/functions_history.php';
//ini_set ("display_errors", "1");
//error_reporting(E_ALL);

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
    include_once('php/include/header.php');
    ?>

    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/cubeportfolio/css/cubeportfolio.min.css" />
    <link href="css/nivo-lightbox.css" rel="stylesheet" />
    <link href="css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
    <link href="css/owl.carousel.css" rel="stylesheet" media="screen" />
    <link href="css/owl.theme.css" rel="stylesheet" media="screen" />
    <link href="css/animate.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles -->


    <link href="css/style-responsive.css" rel="stylesheet" />

    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet" />
</head>

<!-- include Navbar -->
<?php
include_once ('php/include/navbar.php');
?>

<body>
    <section id="Updates" class="home-section bg-gray paddingbot-60">
        <div class="container marginbot-50">
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <h2>
                    Willkommen auf der Webseite der Uni Siegen MedAusbild
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
                if($logged == "out")
                {
                    echo "<div class='col-sm-6 col-md-6'>
                    <p>Sind Sie schon Mitglied? Dann loggen Sie sich hier ein!</p>
                    <a role ='button' class='btn btn-sm' href='php/login.php'>Login</a>
                </div>
                <div class='col-sm-6 col-md-6'>
                    <p>Werden Sie Mitglied! Registrieren Sie sich hier</p>
                    <a role ='button' class='btn btn-sm' href='php/register.php'>Registrieren</a>
                </div>";
                }
                ?>

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="wow fadeInDown" data-wow-delay="0.1s">
                            <div class="section-heading text-center">
                                <h2 class="h-bold">
                            </div>
                        </div>
                        <div class="divider-short"></div>
                    </div>
                </div>
            </div>

            <?php
            if($logged == "in")
            {
                //get recent updates
                $recent_article = get_Recent_Article($mysqli, 3);
                $recent_forum = get_Recent_Forum($mysqli, 3);

                echo"
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div id='filters-container' class='cbp-l-filters-alignLeft'>
                                    <div data-filter='*' class='cbp-filter-item-active cbp-filter-item'>
                                        All (
                                        <div class='cbp-filter-counter'></div> )
                                    </div>
                                    <div data-filter='.forum' class='cbp-filter-item'>
                                        forum (
                                        <div class='cbp-filter-counter'></div> )
                                    </div>
                                    <div data-filter='.article' class='cbp-filter-item'>
                                        article (
                                        <div class='cbp-filter-counter'></div> )
                                    </div>
                                </div>

                                <div id='grid-container' class='cbp-l-grid-team'>
                                    <ul>";



                foreach($recent_forum as &$item )
                {

                    echo"
                                        <li class='cbp-item forum'>
                                            <a href='http://medausbild.de/php/forum_demenz.php?topic=".$item['topic_id']."' class='cbp-caption cbp-singlePageI'>
                                                <div class='cbp-caption-defaultWrap'>
                                                    <img src='img/team/1.jpg' alt='' width='100%' />
                                                </div>
                                                <div class='cbp-caption-activeWrap'>
                                                    <div class='cbp-l-caption-alignCenter'>
                                                        <div class='cbp-l-caption-body'>
                                                            <div class='cbp-l-caption-text'>Neues in ".$item['topic_title']."</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                            ";
                }

                foreach($recent_article as &$item )
                {

                    echo"
                                        <li class='cbp-item article'>
                                            <a href='http://medausbild.de/php/artikel_show.php?id=".$item['article_id']."' class='cbp-caption cbp-singlePageI'>
                                                <div class='cbp-caption-defaultWrap'>
                                                    <img src='img/index_book.jpg' alt='' width='100%' />
                                                </div>
                                                <div class='cbp-caption-activeWrap'>
                                                    <div class='cbp-l-caption-alignCenter'>
                                                        <div class='cbp-l-caption-body'>
                                                            <div class='cbp-l-caption-text'>Neuer Artikel: ".$item['title']."</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                            ";
                }

                echo"</ul>
                    </div>
                </div>
            </div>";

            }


            ?>
                        
        </div>
    </section>

    <!-- _________________________Content________________________________-->
    <!-- Scripts -->

    <a href="#" class="scrollup">
        <i class="fa fa-angle-up active"></i>
    </a>

    <!-- Core JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.scrollTo.js"></script>
    <script src="js/jquery.appear.js"></script>
    <script src="js/stellar.js"></script>
    <script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/nivo-lightbox.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>