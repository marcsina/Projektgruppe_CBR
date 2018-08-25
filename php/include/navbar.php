<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once ($path . '/Projektgruppe/php/include/conn.php');
include_once ($path . '/Projektgruppe/php/include/functions_login.php');
include_once ($path . '/Projektgruppe/php/include/quiz_countPendingChallenges.php');

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
	$pendingChallenges = getNumberPendingChallenges($mysqli, $_SESSION['user_id']);
} else {
    $logged = 'out';
}

?>

<div class ="navbar-fixed-top">
<header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"> 
            <a class="" href="/Projektgruppe/index.php">
                          <i class="icon_house_alt"></i>
                          <span></span>
                      </a>
          </div>
      </div>

	  <!-- Style -->
	  <link href="/Projektgruppe/css/style_home.css" rel="stylesheet">
	  <!-- bootstrap theme -->
	  <link href="/Projektgruppe/css/bootstrap-theme.css" rel="stylesheet">
	  
	  <link href="/Projektgruppe/css/style-responsive.css" rel="stylesheet" />

	  <link href="/Projektgruppe/css/elegant-icons-style.css" rel="stylesheet" />

       <link href="/Projektgruppe/css/style_basic.css" rel="stylesheet" />

	  

      <!--logo start-->
      <a href="/Projektgruppe/index.php" class="logo">Medausbild <span class="lite">Siegen</span></a>
      <!--logo end-->

      

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
		<?php
		if($logged == 'out')
		{
			echo "<ul class='nav pull-right top-menu'><li><a href = '/Projektgruppe/php/login.php'>Login</a></li></ul>";
		}?>
         <ul class="nav pull-right top-menu" <?php
		if($logged == 'out')
		{
			echo "style='visibility: hidden'";
		}?>>
		 <li class='dropdown'>
			<a data-toggle='dropdown' class='dropdown-toggle' href='/Projektgruppe/php/profil.php'>
				<span class='profile-ava'>
						<img alt='' src='/Projektgruppe/Fotos/avatar1_small.png'>
					</span>
					<span class="username"><?php echo $_SESSION['username']; ?></span>
                    <b class="caret"></b>
                 </a>
				<ul class="dropdown-menu extended logout">
				  <div class="log-arrow-up"></div>
				  <li class="eborder-top">
					<a href="/Projektgruppe/php/profil.php"><i class="icon_profile"></i> My Profile</a>
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
					<a href="/Projektgruppe/php/include/logout.php"><i class="icon_key_alt"></i> Log Out</a>
				  </li>
				  <li>
					<a href=""><i class="icon_key_alt"></i> Documentation</a>
				  </li>
				  <?php
					if (login_check($mysqli) == true) 
					{
						if($_SESSION['admin'] == 1)
						{
							echo "<li><a href='/Projektgruppe/php/admin_config.php'><i class='icon_key_alt'></i>Adminseite</a></li>";
						}
					}
                  ?>
				</ul>
			</li>  
        </ul>
       

          <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse"
              <?php
              if($logged == 'out')
              {
                  echo "style='visibility: hidden'";
		}?>>
              <ul class="nav navbar-nav">

                  <li class="menuItem">
                      <a href="/Projektgruppe/php/Quiz_uebersicht.php">
                          Quiz
                          <i class="icon_table"></i><?php if($pendingChallenges > 0){ echo "<span class='badge bg-important'> $pendingChallenges </span>"; } ?>
                      </a>
                  </li>

                  <li class="menuItem">
                      <a href="/Projektgruppe/php/forum.php">
                          Forum
                          <i class="icon_genius"></i>
                      </a>
                  </li>

                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          Checker
                          <i class="icon_document_alt"></i>
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="/Projektgruppe/php/checker_symptom.php">Symptom Checker</a>
                          </li>
                          <li>
                              <a href="/Projektgruppe/php/checker_text.php">Fall Checker</a>
                          </li>
                      </ul>
                  </li>

                  <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          Classroom
                          <i class="icon_desktop"></i>
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                          <li>
                              <a href="/Projektgruppe/php/artikel.php">Artikel</a>
                          </li>
                          <li>
                              <a href="/Projektgruppe/php/scripts.php">Scripts</a>
                          </li>
                          <li>
                              <a href="/Projektgruppe/php/tutorials.php">Tutorials</a>
                          </li>
                          <li>
                              <a href="/Projektgruppe/php/videos.php">videos</a>
                          </li>
                      </ul>
                  </li>
                  <li class="menuItem">
                      <a href="/Projektgruppe/php/statistik.php">
                          Statistik
                          <i class="icon_piechart"></i>
                      </a>
                  </li>

                  <li class="menuItem">
                      <a href="/Projektgruppe/php/contact_medausbild.php">
                          Kontakt
                          <i class="icon_documents_alt"></i>
                      </a>
                  </li>
              </ul>
          </div>
      </div>
    </header></div>


