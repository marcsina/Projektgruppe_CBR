<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
$logged = 'in';
} else {
$logged = 'out';
}
?>

<html lang="en">


<head>

    <!-- include Header -->    
    <?php
    include('include/header.php');
    ?>




    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <link href="../css/style3.css" rel="stylesheet">

</head>

 <!-- _______________________________________NavBar_____________________________________________________-->    
    <?php
    include ("include/navbar.php");
    
    ?>

<body id="home">
   



    <div class="row  noir jumbotron text-center">
        <h1 style=" color: white">Artikel</h1>


        <form class=" form-inline  " class=" form-control">


            <h1 style="text-align: center; font-size: 30px; color: white"> </h1>
            <div class=" col-md-offset-1 col-md-10">
                <button type="button" class="btn btn-sucess" class="form-control">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
                <input class="form-control" type="search" placeholder="Artikel suchen..." aria-label="Search" style="width: 400px;">

                <button data-toggle="modal" data-backdrop="false" href="#formulaire" class="btn btn-primary BTN " id="html"> Erweitere Suche</button>

            </div>

        </form>

        <div>

            <div class="modal fade" id="formulaire">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">x</button>
                            <h4 class="modal-title">suche :</h4>
                        </div>
                        <div class="modal-body">
                            <form action="test.php">
                                <div class="form-group">
                                    <label for="titel">Titel</label>
                                    <input type="text" class="form-control" name="titel" id="titel" placeholder="titel ">
                                </div>
                                <div class="form-group">
                                    <label for="thema">Autor</label>
                                    <input type="text" class="form-control" name="frage" id="frage" placeholder="Autor ">

                                </div>

                                <div class="form-group">
                                    <label for="date">Erscheinunsdatum</label>
                                    <input type="date" class="form-control" name="date" id="date" placeholder="titel ">

                                </div>

                                <button type="submit" class="btn btn-info">Senden</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-info" data-dismiss="modal">Abbrechen</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">

        <section class=" col-md-offset-1 col-md-7 pour">
            <h4><small>RECENTS POST</small></h4>
            <hr>
            <article>

                <a href="unarticle.html"> <h3><strong>Alzheimer in Deutschland</strong></h3></a>
                <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane,sep 27,2018</h5>

                <p>ce site se donne pour vision pouvoir aider les chretiens du monde entier a plus se rapprocher de Dieu et passer du temps de qualité avec ce dernier Bla bla bla bla (texte de l'article) et oui bla  alalalal lal lanalalalal alal al lal a l al a la la  a a lal a a a ll a la la a la l a a la al a l lal al alal  ala a  la a la la lllllll lllllllllllllllll llllll lllllllllllllllll  llllllllll lllllllll ala la la la all al a la lal a lalla  lal allalalal a  llalalla lla  l alll aa lla l llalll l a lla l  la lllal l l a llal l l la l lllall ll l al llal l l lllllllllllllllllll l  lllllllllllllllllllllllllllllllllllllll l llllllllllllllllllllllllllllllll llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll lllllllllllllllllllllllllllllll llllllllllllllllllllllllllllllllllllllllllllllllllll lllllllllllllllllllllllllllll llllllllll</p>

                <P> <a class="op" href="">More About+++</a> </P>


            </article>

            <article>
                <h3><strong>Demenz heutzutage</strong></h3>
                <h5><span class="glyphicon glyphicon-time"></span> Post by juji Dane,sep 27,2018</h5>
                <p>ce site se donne pour vision pouvoir aider les chretiens du monde entier a plus se rapprocher de Dieu et passer du temps de qualité avec ce dernier Bla bla bla bla (texte de l'article) et oui bla  alalalal lal lanalalalal alal al lal a l al a la la  a a lal a a a ll a la la a la l a a la al a l lal al alal  ala a  la a la la lllllll lllllllllllllllll llllll lllllllllllllllll  llllllllll lllllllll ala la la la all al a la lal a lalla  lal allalalal a  llalalla lla  l alll aa lla l llalll l a lla l  la lllal l l a llal l l la l lllall ll l al llal l l lllllllllllllllllll l  lllllllllllllllllllllllllllllllllllllll l llllllllllllllllllllllllllllllll llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll lllllllllllllllllllllllllllllll llllllllllllllllllllllllllllllllllllllllllllllllllll lllllllllllllllllllllllllllll llllllllll</p>

                <P> <a class="op" href="">More About+++</a> </P>


            </article>
        </section>

        <aside class=" col-md-3 peno">
            <h4><small>ALLE ARTIKEL</small></h4>
            <hr>




            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Alzheimer
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <a href="#"> <h5><strong>Alzheimer in Deutschland</strong></h5></a>
                            <a href="#"> <h5><strong>Wie lebt man mit Alzheimer</strong></h5></a>
                            <a href="#"> <h5><strong>Wie schwer ist es für Patienten</strong></h5></a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Demenz
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <a href="#"> <h5><strong>Alzheimer in Deutschland</strong></h5></a>
                            <a href="#"> <h5><strong>Wie lebt man mit Alzheimer</strong></h5></a>
                            <a href="#"> <h5><strong>Wie schwer ist es für Patienten</strong></h5></a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Parkinsson
                            </a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <a href="#"> <h5><strong>Alzheimer in Deutschland</strong></h5></a>
                            <a href="#"> <h5><strong>Wie lebt man mit Alzheimer</strong></h5></a>
                            <a href="#"> <h5><strong>Wie schwer ist es für Patienten</strong></h5></a>
                        </div>
                    </div>
                </div>
            </div>

        </aside>




    </div>




    <!--____________________________________________________________________________________________________-->
    <!-- Scripts -->

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $("form").submit(function (e) {
                e.preventDefault();
                var $form = $(this);
                $.post($form.attr("action"), $form.serialize())
                    .done(function (data) {
                        $("#html").html(data);
                        $("#formulaire").modal("hide");
                    })


            });
        });
    </script>

</body>

</html>