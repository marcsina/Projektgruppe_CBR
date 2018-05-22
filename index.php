<!doctype html>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>





        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link href="css/style.css" rel="stylesheet">

    </head>

    <body id="home">
        <!-- _______________________________________NavBar_____________________________________________________-->

        <nav class="navbar-default navbar-fixed-top" role="navigation">
            <!-- role für browser zur                                                                            erkennung-->
            <div class="container">
                <div class="navbar-header ">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                        <!-- erzeugen die 3 striche-->
                    </button>
                     <a class="navbar-brand" href="#home">MedAusbild</a> 
                    <!-- Titel der Navbar-->
                </div>

                <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="menuItem"><a href="#...">Diagnose</a>
                        </li>
                        <li class="menuItem"><a href="#...">Quiz</a>
                        </li>
                        <li class="menuItem"><a href="#...">Checker</a>
                        </li>

                        <li class="menuItem"><a href="#...">Classroom</a>
                        </li>
                        <li class="menuItem"><a href="#...">Forum</a>
                        </li>
                        <li class="menuItem"><a href="#contact">Kontakt</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--container-->
        </nav>
        <!-- ________________________________________________________________________________________________________ -->


        <!-- _________________________Content________________________________-->
        <br>
        <br>
        <br>
        <br>

        <!-- every content should be nested in a way like the example below   -->

        <!-- nested columns -->
        <div class="row first-after-navbar">
            <form>
                <!-- first nested column -->
                <div class="col-md-12">
                    <p id="input-textarea">Der Patient kann augenblicklich die Mahlzeiten nicht mehr ausreichend zubereiten; Anziehen, Ausziehen, Waschen usw. wen kann er noch selbst. Er kann sich im Dorf noch bewegen, größere Wege, z. B. in die nächst größere Stadt, sind nun
                        kaum mehr möglich. Der Patient kommt immer häufiger mit Zetteln in die Klinik. Die Bewältigung von Post, Arztterminen usw. ist schwierig geworden, zumal die Anbindung an den Sohn nun nicht mehr so möglich ist. Er ist im Begriff
                        seine Selbständigkeit zur verlieren. Er zieht sich verstärkt zurück, geht nicht mehr häufig zum Einkaufen, ist depressiv und verzweifelt geworden, weint häufig, auch weil er seine Demenz bemerkt und nun den Unfall seines Sohnes
                        betrauert. Ganz akut klagt er über Kniebeschwerden bei Gonarthrose. In der Vergangenheit wurde schon einmal eine Arthroskopie veranlasst. Der Patient kann nun kaum mehr Treppen steigen und plant in der nächsten Zeit einen chirurgischen
                        Eingriff.</p>
                </div>

                <!-- second nested column -->
                <div class="col-md-12">
                    <!-- column content -->
                    <button type="button" id="berechnen">TestButton</button>
                    <button type="button" id="cbr">CBR Auswertung</button>

                </div>

                <!-- third nested column -->
                <div class="col-md-12">
                    <label>
                        <output id="output-textarea"></output>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>
                        <output id="CBRtestfeld"></output>
                    </label>
                </div>
                
                       </form>
        </div>
        <div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>

        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/german-porter-stemmer.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
		<scriptsrc="js/CBR.js"></script>
		

    </body>

</html>