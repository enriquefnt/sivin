<?php
use DataTables

class SivinMigra {
 
    private  $siviViejo;
    private  $siviNuevo;
   

public function __construct() {
 //  $pdoV = new \PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
   $pdoV =  new \PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@111@sa!·%220');

   
   $pdoN = new \PDO('mysql:host=212.1.210.51;dbname=saltaped_sivin; charset=utf8', 'saltaped_sivinsalta', 'sivin7625');

   $this->tablaBenef = new \ClassGrl\DataTables($pdo,'datos_benef', 'id_datos_benef');
   $this->tablaPedi =new \ClassGrl\DataTables($pdo,'datos_pedido', 'id_datos_pedido');
   $this->tablaUser = new \ClassGrl\DataTables($pdo, 'datos_usuarios','id_usuario' );
   $this->tablaLoc = new \ClassGrl\DataTables($pdo,'datos_localidad', 'gid');
   $this->tablaInsti = new \ClassGrl\DataTables($pdo,'datos_institucion', 'codi_esta');
   $this->authentication = new \ClassGrl\Authentication($this->tablaUser,'user', 'password'); 
   $this->Imprime = new \ClassPart\Controllers\Imprime();
   
}
}