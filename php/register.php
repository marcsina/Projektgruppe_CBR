<?php
include_once 'include/register_process.php';
include_once 'include/functions_login.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="../js/sha512.js"></script> 
        <script type="text/JavaScript" src="../js/forms.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <link href="../css/bootstrap.min.css" rel="stylesheet">


        <link href="../css/style3.css" rel="stylesheet">
 
        
    </head>
    <body>
       <div class="row first-after-navbar ip">



        <!-- Anmeldeformular für die Ausgabe, wenn die POST-Variablen nicht gesetzt sind
        oder wenn das Anmelde-Skript einen Fehler verursacht hat. -->
       <pre> <h1 class="ok" ><strong>Register With Us</strong></h1></pre>
        <hr>
        <br>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
          <div class="col-md-offset-1 col-md-5">
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">
            <label for="username">Username: </label>
            <input type='text' 
                name='username' 
                id='username' class="form-control" />
                <label for="email">Email: </label>
             <input type="text" name="email" id="email" class="form-control" />
             <label for="password">Password: </label>
             <input type="password"
                             name="password" 
                             id="password" class="form-control"/>
               <label for="confirmpwd">Confirm password: </label>              
             <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" class="form-control"/><br>

                
                      
            <input type="button" 
                   value="Register" 
                   class=" btn btn-success "
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p><h4>Return to the <a href="login.php">login page</a>.</h4></p>
        </div>
   



        <div class="col-md-offset-1 col-md-5">
        <ul class="ik">
            <li>Benutzernamen dürfen nur Ziffern, Groß- und Kleinbuchstaben und Unterstriche enthalten.</li>
            <li>E-Mail-Adressen müssen ein gültiges Format haben.</li>
            <li>Passwörter müssen mindest sechs Zeichen lang sein.</li>
            <li>Passwörter müssen enthalten
                <ul>
                    <li>mindestens einen Großbuchstaben (A..Z)</li>
                    <li>mindestens einen Kleinbuchstabenr (a..z)</li>
                    <li>mindestens eine Ziffer (0..9)</li>
                </ul>
            </li>
            <li>Das Passwort und die Bestätigung müssen exakt übereinstimmen.</li>
        </ul>
          </div>
           
           
        </div>


        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="../js/german-porter-stemmer.js"></script>
        <script src="../js/stopWords.js"></script>
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/script.js"></script>
        <script src="../js/code.js"></script>
    </body>
</html>
