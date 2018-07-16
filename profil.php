  <?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';
include_once 'php/include/functions_profile.php';

 
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


        <link href="css/style2.css" rel="stylesheet">

    </head>

    <body id="home" style="margin-top:20px;
    background-color:#e9ebee;">
        <!-- _______________________________________NavBar_____________________________________________________-->

        <?php
        include ("php/include/navbar.php");
        ?>

        <!-- _________________________Content________________________________-->
        <br>
        <br>

        <!-- every content should be nested in a way like the example below  -->

        <!-- nested columns -->
        
 <!-- ------------------------------------------------------------------------cc-->


 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="content-page">
    <div class="profile-banner" style="background-image: url(https://toulouseosteopathe.com/wp-content/uploads/2016/01/mon-osteo-medecine-etude.jpg);">


        <!-- style="background-image: url(http://hubancreative.com/projects/templates/coco/corporate/images/stock/1epgUO0.jpg);"-->
        <div class="col-sm-3 avatar-container">
            <img src="http://cdn.tictacdoc.ma/assets/images/doc/avatar-female-doc.png" class="img-circle profile-avatar" alt="User avatar">
        </div>

        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" -->
        <div class="col-sm-12 profile-actions text-right">
            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Friends</button>
            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-envelope"></i> Send Message</button>
        </div>
    </div>
    <div class="content">

        <div class="row">
            <div class="col-sm-3">
                <!-- Begin user profile -->
                <div class="text-center user-profile-2" style="margin-top:120px">
                    <ul class="list-group">
                      <li class="list-group-item">
					  
                        <h4><b>Ben</b></h4>
                        <h5>Student, Medical science</h5>
                      </li>
                      <li class="list-group-item">
                        <span class="badge">1154235</span>
                        Followers
                      </li>
                      <li class="list-group-item">
                        <span class="badge">45412</span>
                        Following
                      </li>
                      <li class="list-group-item">
                        <span class="badge">4512</span>
                        posts
                      </li>

                      <li class="list-group-item">
                        <span class="badge">7845</span>
                        shares
                      </li>
                      <li class="list-group-item">
                        <span class="badge">6253</span>
                        Karma
                      </li>
                      <li class="list-group-item">
                        <span class="badge">78952</span>
                        Likes
                      </li>


                    </ul>
                        
                        <!-- User button -->
                    <div class="user-button">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-user"></i> Add as friend</button>
                            </div>
                        </div>
                    </div><!-- End div .user-button -->
                </div><!-- End div .box-info -->
                <!-- Begin user profile -->
            </div><!-- End div .col-sm-4 -->
            
            <div class="col-sm-9">
                <div class="widget widget-tabbed">
                    <!-- Nav tab -->
                    <ul class="nav nav-tabs nav-justified">
                      <li class="active"><a href="#my-timeline" data-toggle="tab"><i class="fa fa-pencil"></i> Timeline</a></li>
                      <li><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> About</a></li>
                      <li><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> Activities</a></li>
                      <li><a href="#mymessage" data-toggle="tab"><i class="fa fa-envelope"></i> Message</a></li>
                    </ul>
                    <!-- End nav tab -->

                    <!-- Tab panes -->
                    <div class="tab-content">
                        
                        
                        <!-- Tab timeline -->
                        <div class="tab-pane animated active fadeInRight" id="my-timeline">
                            <div class="user-profile-content">
                                
                                <!-- Begin timeline -->
                                <div class="the-timeline">
                                    <form role="form" class="post-to-timeline">
                                        <textarea class="form-control" style="height: 70px;margin-bottom:10px;" placeholder="Was neues..."></textarea> <!-- placeholder="Whats on your mind..."> -->
                                        <div class="row">
                                        <div class="col-sm-6">
                                            <a class="btn btn-sm btn-default"><i class="fa fa-camera"></i></a>
                                            <a class="btn btn-sm btn-default"><i class="fa fa-video-camera"></i></a>
                                            <a class="btn btn-sm btn-default"><i class="fa fa-map-marker"></i></a>
                                        </div>
                                        <div class="col-sm-6 text-right"><button type="submit" class="btn btn-primary">Post</button></div>
                                        </div>
                                    </form>
                                    <br><br>
                                    <ul>
                                        <li>
                                            <div class="the-date">
                                                <span>13</span>
                                                <small>juin</small>
                                                <small>2018</small>
                                            </div>
                                            <h4>what is alzheimer test</h4>
                                            <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                            </p>
                                        </li>
                                        <li>
                                            <div class="the-date">
                                                <span>31</span>
                                                <small>Jan</small>
                                            </div>
                                            <h4>video Vorlesung von Prof Hofmann about what is alzheimer test </h4>
                                            <div class="videoWrapper">
                                            <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                                            </div>
                                            <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                            </p>
                                        </li>
                                        <li>
                                            <div class="the-date">
                                                <span>25</span>
                                                <small>juin</small>
                                                <small>2018</small>
                                            </div>
                                            <h4>Audio Vorlesung von Prof Rainer about what is alzheimer test</h4>
                                            <!--<iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/132890481&amp;color=ff9900&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
                                            -->
                                            <audio controls>
                                                    <source src="audio/abba.mp3" type="audio/ogg">
  
                                                            Your browser does not support the audio element.
                                                            </audio>

                                            <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                            </p>
                                        </li>
                                        <li class="the-year"><p>2013</p></li>
                                        <li>
                                            <div class="the-date">
                                                <span>20</span>
                                                <small>Dec</small>
                                            </div>
                                            <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                            </p>
                                        </li>
                                        <li>
                                            <div class="the-date">
                                                <span>27</span>
                                                <small>Nov</small>
                                            </div>
                                            <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                            </p>
                                        </li>
                                    </ul>
                                </div><!-- End div .the-timeline -->
                                <!-- End timeline -->
                            </div><!-- End div .user-profile-content -->
                        </div><!-- End div .tab-pane -->
                        <!-- End Tab timeline -->
                        
                        <!-- Tab about -->
                        <div class="tab-pane animated fadeInRight" id="about">
                            <div class="user-profile-content">
                                <h5><strong>ABOUT</strong> ME</h5>
                                <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
                                </p>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5><strong>CONTACT</strong> ME</h5>
                                            <address>
                                                <strong>Phone</strong><br>
                                                <abbr title="Phone">+49 123 456 789 </abbr>
                                            </address>
                                            <address>
                                                <strong>Email</strong><br>
                                                <a href="mailto:#">benbalaye@gmail.com</a>
                                            </address>
                                            <address>
                                                <strong>Website</strong><br>
                                                <a href="http://r209.com">http://www.MedAusbild.com</a>
                                            </address>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5><strong>MY</strong> SKILLS</h5>
                                        <p>UI Design</p>
                                        <p>java Programming</p>
                                        <p>Java Programming</p>
                                        <p>Java Programming</p>
                                    </div>
                                </div><!-- End div .row -->
                            </div><!-- End div .user-profile-content -->
                        </div><!-- End div .tab-pane -->
                        <!-- End Tab about -->
                        
                        
                        <!-- Tab user activities -->
                        <div class="tab-pane animated fadeInRight" id="user-activities">
                            <div class="scroll-user-widget">
                                <ul class="media-list">
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Ben Balaye </strong> Uploaded a photo <strong>"DSC000254.jpg"</strong>
                                        <br><i>2 minutes ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Francis Kenne Wesba</strong> Created an photo album  <strong>" what is alzheimer disease"</strong>
                                        <br><i>8 minutes ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Johnson Momo</strong> Posted an article  <strong>"Ywhat is alzheimer disease"</strong>
                                        <br><i>an hour ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Kris</strong> Added 3 products
                                        <br><i>3 hours ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Marcsina</strong> Send you a message  <strong>"Lorem ipsum dolor..."</strong>
                                        <br><i>12 hours ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Johnny Depp</strong> Updated his avatar
                                        <br><i>Yesterday</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Ben Balaye</strong> Uploaded a photo <strong>"DSC000254.jpg"</strong>
                                        <br><i>2 minutes ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Ben Balaye</strong> Created an photo album  <strong>"what is alzheimer disease"</strong>
                                        <br><i>8 minutes ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Ben Balaye</strong> Posted an article  <strong>"what is alzheimer disease"</strong>
                                        <br><i>an hour ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>Ben Balaye</strong> Added 3 products
                                        <br><i>3 hours ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>jakie</strong> Send you a message  <strong>"Lorem ipsum dolor..."</strong>
                                        <br><i>12 hours ago</i></p>
                                        </a>
                                    </li>
                                    <li class="media">
                                        <a href="#fakelink">
                                        <p><strong>terance</strong> Updated his avatar
                                        <br><i>Yesterday</i></p>
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- End div .scroll-user-widget -->
                        </div><!-- End div .tab-pane -->
                        <!-- End Tab user activities -->
                        
                        <!-- Tab user messages -->
                        <div class="tab-pane animated fadeInRight" id="mymessage">
                            <div class="scroll-user-widget">
                                <ul class="media-list">
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">Johnson Momo</a> <small>Just now</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">Francis Kenne Wesba</a> <small>Yesterday at 04:00 AM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">Marcsina</a> <small>January 17, 2014 05:35 PM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">chris</a> <small>January 17, 2014 05:35 PM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">chris</a> <small>January 17, 2014 05:35 PM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">chris</a> <small>Just now</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">marco</a> <small>Yesterday at 04:00 AM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">marco</a> <small>January 17, 2014 05:35 PM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">prof danis</a> <small>January 17, 2014 05:35 PM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <a class="pull-left" href="#fakelink">
                                      <img class="media-object user-message" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Avatar">
                                    </a>
                                    <div class="media-body">
                                      <h4 class="media-heading"><a href="#fakelink">Dr Maria</a> <small>January 17, 2014 05:35 PM</small></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                                    </div>
                                  </li>
                                </ul>
                            </div><!-- End div .scroll-user-widget -->
                        </div><!-- End div .tab-pane -->
                        <!-- End Tab user messages -->
                    </div><!-- End div .tab-content -->
                </div><!-- End div .box-info -->
            </div>
        </div>

        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/german-porter-stemmer.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/code.js"></script>

    </body>

    <script type="text/javascript">
        
        $(function(){
    $("[data-toggle='tooltip']").tooltip();
}) 
    </script>

</html>