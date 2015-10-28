<?php
  /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * session.php - Created: 27/10/2015
   * Refreshes the connection to the db.
   */
  	//connect to the db
	$connection = oci_connect("ADMINF", "FIFA123", "(DESCRIPTION = (ADDRESS_LIST =
	                    (ADDRESS = (PROTOCOL = TCP)(HOST = 172.26.50.118)(PORT = 1521)))
	                    (CONNECT_DATA =(SERVICE_NAME = FIFADB)))");
	if (!$connection) {
	    echo "Invalid connection " . var_dump(ocierror());
	    die();
	}

	//start the session
	session_start();

	//Store userID
	$usernameID = $_SESSION['usernameID'];

	//store other usefull, future stuff


?>