﻿<?php
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
    <?php include('include/header.php'); ?>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>  
    <?php include ("include/navbar.php"); ?>
    
<body id="home">
	<div class="container">
        <div class="row text-center">
            <h1 style=" color: white">Artikel</h1>
            <form class=" form-inline  " class=" form-control" action="artikel_search.php" method="get">
                <h2 style="text-align: center; font-size: 30px; color: white"> </h2>
                <div class=" col-md-offset-1 col-md-10">
                    <button type="submit" class="btn btn-sucess" class="form-control" style=" color: black">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                    <input class="form-control" type="search" placeholder="Artikel suchen..." aria-label="Search" style="width: 400px;" name="searchtitel" id="searchtitel">
                </div>
            </form>
        </div>
    
        <div class="row">
            <section class=" col-md-offset-1 col-md-7 pour">
                <h4><small style=" color: white">Recent Posts</small></h4>
                <hr>
                
                <article>
                    <a href="artikel_show.php"> <h3><strong>Olli verschwunden!</strong></h3></a>
                    <h6><span class="glyphicon glyphicon-time"></span> Post by Jane Dane,sep 27,2018</h6>
                    <p>lol</p>
                </article>
                
                <article>
                    <h3><strong>Demenz heutzutage</strong></h3>
                    <h6><span class="glyphicon glyphicon-time"></span> Post by juji Dane,sep 27,2018</h6>
                    <p>lol2</p>
                </article>
                
                <article>
                    <a href="unarticle.html"> <h3><strong>Alzheimer in Deutschland</strong></h3></a>
                    <h6><span class="glyphicon glyphicon-time"></span> Post by Jane Dane,sep 27,2018</h6>
                    <p>lol3</p>
                </article>  
            </section>
    
            <aside class=" col-md-3 peno">
                <h4><small style=" color: white">ALLE ARTIKEL</small></h4>
                <hr>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a>
                                    Demenz
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <!-- Scripts -->

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>