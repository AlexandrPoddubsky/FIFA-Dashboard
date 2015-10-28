<?php
	/* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * logout.php - Created: 27/10/2015
   * Logs the administrator out from the app.
   */
	session_start(); //start the session so that it can be destroyed
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: ../index.php#loggedout"); // Redirecting To Home Page
	}
	oci_close($connection); //close the db connection
?>