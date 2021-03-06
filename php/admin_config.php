﻿ <?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';


sec_session_start();

if (login_check($mysqli) == true) 
{
    $logged = 'in';

	if($_SESSION['admin'] == 0)
	{
		//Wenn kein Admin dann zurück auf die index		
		header('Location: http://medausbild.de');	
		exit;		
	}
} else 
{
    $logged = 'out';
	//Wenn kein Admin dann zurück auf die index
	header('Location: http://medausbild.de');	
	exit;	
}
?>

<!doctype html>
<html lang="de">

<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>





    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="../css/style2.css" rel="stylesheet">
    <link href="../css/style_admin.css" rel="stylesheet">


</head>

<body id="admin_config">

    <!-- include Navbar -->
    <?php
            include ("include/navbar.php");
    ?>

    <div class="container">
        <h2>Adminfunktionen</h2>

        <ul class="nav nav-tabs">
            <li class="active"><a href="#addNewCase">Neuen Case einpflegen</a></li>
			<li><a href="#editCase">Case bearbeiten</a></li>
			<li><a href="#deleteCase">Case löschen</a></li>
            <li><a href="#addNewCategory">Neue Kategorie hinzufügen</a></li>
			<li><a href="#editCategory">Kategorie bearbeiten</a></li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane fade in active" id="addNewCase">
                <div class="admin_main">
                    <h3>Neuen Case hinzufügen</h3>
                    <!--Texteingabe für Filterung-->
                    <div class="col-md-6 col-sm-12">
                        <h4>Text zur automatischen Erfassung eingeben</h4>
                        <!--<textarea id="text_admin"></textarea>-->
                        <div contenteditable="true" id="text_admin"></div>
                        <div id='divAdminConfigHighlightLegende' style="visibility: hidden;"><b><font color='#52f2f2'>Symptom</font></b> / <b><font color='#ed5d1b'>Negierung</font></b> / <b><font color='green'>Verstärkung</font></b></div>
                        <form>
                            <button class="btn btn-primary" type="button" id="btn_search_Text">Text nach Keywords durchsuchen</button>
                        </form>
                    </div>

                    <!--Liste der Category-->
                    <div class="col-md-6 col-sm-12 auto">
                        <h4>Kategorien verfeinern / gewichten</h4>
                        <form class="myForm" autocomplete="off">
                            <div class="form-group autocomplete">
                                <label for="add_new_Category">Name der Kategorie</label>
                                <input type="text" class="form-control" id="add_new_Category" placeholder="Kategoriename">
                            </div>
                            <input type="range" step="10" min="0" max="100" value="50" class="slider" id="add_new_Category_Slider" onchange="updateSlider(this.value,'add_new_Category_Slider_Value')">
                            <p id="add_new_Category_Slider_Value">Gewicht: 50%</p>
                            <button class="btn btn-primary" type="reset" id="btn_add_new_Category">Hinzufügen</button>
                            <button class="btn btn-primary" type="button" id="btn_add_all_Category">Alle Kategorien hinzufügen</button>
                        </form>
                        <ul id="list_of_Category_admin"></ul>
                    </div>
                </div>

                <div class="Adding_Case col-md-12 col-sm-12">
                    <hr>
                    <form class="myForm">
                        <div class="form-group">
                            <label for="add_New_Case_Name">Name des Cases</label>
                            <input type="text" class="form-control" id="add_New_Case_Name" placeholder="Casename">
                        </div>
                        <button class="btn btn-primary" type="submit" id="btn_add_Case_to_DataBase">Neuen Case eintragen</button>
                    </form>
                </div>
            </div>

			<div class="tab-pane fade" id="deleteCase">
                <div class="admin_main">
                    <h3>Case Editieren</h3>
                    <!--Kategorienameneingeben-->
                    <div class="col-md-6 col-sm-12">                        
                        <form class="myForm" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="form-group autocomplete">
                                <label for="delete_Case_Name ">Name des Cases</label>
                                <input type="text" class="form-control" id="delete_Case_Name" placeholder="Casename" />
                            </div>
                            <button class="btn btn-primary" type="reset" id="btn_load_case_in_delete">Case laden</button>
                        </form>
                    </div>

                    <!--Liste der Category-->
                    <div class="col-md-6 col-sm-12 auto" id="div_delete_case">

                        <label>Vorhandene Kategorien</label>
                        <ul id="list_of_case_delete"></ul>

                        
                    </div>
                </div>
                <div class="Adding_Category col-md-12 col-sm-12">
                    <hr>
                    <form class="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <button class="btn btn-primary" type="submit" id="btn_delet_case_from_db">Case löschen</button>
                    </form>
                </div>
			</div>

            <div class="tab-pane fade" id="addNewCategory">
                <div class="admin_main">
                    <h3>Neue Kategorie hinzufügen</h3>
                    <!--Kategorienameneingeben-->
                    <div class="col-md-6 col-sm-12">
                        <h4>Kategorienamen eingeben</h4>
                        <form class="myForm" autocomplete="off">
                            <div class="form-group autocomplete">
                                <label for="add_new_Category_Category_Name ">Name der Kategorie</label>
                                <input type="text" class="form-control" id="add_new_Category_Category_Name" placeholder="Kategoriename">
                            </div>
                        </form>
                    </div>

                    <!--Liste der Category-->
                    <div class="col-md-6 col-sm-12 auto">
                        <h4>Keyword hinzufügen</h4>
                        <form class="myForm">
                            <div class="form-group">
                                <label for="add_new_Keyword">Keyword für Kategorie</label>
                                <input type="text" class="form-control" id="add_new_Keyword" placeholder="Keyword">
                            </div>
                            <button class="btn btn-primary" type="submit" id="btn_add_new_Keyword">Keyword Hinzufügen</button>
                        </form>
                        <ul id="list_of_Keywords_admin"></ul>
                    </div>
                </div>
                <div class="Adding_Category col-md-12 col-sm-12">
                    <hr>
                    <form class="myForm">
                        <button class="btn btn-primary" type="submit" id="btn_add_Category_to_DataBase">Neue Kategorie eintragen</button>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="editCase">
                <div class="admin_main">
                    <h3>Case Editieren</h3>
                    <!--Kategorienameneingeben-->
                    <div class="col-md-6 col-sm-12">                        
                        <form class="myForm" autocomplete="off">
                            <div class="form-group autocomplete">
                                <label for="edit_Case_Name ">Name des Cases</label>
                                <input type="text" class="form-control" id="edit_Case_Name" placeholder="Casename">
                            </div>
                            <button class="btn btn-primary" type="reset" id="btn_load_case">Case laden</button>
                        </form>
                    </div>

                    <!--Liste der Category-->
                    <div class="col-md-6 col-sm-12 auto" id="div_edit_case">
                        <h4>Kategorie hinzufügen</h4>
                        <form class="myForm">
                            <div class="form-group">
                                <label for="add_new_category">Kategorie des Case</label>
                                <input type="text" class="form-control" id="add_new_category" placeholder="Kategoriename">
                            </div>
                            <button class="btn btn-primary" type="submit" id="btn_add_new_category">Kategorie Hinzufügen</button>
                        </form>

                        <label>Vorhandene Kategorien</label>
                        <ul id="list_of_Keywords_case_edit"></ul>

                        
                    </div>
                </div>
                <div class="Adding_Category col-md-12 col-sm-12">
                    <hr>
                    <form class="myForm">
                        <button class="btn btn-primary" type="submit" id="btn_edit_case_save_to_db">Case Speichern</button>
                    </form>
                </div>
			</div>

			<!--EditCategory-->
				<div class="tab-pane fade" id="editCategory">
                <div class="admin_main">
                    <h3>Kategorie Editieren</h3>
                    <!--Kategorienameneingeben-->
                    <div class="col-md-6 col-sm-12">                        
                        <form class="myForm" autocomplete="off">
                            <div class="form-group autocomplete">
                                <label for="edit_Category_Name">Name der Kategorie</label>
                                <input type="text" class="form-control" id="edit_Category_Name" placeholder="Kategoriename">
                            </div>
                            <button class="btn btn-primary" type="reset" id="btn_load_Category">Kategorie laden</button>
                        </form>
                    </div>

                    <!--Liste der Category-->
                    <div class="col-md-6 col-sm-12 auto" id="div_edit_category">
                        <h4 id="Category_H4">Symptom hinzufügen zu </h4>
                        <form class="myForm">
                            <div class="form-group">
                                <input type="text" class="form-control" id="add_new_symptom" placeholder="Symptomname">
                            </div>
                            <button class="btn btn-primary" type="submit" id="btn_add_new_symptom">Symptom Hinzufügen</button>
                        </form>

                        <label>Vorhandene Symptome in gekürzter Form</label>
                        <ul id="list_of_symptoms_category_edit"></ul>
                    </div>
                </div>
                <div class="Adding_Category col-md-12 col-sm-12">
                    <hr>
                    <form class="myForm">
                        <button class="btn btn-primary" type="submit" id="btn_edit_category_save_to_db">Kategorie Speichern</button>
                    </form>
                </div>
			</div>
		</div>
    </div>

    <div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>
    <div id="pastHint" style="display:none"><b>Person info will be listed here...</b></div>
    <div id="cbrhint" style="display:none"><b>CaseBase Data will be displayed here</b></div>

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/snowball-german.js"></script>
    <script src="../js/stopWords.js"></script>
    <script src="../js/text_analyse.js"></script>
    <script src="../js/autocomplete.js"></script>
    <script src="../js/admin_config.js"></script>

</body>

</html>