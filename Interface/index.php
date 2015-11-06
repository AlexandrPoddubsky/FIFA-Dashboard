<?php 
    /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * index.php - Created: 23/10/2015
   * Acts as the website's homepage, from where you can access if you are an administrator or access the 
   * game's statistics and view events.
   */

    session_start(); //Start session
    //--------------------Sign in---------------------
    if (isset($_POST['submit'])) {//check if the form was sent

        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['loginerror'] = "Username or password is invalid";
        }
        else { //establish a connection to the db
            $connection = oci_connect("ADMINF", "FIFA123", "(DESCRIPTION = (ADDRESS_LIST =
                                (ADDRESS = (PROTOCOL = TCP)(HOST = 172.26.50.118)(PORT = 1521)))
                                (CONNECT_DATA =(SERVICE_NAME = FIFADB)))");
            if (!$connection) {
                echo "Invalid connection " . var_dump(ocierror());
                die();
            }

            // gets values from index.php
            $email = $_POST['email'];
            $usernameID = 0;    //variable to store the usernameID
            $password = "";

            //ask the db to check for if the password matches this email
            $query = 'BEGIN getpassword(:email, :pass); END;';
            $compiled = oci_parse($connection, $query);
            oci_bind_by_name($compiled, ':email', $email, 50);
            oci_bind_by_name($compiled, ':pass', $password, 200);
            oci_execute($compiled, OCI_NO_AUTO_COMMIT);
            oci_commit($connection);
            $_SESSION['email'] = $_POST['email']; //store the user's email

            if ($password == md5($_POST['password'])) { //if the password+email combination was correct
                //get the ID related to this email
                $query = 'BEGIN getID(:email, :usernameID); END;';
                $compiled = oci_parse($connection, $query);
                oci_bind_by_name($compiled, ':email', $email, 50);
                oci_bind_by_name($compiled, ':usernameID', $usernameID, 5);
                oci_execute($compiled, OCI_NO_AUTO_COMMIT);
                oci_commit($connection);

                //Store the user ID
                $_SESSION['usernameID'] = $usernameID;

                header("Location: pages/index.php");
            }
            else {  //if the combination username+password were denied by the db
                $_SESSION['loginerror'] = "Username and password combination were invalid.";
            }
            oci_close($connection);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FIFA Dashboard</title>
    <link rel="shortcut icon" href= "img/icon.png">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top"  onclick = $("#menu-close").click(); ><h1>FIFA Dashboard</h1></a>
            </li>
            <li>
                <a href="#top" onclick = $("#menu-close").click(); >Home</a>
            </li>
            <li>
                <a href="#about" onclick = $("#menu-close").click(); >About</a>
            </li>
            <li>
                <a href="#services" onclick = $("#menu-close").click(); >Services</a>
            </li>
            <li>
                <a href="#" class="btn-link" data-toggle="modal" data-target="#signInModal">Sign In</a>
            </li>
            <li>
                <a href="#contact" onclick = $("#menu-close").click(); >Contact</a>
            </li>
        </ul>
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <div class="orange-box">
                <br><h1><span>FIFA Dashboard</span></h1>
                <h3><span>A real-time statistics center for your favorite football cups</span></h3><br>
            </div><br>
            <a href="#about" class="btn btn-dark btn-lg">Find Out More</a>
            
        </div>
        <div class="pull-down-center">
            <img src="img/logo white.png" alt="FIFA Dashboard">
        </div>
    </header>
        
    

    <!-- About -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img src="img/logo.png">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h2>About</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-futbol-o fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Teams</strong>
                                </h4>
                                <p>Things you can see about teams.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-user fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Players</strong>
                                </h4>
                                <p>Things you can see about players.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-trophy fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>World cups and club tournaments around the world</strong>
                                </h4>
                                <p>Information about every soccer world cup and club tournament.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-line-chart fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Game statistics</strong>
                                </h4>
                                <p>Statistics features here.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Map -->
    <!--<section id="contact" class="map">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small>
            <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
        </small>
        </iframe>
    </section>-->

    <!-- Footer -->
    <footer><div id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>FIFA Dashboard</strong>
                    </h4>
                    <p>Bases de Datos I - Tecnológico de Costa Rica</p>
                    <ul class="list-unstyled">
                        <li>Gabriela Garro Abdykerimov <i class="fa fa-envelope-o fa-fw"></i>  
                        <a href="mailto:name@example.com">ggarroab@gmail.com</a></li>
                        <li>Alexis Arguedas Cruz <i class="fa fa-envelope-o fa-fw"></i>  
                        <a href="mailto:name@example.com">aarguedas@gmail.com</a></li>
                        <li>Yanil Gómez Navarro <i class="fa fa-envelope-o fa-fw"></i>  
                        <a href="mailto:name@example.com">yanil.gomeznav@gmail.com</a></li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="https://github.com/gabygarro/fifa-dashboard/"><i class="fa fa-github fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; FIFA Dashboard 2015</p>
                </div>
            </div>
        </div></div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

    <!--SIGN IN MODAL-->
   <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <a type="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times fa-2x"></i></span></a>
               <h1 class="modal-title" id="myModalLabel">Sign in</h1>
            </div>
            <div class="modal-body">
               <form role="form" action="index.php" method="POST" class="registration-form">
                  <div class="form-group">
                  <div class="error">
                     <?php //in case there's an error
                        if (isset($_SESSION['loginerror'])) echo $_SESSION['loginerror']  . "<br>";
                     ?>
                  </div>
                    <label for="form-email">Email</label>
                    <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="form-email">
                  </div>
                  <div class = "form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name ="password" class="form-control" id="exampleInputPassword1" placeholder="Password...">
                  </div>
                <div class="modal-footer">
                        <div class = "container">
                        <div class ="row">
                           <div class = "col-md-2">
                              <button type="button" class="btn btn-dark btn-lg" data-dismiss="modal">Close</button>
                           </div>
                           <div class = "col-md-2">
                              <input name = "submit" class="btn btn-dark btn-lg" type = "submit" value = "Sign in">
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <?php //auto pop-up the sign in modal in case there was an error
        if (!empty($_SESSION['loginerror'])) {
            echo "<script type=\"text/javascript\">
                $(window).load(function(){
                    $('#signInModal').modal('show');
                });</script>";
            $_SESSION['loginerror'] = "";
        }
    ?>

</body>

</html>
