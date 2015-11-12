<?php 
    /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * team.php - Created: 11/11/2015
   * Overview a team's details.
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

    <title><?php echo $_GET['teamName']; ?></title>
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
                    <a class="navbar-brand" href="index.php">FIFA Dashboard </a>
                </td>
                <td>
                    <img src="img/navbar-separator.png">
                </td>
            </table>         
        </div>
    </nav>
    
    <div class="team-overview">
    <div class="blue-box">
        <?php 
        $cursor = oci_new_cursor($connection);
        $query = 'BEGIN get.team(:teamID, :cursor); END;';
        $compiled = oci_parse($connection, $query);
        oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($compiled, ':teamID', $_GET['teamID']);
        oci_execute($compiled);
        oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
        while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            echo "<br><div class = \"row\">";
            echo "<div class = \"col-md-5\">";
            if ($row['TEAMTYPE'] == 1) {
                echo "<img class=\"pull-right\" src=\"" . substr($row['FLAG'], 3) . "\"></div>";
            }
            else {
                echo "<img class=\"pull-right\" src=\"" . substr($row['LOGO'], 3) . "\"></div>";
            }
            echo "<div class = \"col-md-7\">";
            echo "<form id=\"team" . $row['TEAMID'] . "\" action=\"team.php\" method=\"GET\">";
            echo "<input type=\"hidden\" name=\"teamID\" value=\"" . $row['TEAMID'] . "\" />";
            echo "<h3 class=\"align-left\"><a href=\"#\" onclick=\"document.getElementById('team" . $row['TEAMNAME'] . "').submit();\">"
             . $row['TEAMNAME'] . "</a></h3>";
            if ($row['TEAMTYPE'] == 1) {
                echo "<p class=\"uppercase\">" . $row['COUNTRYNAME'] . "</p>";
            }
            else {
                echo "<p class=\"uppercase\">" . $row['CITYNAME'] . ", " . $row['COUNTRYNAME'] . "</p>";
            }
            
            echo "<p>Technical director: " . $row['TDNAME'] . "</p>";
            echo "<p>Captain: " . $row['CAPTAINNAME'] . "</p>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "<hr>"; 
        }
        
    oci_free_statement($compiled);
    oci_free_statement($cursor);
 ?>
 </div></div>

</body>

</html>
