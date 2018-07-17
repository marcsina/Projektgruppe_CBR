<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';


sec_session_start();
?>

<div class ="navbar-fixed-top">
<header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"> 
            <a class="" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span></span>
                      </a>
          </div>
      </div>

	  <!-- Style -->
	  <link href="css/style_home.css" rel="stylesheet">
	  <!-- bootstrap theme -->
	  <link href="css/bootstrap-theme.css" rel="stylesheet">
	  
	   <link href="css/style-responsive.css" rel="stylesheet" />

	  <link href="css/elegant-icons-style.css" rel="stylesheet" />
	  

      <!--logo start-->
      <a href="index.php" class="logo">Medausbild <span class="lite">Siegen</span></a>
      <!--logo end-->

      

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">


          
  
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.png">
                            </span>
                            <span class="username">Username</span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="profil.php"><i class="icon_profile"></i> My Profile</a>
              </li>
              <li>
                <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
              </li>
              <li>
                <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
              </li>
              <li>
                <a href="#"><i class="icon_chat_alt"></i> Chats</a>
              </li>
              <li>
                <a href="php/include/logout.php"><i class="icon_key_alt"></i> Log Out</a>
              </li>
              <li>
                <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
              </li>
			  <?php
						if (login_check($mysqli) == true) 
						{
							if($_SESSION['admin'] == 1)
							{
								echo "<li><a href='admin_config.php'><i class='icon_key_alt'></i>Adminseite</a></li>";
							}
						}
			  ?>

              
            </ul>
          </li>
          
        </ul>
       

         <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                       
                        <li class="menuItem"><a href="Quiz.php">Quiz <i class="icon_table"></i></a>
                        </li>

                        <li class="menuItem"><a href="forum.php">Forum  <i class="icon_genius"></i></a>
                        </li>
                       
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Checker <i class="icon_document_alt"></i><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="checkereinhacken.php">Symptom Checker</a></li>
              <li><a href="checkertext.php">Fall Checker</a></li>
            </ul>
          </li>

          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> Classroom <i class="icon_desktop"></i><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#section41">Scripts</a></li>
              <li><a href="#section42">Tutorials</a></li>
              <li><a href="#section42">videos</a></li>

            </ul>
          </li>
           <li class="menuItem"><a href="#...">Statistik  <i class="icon_piechart"></i></a>
                        </li>

           <li class="menuItem"><a href="#contact">Kontakt <i class="icon_documents_alt"></i></a></li>
                    </ul>
                </div>
      </div>
    </header></div>


