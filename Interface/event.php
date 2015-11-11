<?php 
    /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * event.php - Created: 23/10/2015
   * Acts as the website's homepage, from where you can access if you are an administrator or access the 
   * game's statistics and view events.
   */

    session_start(); //Start session
    $connection = oci_connect("ADMINF", "FIFA123", "(DESCRIPTION = (ADDRESS_LIST =
                        (ADDRESS = (PROTOCOL = TCP)(HOST = 172.26.50.118)(PORT = 1521)))
                        (CONNECT_DATA =(SERVICE_NAME = FIFADB)))");
    if (!$connection) {
        echo "Invalid connection " . var_dump(ocierror());
        die();
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
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <table class="nav">
                <td>
                    <img src="img/logo.png">
                </td>
                <td>
                    <a class="navbar-brand" href="event.php">FIFA Dashboard </a>
                </td>
                <td>
                    <img src="img/navbar-separator.png">
                </td>
            </table>         
        </div>
    </nav>
    <br>
    <div class="event-overview">
    <div class="container">
        <?php 
        $cursor = oci_new_cursor($connection);
        $query = 'BEGIN get.getevents(:cursor); END;';
        $compiled = oci_parse($connection, $query);
        oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
        oci_execute($compiled);
        oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
        while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            if ($row['TYPENAMEID'] == $_GET['eventID']) {
                echo "<div class = \"row\">";
                echo "<div class = \"col-md-5\">";
                echo "<img class=\"eventPicture pull-right\" src=\"" . substr($row['PICTURE'], 3) . "\"></div>";
                echo "<div class = \"col-md-7\">";
                echo "<form id=\"event" . $row['TYPENAMEID'] . "\" action=\"event.php\" method=\"GET\">";
                echo "<input type=\"hidden\" name=\"eventID\" value=\"" . $row['TYPENAMEID'] . "\" />";
                echo "<h3 class=\"align-left\"><a href=\"#\" onclick=\"document.getElementById('event" . $row['TYPENAMEID'] . "').submit();\">"
                 . $row['TYPENAME'] . "</a></h3>";
                echo "<p class=\"uppercase align-left\">" . $row['COUNTRY'] . "</p>";
                echo "<p class=\"align-left gray\">" . $row['STARTDATE'] . " - " . $row['ENDDATE'] . "</p>";
                echo "<p class=\"align-left gray\">" . $row['EVENTDESCRIPTION'] . "</p>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "<hr>"; 
            } 
        }
        
    oci_free_statement($compiled);
    oci_free_statement($cursor);
 ?></div></div>
    <div class="teams">
        <h3>Participating teams</h3>
        <hr class="small">
        <?php 
        $cursor = oci_new_cursor($connection);
        $query = 'BEGIN get.eventTeam(:eventID, :cursor); END;';
        $compiled = oci_parse($connection, $query);
        oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($compiled, ':eventID', $_GET['eventID'], 200);
        oci_execute($compiled);
        oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
        while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            echo "<div class = \"row\">";
            echo "<div class = \"col-md-5\">";
            if ($row['TEAMTYPE'] == 1) {
                echo "<img class=\"pull-right\" src=\"" . substr($row['FLAG'], 3) . "\"></div>";
            }
            else {
                echo "<img class=\"pull-right\" src=\"" . substr($row['LOGO'], 3) . "\"></div>";
            }
            echo "<div class = \"col-md-7\">";
            echo "<form id=\"team" . $row['TYPENAMEID'] . "\" action=\"team.php\" method=\"GET\">";
            echo "<input type=\"hidden\" name=\"eventID\" value=\"" . $row['TYPENAMEID'] . "\" />";
            echo "<h2 class=\"align-left\"><a href=\"#\" onclick=\"document.getElementById('team" . $row['TYPENAMEID'] . "').submit();\">"
             . $row['TYPENAME'] . "</a></h2>";
            if ($row['TEAMTYPE'] != 1) {
                echo "<p class=\"uppercase align-left\">" . $row['CITY'] . ", " . $row['COUNTRY'] . "</p>";
            }
            echo "<p class=\"align-left gray\">Captain: " . $row['CAPTAIN'] . "</p>";
            echo "<p class=\"align-left gray\">Technical Director: " . $row['TD'] . "</p>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "<hr class=\"small\">"; 
        }
        oci_free_statement($compiled);
        oci_free_statement($cursor);
    ?>
    </div>

</body>

</html>
