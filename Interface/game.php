<?php 
    /* Proyecto II Bases de Datos - Prof. Adriana Álvarez
   * FIFAdashboard.com - Oracle
   * Alexis Arguedas, Gabriela Garro, Yanil Gómez
   * -------------------------------------------------
   * game.php - Created: 11/11/2015
   * Overview game details.
   */

    session_start(); //Start session
    $connection = oci_connect("ADMINF", "FIFA123", "(DESCRIPTION = (ADDRESS_LIST =
                        (ADDRESS = (PROTOCOL = TCP)(HOST = 172.26.50.118)(PORT = 1521)))
                        (CONNECT_DATA =(SERVICE_NAME = FIFADB)))");
    if (!$connection) {
        echo "Invalid connection " . var_dump(ocierror());
        die();
    }
    echo "In mainteneance."
?>