<?php
  /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * index.php - Created: 04/11/2015
   * View and edit teams, players, everything. Receives a submitted form from index.php
   */
    include('../session.php');
    if(!isset($_SESSION['usernameID'])) {
        header("Location: ../index.php#notloggedin");
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

    <title>
        <?php 
            if (isset($_POST['name'])) {
                echo "View " . $_POST['name'];
            }
            else {
                echo "View";
            }
        ?>
    </title>
    <link rel="shortcut icon" href= "../img/icon.png">

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        //add or delete a picture depending on the type of team the user is trying to input
        function changePictures(value) {
            if (value == "2") {
                var teamPictures = document.getElementById("team-pictures");
                var title = document.createElement("h3");
                title.id = "logoTitle";
                title.innerHTML = "Team logo";
                teamPictures.appendChild(title);
                var inputPicture = document.createElement("input");
                inputPicture.type = "file";
                inputPicture.name = "teamLogo";
                inputPicture.id = "teamLogo";
                inputPicture.accept = "image/*";
                teamPictures.appendChild(inputPicture);
                document.getElementById("teamLogo").className = "form-control";
            }
            else if (value == "1") {
                if (!!document.getElementById("teamLogo")) {
                    var logoTitle = document.getElementById("logoTitle");
                    logoTitle.parentNode.removeChild(logoTitle);
                    var inputPicture = document.getElementById("teamLogo");
                    inputPicture.parentNode.removeChild(inputPicture);
                }
                    
            }
        }
        //City-country logic
        <?php 
            $countryArray = array();
            $countryArrayValues = array();
            $string = ""; // string that goes on to be echoed to declare the countries array
            $values = ""; //string to store the country values
            $cursor = oci_new_cursor($connection);
            $query = 'BEGIN getCatalog.country(:cursor); END;';
            $compiled = oci_parse($connection, $query);
            oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
            oci_execute($compiled);
            oci_execute($cursor, OCI_DEFAULT);
            $count = 1;
            //output the code to $string and save the country name to our own array
            while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                $string = $string . "\"" .  $row['TYPENAME'] . "\", ";
                $countryArray[$count] = $row['TYPENAME'];
                $values = $values . "\"" . $row['TYPENAMEID'] . "\", ";
                $countryArrayValues[$count] = $row['TYPENAMEID'];
                $count++;
            }
            oci_free_statement($compiled);
            oci_free_statement($cursor);
            //remove the last comma
            $string = substr($string, 0, -2);
            $values = substr($values, 0, -2);
            echo "var countryArray = new Array(" . $string . ");";
            echo "var countryArrayValues= new Array(" . $values . ");";
        ?>
        var citiesArray = new Array();
        var citiesArrayValues = new Array();
        citiesArray[0] = "";
        <?php
            //start assigning cities to countries
            for ($i = 1; $i <= count($countryArrayValues); $i++) {
                $countryID = $countryArrayValues[$i];
                $string = "";
                $values = "";
                $cursor = oci_new_cursor($connection);
                $query = 'BEGIN getCatalog.city(:countryID, :cursor); END;';
                $compiled = oci_parse($connection, $query);
                oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
                oci_bind_by_name($compiled, ':countryID', $countryID, 50);
                oci_execute($compiled);
                oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
   
                while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                    $string = $string . $row['TYPENAME'] . "|";
                    $values = $values . $row['TYPENAMEID'] . "|";
                }
                oci_free_statement($compiled);
                oci_free_statement($cursor);
                $string = substr($string, 0, -1);
                $values = substr($values, 0, -1);
                echo "citiesArray[" . $i . "] = \"" . $string . "\";\n";
                echo "citiesArrayValues[" . $i . "] = \"" . $values . "\";\n";
            }
        ?>

        function populateStates( countryElementId, stateElementId ) {
            var selectedCountryIndex = document.getElementById( countryElementId ).selectedIndex;
            var stateElement = document.getElementById( stateElementId );
            stateElement.length=0;  // Fixed by Julian Woods
            stateElement.options[0] = new Option('Select State','');
            stateElement.selectedIndex = 0;
            
            var state_arr = citiesArray[selectedCountryIndex].split("|");
            var state_arr_values = citiesArrayValues[selectedCountryIndex].split("|");
            
            for (var i=0; i<state_arr.length; i++) {
                stateElement.options[stateElement.length] = new Option(state_arr[i],state_arr_values[i]);
            }
        }

        function populateCountries(countryElementId, stateElementId){
            // given the id of the <select> tag as function argument, it inserts <option> tags
            var countryElement = document.getElementById(countryElementId);
            countryElement.length = 0;
            countryElement.options[0] = new Option('Select Country','-1');
            countryElement.selectedIndex = 0;
            for (var i = 0; i < countryArray.length; i++) {
                countryElement.options[countryElement.length] = new Option(countryArray[i],countryArrayValues[i]);
            }

            // Assigned all countries. Now assign event listener for the states.

            if( stateElementId ){
                countryElement.onchange = function(){
                    populateStates(countryElementId, stateElementId );
                };
            }
        }
        //selection-player logic
        <?php 
            $selectionArray = array();
            $selectionArrayValues = array();
            $string = ""; // string that goes on to be echoed to declare the countries array
            $values = ""; //string to store the country values
            $cursor = oci_new_cursor($connection);
            $query = 'BEGIN get.selections(:cursor); END;';
            $compiled = oci_parse($connection, $query);
            oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
            oci_execute($compiled);
            oci_execute($cursor, OCI_DEFAULT);
            $count = 1;
            //output the code to $string and save the selection name to our own array
            while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                $string = $string . "\"" .  $row['TYPENAME'] . "\", ";
                $selectionArray[$count] = $row['TYPENAME'];
                $values = $values . "\"" . $row['TYPENAMEID'] . "\", ";
                $selectionArrayValues[$count] = $row['TYPENAMEID'];
                $count++;
            }
            oci_free_statement($compiled);
            oci_free_statement($cursor);
            //remove the last comma
            $string = substr($string, 0, -2);
            $values = substr($values, 0, -2);
            echo "var selectionArray = new Array(" . $string . ");";
            echo "var selectionArrayValues= new Array(" . $values . ");";
        ?>
        var playersArray = new Array();
        var playersArrayValues = new Array();
        playersArray[0] = "";
        <?php
            //start assigning players to selections
            for ($i = 1; $i <= count($selectionArrayValues); $i++) {
                $selectionID = $selectionArrayValues[$i];
                $string = "";
                $values = "";
                $cursor = oci_new_cursor($connection);
                $query = 'BEGIN get.playerBySelection(:selectionID, :cursor); END;';
                $compiled = oci_parse($connection, $query);
                oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
                oci_bind_by_name($compiled, ':selectionID', $selectionID, 50);
                oci_execute($compiled);
                oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
   
                while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                    $string = $string . $row['TYPENAME'] . "|";
                    $values = $values . $row['TYPENAMEID'] . "|";
                }
                oci_free_statement($compiled);
                oci_free_statement($cursor);
                $string = substr($string, 0, -1);
                $values = substr($values, 0, -1);
                echo "playersArray[" . $i . "] = \"" . $string . "\";\n";
                echo "playersArrayValues[" . $i . "] = \"" . $values . "\";\n";
            }
        ?>

        function populatePlayers( selectionElementId, playerElementId ) {
            var selectedSelectionIndex = document.getElementById( selectionElementId ).selectedIndex;
            var playerElement = document.getElementById( playerElementId );
            playerElement.length=0; 
            playerElement.options[0] = new Option('Select Player','');
            playerElement.selectedIndex = 0;
            
            var player_arr = playersArray[selectedSelectionIndex].split("|");
            var player_arr_values = playersArrayValues[selectedSelectionIndex].split("|");
            
            for (var i=0; i<player_arr.length; i++) {
                playerElement.options[playerElement.length] = new Option(player_arr[i],player_arr_values[i]);
            }
        }

        function populateSelections(selectionElementId, playerElementId){
            // given the id of the <select> tag as function argument, it inserts <option> tags
            var selectionElement = document.getElementById(selectionElementId);
            selectionElement.length = 0;
            selectionElement.options[0] = new Option('Select a Country Selection','-1');
            selectionElement.selectedIndex = 0;
            for (var i = 0; i < selectionArray.length; i++) {
                selectionElement.options[selectionElement.length] = new Option(selectionArray[i],selectionArrayValues[i]);
            }

            // Assigned all selections. Now assign event listener for the players.

            if( playerElementId ){
                selectionElement.onchange = function(){
                    populatePlayers(selectionElementId, playerElementId );
                };
            }
        }
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="pull-left">
                    <img src="../img/logo.png">
                    <a class="navbar-brand" href="index.php">FIFA - Admin Dashboard</a>
                </div>
                
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                        <!-- <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                        </li>-->
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Teams<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#createNewTeamModal">Create new team</a>
                                </li>
                                <form id="teams" action="view.php" method="POST" class="nav nav-second-level">
                                <li>
                                    <input type="hidden" name="name" value="Teams">
                                    <a href="#" onclick="document.getElementById('teams').submit();">View and edit registered teams</a>
                                </li>
                                </form>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Players<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#registerNewPlayerModal">Register new player</a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#assignPlayerToSelectionModal">Assign player to Selection</a>
                                </li>
                                <li>
                                    <a href="#">View and edit registered players</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-university fa-fw"></i> Stadiums<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#registerNewStadiumModal">Register New Stadium</a>
                                </li>
                                <li>
                                    <a href="#">View and edit stadiums (not implemented)</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bullhorn fa-fw"></i> Technical directors<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#registerNewTechnicalDirectorModal">Register New Technical Director</a>
                                </li>
                                <li>
                                    <a href="#">View and edit tds (not implemented)</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                    if (isset($_POST['name'])) {
                        echo "<h1 class=\"page-header\">" . $_POST['name'] . "</h1>";
                    }
                    else {
                        echo "<p>Please select a category to view on the right.</p>";
                    }
                    ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container"><?php
            if (isset($_POST['name'])) {
                if ($_POST['name'] == "Teams") {
                    $cursor = oci_new_cursor($connection);
                    $query = 'BEGIN get.teams(:cursor); END;';
                    $compiled = oci_parse($connection, $query);
                    oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
                    oci_execute($compiled);
                    oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
                    while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                        echo "<div class = \"row\">";
                        echo "<div class = \"col-md-2\">";
                        if ($row['TEAMTYPE'] == "Club") {
                            echo "<div class = \"thumbnail-container\"><div class = \"thumbnail\"><img src =" . $row['LOGO'] . "></div></div>";
                        }
                        else {
                            echo "<div class = \"thumbnail-container\"><div class = \"thumbnail\"><img src =" . $row['FLAG'] . "></div></div>";
                        }
                        echo "</div>";
                        echo "<div class = \"col-md-8\">";
                        echo "<form id=\"team" . $row['TEAMID'] . "\" action=\"edit.php\" method=\"POST\">";
                        echo "<input type=\"hidden\" name=\"team\" value=\"" . $row['TEAMID'] . "\" />";
                        echo "<h3>" . $row['TEAMNAME'] . "</h3>";
                        if ($row['TEAMTYPE'] == "Club") {
                            echo "<p>" . $row['CITY'] . ", " . $row['COUNTRY'] . "</p>";
                        }
                        else {
                            echo "<p>" . $row['COUNTRY'] . "</p>";
                        }
                        echo "<p>" . $row['TEAMTYPE'] . "</p>";
                        echo "</div>";
                        echo "<div class = \"col-md-2\">";
                        echo "<input type=\"submit\" class=\"btn btn-default\" value=\"Modify\">";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "<hr>"; 
                    }
                    oci_free_statement($compiled);
                    oci_free_statement($cursor);
                }
            }
            ?></div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!--CREATE NEW TEAM MODAL-->
    <div class="modal fade" id="createNewTeamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times fa-2x"></i></span></a>
                    <h1>Register New Team</h1>
                </div>
                <div class="modal-body">
                    <form role="form" action="index.php" method="POST" class="registration-form" enctype="multipart/form-data">
                        <div class="error">
                            <?php //in case there's an error
                                if (isset($_SESSION['newTeamError'])) echo $_SESSION['newTeamError']  . "<br>";
                            ?>
                        </div>
                        <h3>Choose team type <b> *</b></h3>
                        <select name="teamType" id="teamType" onchange="changePictures(this.value)" class="form-email form-control">
                            <option>Select team type</option>
                            <option value="1">Country selection</option>
                            <option value="2">Club</option>
                        </select>
                        <div class="team-pictures" id="team-pictures">
                            <h3>Team flag <b> *</b></h3>
                            <input type="file" name="teamFlag" id = "teamFlag" accept="image/*" class="form-control">
                        </div>
                        <div class="form-group">
                            <h3>Team name <b> *</b></h3>
                            <input type="text" name="teamName" placeholder="Team name..." class="form-control" value="" autocomplete="off">
                            <div class="row">
                                <div class = "col-md-6">
                                    <h3>Country <b> *</b></h3>
                                    <select id="country" name ="country" class="form-control"></select>
                                </div>
                                <div class = "col-md-6">
                                    <h3>City <b> *</b></h3>
                                    <select name ="state" id ="state" class="form-control"></select>
                                    <script>
                                        populateCountries("country", "state");
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class = "container">
                            <div class ="row">
                                <div class = "col-md-2">
                                    <button type="button" class="btn btn-dark btn-lg" data-dismiss="modal">Close</button>
                                </div>
                                <div class = "col-md-2">
                                    <input name = "newTeam" class="btn btn-dark btn-lg" type = "submit" value = "Register team">
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
