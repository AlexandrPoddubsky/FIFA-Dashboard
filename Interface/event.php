<?php 
    /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * event.php - Created: 10/11/2015
   * Overview an event details.
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
                    <a class="navbar-brand" href="index.php">FIFA Dashboard </a>
                </td>
                <td>
                    <img src="img/navbar-separator.png">
                </td>
            </table>         
        </div>
    </nav>
    
    <div class="event-overview">
    <div class="blue-box">
        <?php 
        $cursor = oci_new_cursor($connection);
        $query = 'BEGIN get.getevents(:cursor); END;';
        $compiled = oci_parse($connection, $query);
        oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
        oci_execute($compiled);
        oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
        while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            if ($row['TYPENAMEID'] == $_GET['eventID']) {
                echo "<br><div class = \"row\">";
                echo "<div class = \"col-md-5\">";
                echo "<img class=\"eventPicture pull-right\" src=\"" . substr($row['PICTURE'], 3) . "\"></div>";
                echo "<div class = \"col-md-7\">";
                echo "<form id=\"event" . $row['TYPENAMEID'] . "\" action=\"event.php\" method=\"GET\">";
                echo "<input type=\"hidden\" name=\"eventID\" value=\"" . $row['TYPENAMEID'] . "\" />";
                echo "<h3 class=\"align-left\"><a href=\"#\" onclick=\"document.getElementById('event" . $row['TYPENAMEID'] . "').submit();\">"
                 . $row['TYPENAME'] . "</a></h3>";
                echo "<p class=\"uppercase\">" . $row['COUNTRY'] . "</p>";
                echo "<p>" . $row['STARTDATE'] . " - " . $row['ENDDATE'] . "</p>";
                echo "<p>" . $row['EVENTDESCRIPTION'] . "</p>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "<hr>"; 
            } 
        }
        
    oci_free_statement($compiled);
    oci_free_statement($cursor);
 ?>
 </div></div>
    <div class="teams"> 
        <br><h3>Participating teams</h3>
        <hr class="small">
        <?php 
        $cursor = oci_new_cursor($connection);
        $query = 'BEGIN get.eventTeam(:eventID, :cursor); END;';
        $compiled = oci_parse($connection, $query);
        oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($compiled, ':eventID', $_GET['eventID'], 200);
        oci_execute($compiled);
        oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
        $cont = 0;
        while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            //echo "<hr class=\"small\">";
            if ($cont%2 == 0) {
                echo "<div class = \"row\">";
            }
            echo "<div class = \"col-md-2\">";
            if ($row['TEAMTYPE'] == 1) {
                echo "<img class=\"pull-right\" src=\"" . substr($row['FLAG'], 3) . "\"></div>";
            }
            else {
                echo "<img class=\"pull-right\" src=\"" . substr($row['LOGO'], 3) . "\"></div>";
            }
            echo "<div class = \"col-md-4\">";
            echo "<form id=\"team" . $row['TYPENAMEID'] . "\" action=\"team.php\" method=\"GET\">";
            echo "<input type=\"hidden\" name=\"teamID\" value=\"" . $row['TYPENAMEID'] . "\" />";
            echo "<h2 class=\"align-left\"><a href=\"#\" onclick=\"document.getElementById('team" . $row['TYPENAMEID'] . "').submit();\">"
             . $row['TYPENAME'] . "</a></h2>";
            if ($row['TEAMTYPE'] != 1) {
                echo "<p class=\"uppercase align-left\">" . $row['CITY'] . ", " . $row['COUNTRY'] . "</p>";
            }
            echo "<p class=\"align-left gray\">Captain: " . $row['CAPTAIN'] . "</p>";
            echo "<p class=\"align-left gray\">Technical Director: " . $row['TD'] . "</p>";
            echo "</form>";
            echo "</div>";
            if ($cont%2 == 1) {
                echo "</div>";
            }
            $cont++; 
        }
        oci_free_statement($compiled);
        oci_free_statement($cursor);
        ?>
    </div>

    <div class="games">
        <br><h3>Games</h3>
        <hr class="small">
        <?php 
        $cursor = oci_new_cursor($connection);
        $query = 'BEGIN get.gamesByEvent(:eventID, :cursor); END;';
        $compiled = oci_parse($connection, $query);
        oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
        oci_bind_by_name($compiled, ':eventID', $_GET['eventID'], 200);
        oci_execute($compiled);
        oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
        $groups = array(array(0, 0, 0, 0),
                        array(0, 0, 0, 0),
                        array(0, 0, 0, 0),
                        array(0, 0, 0, 0),
                        array(0, 0, 0, 0),
                        array(0, 0, 0, 0),
                        array(0, 0, 0, 0), 
                        array(0, 0, 0, 0));
        while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            //get this event's goals
            $query1 = 'BEGIN get.goalsByGame(:gameID, :teamID, :goals1); END;';
            $compiled1 = oci_parse($connection, $query1);
            oci_bind_by_name($compiled1, ':gameID', $row['TYPENAMEID'], 5);
            oci_bind_by_name($compiled1, ':teamID', $row['TEAM1ID'], 200);
            oci_bind_by_name($compiled1, ':goals1', $goals1, 200);
            oci_execute($compiled1, OCI_NO_AUTO_COMMIT);
            oci_commit($connection);    
            $query2 = 'BEGIN get.goalsByGame(:gameID, :teamID, :goals2); END;';
            $compiled2 = oci_parse($connection, $query2);
            oci_bind_by_name($compiled2, ':gameID', $row['TYPENAMEID'], 5);
            oci_bind_by_name($compiled2, ':teamID', $row['TEAM2ID'], 200);
            oci_bind_by_name($compiled2, ':goals2', $goals2, 200);
            oci_execute($compiled2, OCI_NO_AUTO_COMMIT);
            oci_commit($connection);

            echo "<form id=\"game" . $row['TYPENAMEID'] . "\" action=\"game.php\" method=\"GET\">";
            echo "<div class=\"gray-box\"><div class = \"row\"><br>";
            echo "<input type=\"hidden\" name=\"gameID\" value=\"" . $row['TYPENAMEID'] . "\" />";
            echo "<div class = \"col-md-3\">";
            if ( $row['MINUTES'] < 10) {
                echo "<p class=\"gray\">Date: " . $row['GAMEDATE'] . " Time: " . $row['HOURS'] . ":0" . $row['MINUTES'] . "</p>";
            }
            else {
                echo "<p class=\"gray\">Date: " . $row['GAMEDATE'] . " Time: " . $row['HOURS'] . ":" . $row['MINUTES'] . "</p>";
            }
            
            $game = preg_split('/[- :]/',$row['TYPENAMEID']);
            //assign cup stage and save group IDs
            if (1 <= $game[1] and $game[1] <= 6) {
                echo "<p class=\"gray\">Group A</p>";
                if ($game[1] == 1) {
                    $groups[0][0] = $row['TEAM1ID'];
                    $groups[0][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 6) {
                    $groups[0][2] = $row['TEAM1ID'];
                    $groups[0][3] = $row['TEAM2ID'];
                }
            }
            else if (7 <= $game[1] and $game[1] <= 12 ) {
                echo "<p class=\"gray\">Group B</p>";
                if ($game[1] == 7) {
                    $groups[1][0] = $row['TEAM1ID'];
                    $groups[1][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 12) {
                    $groups[1][2] = $row['TEAM1ID'];
                    $groups[1][3] = $row['TEAM2ID'];
                }
            }
            else if (13 <= $game[1] and $game[1] <= 18 ) {
                echo "<p class=\"gray\">Group C</p>";
                if ($game[1] == 13) {
                    $groups[2][0] = $row['TEAM1ID'];
                    $groups[2][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 18) {
                    $groups[2][2] = $row['TEAM1ID'];
                    $groups[2][3] = $row['TEAM2ID'];
                }
            }
            else if (19 <= $game[1] and $game[1] <= 24 ) {
                echo "<p class=\"gray\">Group D</p>";
                if ($game[1] == 19) {
                    $groups[3][0] = $row['TEAM1ID'];
                    $groups[3][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 24) {
                    $groups[3][2] = $row['TEAM1ID'];
                    $groups[3][3] = $row['TEAM2ID'];
                }
            }
            else if (25 <= $game[1] and $game[1] <= 30 ) {
                echo "<p class=\"gray\">Group E</p>";
                if ($game[1] == 25) {
                    $groups[4][0] = $row['TEAM1ID'];
                    $groups[4][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 30) {
                    $groups[4][2] = $row['TEAM1ID'];
                    $groups[4][3] = $row['TEAM2ID'];
                }
            }
            else if (31 <= $game[1] and $game[1] <= 36 ) {
                echo "<p class=\"gray\">Group F</p>";
                if ($game[1] == 31) {
                    $groups[5][0] = $row['TEAM1ID'];
                    $groups[5][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 36) {
                    $groups[5][2] = $row['TEAM1ID'];
                    $groups[5][3] = $row['TEAM2ID'];
                }
            }
            else if (37 <= $game[1] and $game[1] <= 42 ) {
                echo "<p class=\"gray\">Group G</p>";
                if ($game[1] == 37) {
                    $groups[6][0] = $row['TEAM1ID'];
                    $groups[6][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 42) {
                    $groups[6][2] = $row['TEAM1ID'];
                    $groups[6] = $row['TEAM2ID'];
                }
            }
            else if (43 <= $game[1] and $game[1] <= 48 ) {
                echo "<p class=\"gray\">Group H</p>";
                if ($game[1] == 43) {
                    $groups[7][0] = $row['TEAM1ID'];
                    $groups[7][1] = $row['TEAM2ID'];
                }
                else if ($game[1] == 48) {
                    $groups[7][2] = $row['TEAM1ID'];
                    $groups[7][3] = $row['TEAM2ID'];
                }
            }
            else if (37 <= $game[1] and $game[1] <= 42 ) {
                echo "<p class=\"gray\">Group G</p>";
            }
            else if (49 <= $game[1] and $game[1] <= 56 ) {
                echo "<p class=\"gray\">Second Round</p>";
            }
            else if (61 <= $game[1] and $game[1] <= 62 ) {
                echo "<p class=\"gray\">Semifinals</p>";
            }
            else if (63 == $game[1]) {
                echo "<p class=\"gray\">Third place</p>";
            }
            else if (64 == $game[1]) {
                echo "<p class=\"gray\">Final</p>";
            }
            echo "<p class=\"gray\">Stadium: " . $row['STADIUM'] . ", " . $row['CITY'] . "</p>";
            echo "</div>";
            echo "<div class = \"col-md-1\">";
            echo "<div class = \"team-flag1\"><img src=\"" . substr($row['TEAM1FLAG'], 3) ."\"></div>";
            echo "</div>";
            echo "<div class = \"col-md-2\">";
            echo "<h2 class=\"pull-left\">" . $row['TEAM1NAME'] . "</h2>";
            echo "</div>";
            echo "<div class = \"col-md-2\">";
            echo "<p class=\"gray\">Score:" . "</p>";
            echo "<h2 class=\"gray\">" . $goals1 . " - " . $goals2 . "</h2>";
            echo "</div>";
            echo "<div class = \"col-md-2\">";
            echo "<h3 class=\"pull-right\">" . $row['TEAM2NAME'] . "</h3>";
            echo "</div>";
            echo "<div class = \"col-md-1\">";
            echo "<div class = \"team-flag2\"><img src=\"" . substr($row['TEAM2FLAG'], 3) ."\"></div>";
            echo "</div>";
            echo "</div>";
            echo "<br><p><a href=\"#\" onclick=\"document.getElementById('game" . $row['TYPENAMEID'] . "').submit();\">"
             . "See details...</a></p>";
            echo "</div>";
            echo "</form><br>";
        }
        oci_free_statement($compiled);
        oci_free_statement($cursor);
        ?>
    </div>

    <div class="groups">
    <br><h3>Groups</h3>
    <hr class="small">
    <?php
    for ($i = 0; $i <= 7; $i++) {
        echo "<div class=\"panel panel-default\">
                        <div class=\"panel-heading uppercase\">
                            Group ";
        if ($i == 0) {
            echo "A";
        }
        else if ($i == 1) {
            echo "B";
        }
        else if ($i == 2) {
            echo "C";
        }
        else if ($i == 3) {
            echo "D";
        }
        else if ($i == 4) {
            echo "E";
        }
        else if ($i == 5) {
            echo "F";
        }
        else if ($i == 6) {
            echo "G";
        }
        else if ($i == 7) {
            echo "H";
        }
        echo "</div>
        <div class=\"panel-body\">
            <div class=\"table-responsive\">
                <table class=\"table table-hover\">
                    <thead>
                        <tr class=\"uppercase\">
                            <th></th>
                            <th>TEAM</th>
                            <th>MP</th>
                            <th>W</th>
                            <th>D</th>
                            <th>L</th>
                            <th>GF</th>
                            <th>GA</th>
                            <th>+/-</th>
                            <th>FPP</th>
                            <th>Pts</th>
                        </tr>
                    </thead>
                    <tbody>";
        for ($j = 0; $j <= 3; $j++) {
            if ($groups[$i][$j] > 0) {
                echo "<tr>";
                $query = 'BEGIN get.statisticsbygroupteam(:teamID, :eventID, :teamName, :teamFlag, :pmp); END;';
                $compiled = oci_parse($connection, $query);
                oci_bind_by_name($compiled, ':teamID', $groups[$i][$j], 10);
                oci_bind_by_name($compiled, ':eventID', $_GET['eventID'], 200);
                oci_bind_by_name($compiled, ':teamName', $teamName, 200);
                oci_bind_by_name($compiled, ':teamFlag', $teamFlag, 200);
                oci_bind_by_name($compiled, ':pmp', $pmp, 200);
                oci_execute($compiled, OCI_NO_AUTO_COMMIT);
                oci_commit($connection);
                echo "<td><div class=\"table-flag\"><img src='" . substr($teamFlag, 3) . "'></div></td>";
                echo "<td>" . $teamName . "</td>";
                echo "<td>" . $pmp . "</td>"; 
                $cursor = oci_new_cursor($connection);
                $query = 'BEGIN get.matchesPlayed(:teamID, :eventID, :cursor); END;';
                $compiled = oci_parse($connection, $query);
                oci_bind_by_name($compiled, ':cursor', $cursor, -1, OCI_B_CURSOR);
                oci_bind_by_name($compiled, ':teamID', $groups[$i][$j], 200);
                oci_bind_by_name($compiled, ':eventID', $_GET['eventID'], 200);
                oci_execute($compiled);
                oci_execute($cursor, OCI_DEFAULT);       //execute the cursor like a normal statement
                //$matchesPlayed = array();
                $opponent = 0;
                $matchesWon = 0;
                $matchesTied = 0;
                $matchesLost = 0;
                $goalsFor = 0;
                $goalsAgainst = 0;
                while (($row = oci_fetch_array($cursor, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                    //array_push($matchesPlayed, $row['GAMEID']);
                    if ($row['TEAM1ID'] == $groups[$i][$j]) {
                        $opponent = $row['TEAM2ID'];
                    }
                    else {
                        $opponent = $row['TEAM1ID'];
                    }
                    $query1 = 'BEGIN get.goalsByGame(:gameID, :teamID, :goals1); END;';
                    $compiled1 = oci_parse($connection, $query1);
                    oci_bind_by_name($compiled1, ':gameID', $row['GAMEID'], 5);
                    oci_bind_by_name($compiled1, ':teamID', $groups[$i][$j], 200);
                    oci_bind_by_name($compiled1, ':goals1', $goals1, 200);
                    oci_execute($compiled1, OCI_NO_AUTO_COMMIT);
                    oci_commit($connection);    
                    $query2 = 'BEGIN get.goalsByGame(:gameID, :teamID, :goals2); END;';
                    $compiled2 = oci_parse($connection, $query2);
                    oci_bind_by_name($compiled2, ':gameID', $row['GAMEID'], 5);
                    oci_bind_by_name($compiled2, ':teamID', $opponent, 200);
                    oci_bind_by_name($compiled2, ':goals2', $goals2, 200);
                    oci_execute($compiled2, OCI_NO_AUTO_COMMIT);
                    oci_commit($connection);
                    if ($goals1 > $goals2) {
                        $matchesWon++;
                    }
                    else if ($goals1 == $goals2) {
                        $matchesTied++;
                    }
                    else if ($goals1 < $goals2) {
                        $matchesLost++;
                    }
                    $goalsFor += $goals1;
                    $goalsAgainst += $goals2;
                }
                oci_free_statement($compiled);
                oci_free_statement($cursor);
                $goalDifference = $goalsFor - $goalsAgainst;
                echo "<td class=\"matchesWon\">" . $matchesWon . "</td>";
                echo "<td>"     .$matchesTied . "</td>";
                echo "<td>" . $matchesLost . "</td>";
                echo "<td>" . $goalsFor . "</td>";
                echo "<td>" . $goalsAgainst . "</td>";
                echo "<td>" . $goalDifference . "</td>";
                echo "<td>0</td>";
                $points = 3 * $matchesWon + $matchesTied;
                echo "<td>" . $points . "</td>";
                echo "</tr>";
            }
        }
        echo "</tbody>
                    </table>
                </div>
            </div>
        </div>";
    }
    ?>
    </div>    

</body>

</html>
