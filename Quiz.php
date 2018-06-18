<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';

 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
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

        <!-- animate.CSS -->
         <link rel="stylesheet" href="css/animate.css" />

        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
            
		

          
    </head>

    <body id="home" style= "">
        <!-- _______________________________________NavBar_____________________________________________________-->
        <?php
			include ("php/include/navbar.php");
		?>


        <!-- _________________________Content________________________________-->
        <br>
        <br>
        <br>

        <!-- every content should be nested in a way like the example below   -->

        <!-- nested columns -->
        <div class="row first-after-navbar" >
                <!-- first nested column" HEADER" -->
                    <div class="row" >
                        <header class=""  class=" col-md-12" style="font-weight: 15px; font-size: 30px; text-align: center ; color: brown; animation-duration: 0s; animation-delay: 0s; animation-iteration-count: 0;" title=" a small Quiz">
                          <b> Topic: </b> What do you know about Demenz ?
                         </header><br>

						<!-- "" hinweis" -->

                        <div class=" col-xs-4 col-md-2"  style="font-weight: 25px; font-size: 20px; text-align: center; color: brown; ">
                            <section class=" animated shake" style=" animation-duration: 0s; animation-delay: 0s; animation-iteration-count: 0;">
                            <b>Hinweis: </b> <span class="glyphicon glyphicon-hand-right"></span>
                            </section>
                        </div>
                  <div class=" col-xs-8 col-md-8"  style=" ">

                      <!-- "" Hinweis jumbotron" -->

                    <div class="jumbotron" style="  ">
                      <p id="input-textarea"style=" text-align: center; text-align: justify; font-size: 18px; ">Der Patient kann augenblicklich die Mahlzeiten nicht mehr ausreichend zubereiten; Anziehen,Der Patient kann augenblicklich die Mahlzeiten nicht mehr ausreichend zubereiten; AnziehenDer Patient kann augenblicklich die Mahlzeiten nicht mehr ausreichend zubereiten; AnziehenDer Patient kann augenblicklich die Mahlzeiten nicht mehr ausreichend zubereiten; Anziehen </p>
                        </div>
                  </div> 
                  <div class="col-md-2">
                       

                  </div> 
            </div>
             <br>        
                     	<!-- "" MIni menu leftside and question box" --> 

        <div class=" container-fluid"  style=";">
            <div class="row">
                <div class=" col-md-2">

                              
                 </div>
														
							<!-- "" reasearch bar" -->

                <div class=" col-md-8" style="text-align: justify; border: 2px solid lightblue ">
				<br>
                           <!-- Timer-->   
                        <div class="col-md-12" >
                                  <p id="timer" class=" " title=" Time-left" style="text-align: center; font-size: 40px; color: red; animation-duration: s; animation-delay: s; animation-iteration-count: ;"> </p>
                            </div>

      <div class="row">

                   <div class=" questionsection " id="1" style=" padding-left: 10px ; padding-right: 10px;">                    
                 
                   
                               <h3 style=" color: blue;"> <b>Question</b> <span id="span_QuestionNumber" style=" color: red; ">1</span> of 12: <span  class="animated fadeIn" style=" color: #ff7f00 ; animation-duration: 3s; animation-delay: 0s; animation-iteration-count: ; ">(Fall-beschreibung)</span></h3>

				      	<!-- "progress bar" -->

                  <div class="progress" >
                     <div class="progress-bar progress-bar-info progress-bar-striped active massive-font" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=" width:5%">
                       5%
                        </div>
                      </div>

                      	<!-- "" Question section" -->
                        <div class="row">
                          <div class=" col-md-8">
                         <div id="div_question" style="background-color:  "> 
                            <p3 style="font-weight: bold; text-align: center; "></p3>
                        </div><br>

                        <!-- " Answer section" -->
                        
                     <div style="text-align: justify;">
                          <h2> <b> Textbox </b></h2>
                              <form>
                                <div class="form-group">
                                 <label for="answer"> please enter your answer:</label>
                          <textarea class="form-control" rows="5" cols="20" id="text-box" placeholder="answer..."  style="min-width:120%; max-width: 120%; max-height: 80%; min-height:30%; border: 3px solid lightblue; "></textarea>
                        </div> 
                    </form>           
                   </div>

                   					<!-- " Control panel with prev, next...." -->
                   			<div>
                           
                                 <a href="#" class="btn btn-success btn-md" id="saved"> <b>saved</b> 
                                    <span class=" glyphicon glyphicon-ok"></span>
                                </a>   
                                <a href="#" class="btn btn-success btn-md" id="btn_prev"><b>prev</b> 
                                    <span class=" glyphicon glyphicon-arrow-left" style=""></span>
                                </a>
                                <a class="btn btn-success btn-md" id="btn_next"> <b>next</b> 
                                    <span class=" glyphicon glyphicon-arrow-right"></span>
                                </a>
                           </div>
                              <br>
                    </div>
                
                    <div class="col-md-4">

                        <!-- " Image section " -->                 
                                 <h2 style="font-weight: bold;font-size:20px; color: brown; text-align: center;"> Bildgebung </h2>
                                <div  id="image" style=" text-align: center;">
                                 <img src="Fotos/alzheimer.jpg" alt="Photo de innere_medizin" title=" hover to zoom the image" align="middle;" style="width: 200px;
                                 height: 100px; ">
                      
                    </div>
              </div>
            </div>			

                <div class="col-md-2" style="  ">
                        
                </div>               
           </div>

            <!--*****-->
 </div>


              </div>
            </div>
        </div>
      </div>
        <br>        


        <br>
        <br>
        <br>
                     
    </body>


    <footer class="row" style=" text-align: center;"> 

                     <p1> © 2018 MedAusbild. All Rights Reserved. </p1>
        
    </footer>

        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/Quiz.js"></script>
		

    </body>


    <script >

         $(document).ready(function()
      {
       
        /*var allWells = $('.questionsection');
        var allWellsExceptFirst = $('.questionsection:not(:first)');
        allWellsExceptFirst.hide();
        next.click(function(e)
        {
            e.preventDefault();

            var target = 
            $('#' + target).show();
        });*/
        });
 </script>
</html>

    
<script type="text/javascript">
$time_limit = "2018-06-11 00:10:00"
var d = new Date($time_limit);
var hours = d.getHours(); //00 hours
var minutes = d.getMinutes(); //10 minutes
var seconds = 60 * minutes; // 600seconds

if (typeof(Storage) !== "undefined") {
  if (localStorage.seconds) {
    seconds = localStorage.seconds;
  }
}

function secondPassed() {
  var minutes = Math.round((seconds - 30) / 60);
  console.log(minutes);
  var hours = Math.round((minutes) / 60);
  var remainingSeconds = seconds % 60;
  if (remainingSeconds < 10) {
    remainingSeconds = "0" + remainingSeconds;  
  }

  if (typeof(Storage) !== "undefined") {
    localStorage.setItem("seconds", seconds);
  }
  document.getElementById('timer').innerHTML =  minutes + ":" + remainingSeconds;

  if (seconds == 0) {
    clearInterval(myVar);
    document.getElementById('timer').innerHTML = "Time Out";
    $( "next" ).click(function() {

});
    if (typeof(Storage) !== "undefined") {
      localStorage.removeItem("seconds");
    }
  } else {
    seconds--;
    console.log(seconds);
  }

}
var myVar = setInterval(secondPassed, 1000);

        

        

            </script>


</html>