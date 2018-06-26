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
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>





        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link href="css/style3.css" rel="stylesheet">

    </head>

    <body id="home">
        <!-- _______________________________________NavBar_____________________________________________________-->

        <?php
        include ("php/include/navbar.php");
        ?>


        <!-- _________________________Content________________________________-->
        </br>
        </br>
        </br>

        <!-- every content should be nested in a way like the example below  -->

        <!-- nested columns -->
        <div class="row first-after-navbar">

        <div class="col-md-offset-1 col-md-1 col-sm-offset-1 col-sm-1 "> <h4>Symptome</h4></div>
        <div class="col-md-offset-5 col-md-2 col-sm-offset-5 col-sm-2">
        <h4>Gefundene Symptome</h4> 
             </div>
             <div class="col-md-offset-1 col-md-2 col-sm-offset-1 col-sm-2"><h4>Gewichtung</h4></div>
           
        </div>

         <div class="row">
        
        <div class="col-md-offset-1 col-md-5 col-sm-6 ">

            <form class="col-md-5">
                          
                <textarea  class="textar" id="textarea_eingabe" name="text"  ></textarea>               
                
            </form>
            </div>

             <section class="col-md-offset-1 col-md-5 col-sm-offset-1 col-sm-5 tableau" id="section_symptoms">
             <!--<div class="row">
              <div class="col-md-3 col-sm-3">vergesslichkeit</div>  
             <div class=" col-md-offset-2 col-md-6 col-sm-offset-1 col-sm-7 btn-group ">
                 <button class="btn btn-info btn-sm" >klein</button>
                  <button class ="btn btn-warning btn-sm" >mittel</button>
                   <button class="btn btn-danger btn-sm">hoch</button>
                  </div>
                  <div class=" col-md-1"> <button type="button" class="close  btn btn-info" data-dismiss="modal">x</button></div> 
            </div>
            </br>

            <div class="row">
              <div class="col-md-3 col-sm-3">laufen</div>  
              <div class=" col-md-offset-2 col-md-6 col-sm-offset-1 col-sm-7 btn-group ">
                 <button class="btn btn-info btn-sm" >klein</button>
                  <button class ="btn btn-warning btn-sm" >mittel</button>
                   <button class="btn btn-danger btn-sm">hoch</button>
                  </div>
                  <div class=" col-md-1"> <button type="button" class="close btn btn-info" data-dismiss="modal">x</button></div> 
            </div>-->
            
            
           
            




           
             </section>

        </div>
        
        </br >
        <div class="row">
			<button id="btn_submit" class=" col-md-offset-1 col-md-1 col-sm-offset-1 col-sm-2 btn btn-success type=" submit" ">Submit</button>
            <button id="btn_start" class=" col-md-offset-5 col-md-1 col-sm-offset-5 col-sm-2 btn btn-success type=" submit" ">Starten</button>


            
        </div>

         <div class="row">
         
         </br>
         <h4 class="col-md-offset-4 col-md-1 col-sm-offset-4 col-sm-1">Resultat</h4>
         </div>
     
       <div class="row">
            <section class=" col-md-offset-4 col-md-5 col-sm-offset-4 col-sm-5 tableau2">
				<div id='div_ausgabe'></div>
			</section>-
       </div>


        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/german-porter-stemmer.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/code.js"></script>
		<script src="js/CBR.js"></script>
		<script src="js/Checker_text.js"></script>

    </body>

</html>