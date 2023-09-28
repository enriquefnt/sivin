<!-- SiviMigra.php -->
<?php
require_once('DataTables.php');

class DatabaseMigrator {
  
  private $origenDB;
  private $destinoDB;
  private $domicilio;
  
  public function __construct(DataTables $origenDB,DataTables $destinoDB, DataTables $domicilio) {
   
      $this->origenDB = $origenDB;
      $this->destinoDB = $destinoDB;
      $this->domicilio = $domicilio;
         }
  

         public function migrateTable($origenTable, $destinoTable) {
          $origenData = $this->origenDB->findAll($origenTable); // Leer datos de la tabla origen
       //   var_dump($origenData); 
          $totalRecords = $this->origenDB->total($origenTable);
          $offset = 0;
          foreach ($origenData as $row) {
              $mappedRow = $this->mapColumns($row); // Mapear nombres de columnas
              $this->destinoDB->save($mappedRow); // Insertar en tabla destino
      $offset++;
      $progress = ($offset / $totalRecords) * 100;

      // Enviar el progreso como respuesta AJAX
      echo('<p>Progreso: ' . number_format($progress, 2) . '%</p>');

      // Flushear el búfer de salida para enviar la información al navegador inmediatamente
      ob_flush();
      flush();
    }
  }
  
  
  private function mapColumns($origenRow) {
    // Aquí defines el mapeo de nombres de columnas entre las tablas origen y destino.
    // Por ejemplo, si la tabla origen tiene 'nombre' y la tabla destino espera 'nombre_completo':
    if ( $origenRow['Sexo']=="Femenino"){$origenRow['Sexo']=2;} else{$origenRow['Sexo']=1;};
    $apenom = $this->separar_nombres($origenRow['ApeNom']);
    $residencia = $this->domicilio->findById($origenRow['IdNiño']);
    $mappedRow = array(
        'RegistroId' => $origenRow['IdNiño'],
        'RegistroAoResidId' => $origenRow['Aoresi'],
        'RegistroNomCompleto' => $origenRow['ApeNom'],
        'RegistroNroDocumento' => $origenRow['Dni'],
        'RegistroFecha' => $origenRow['FechaCapta'],
        'RegistroFchNac' => $origenRow['FechaNto'],
        'RegistroPeso' => $origenRow['Peso'],
        'RegistroSemGestacion' => $origenRow['Semanas'],
        'SexoId' => $origenRow['Sexo'],
        'RegistroTalla' => $origenRow['Talla'],
        'EtniaId' => $origenRow['TpoEtnia'],
        'RegistroUsuCarga' => $origenRow['UsuId'],
        'RegistroFchIns' => 'NULL',
        'MotivoCargaId' => 'NULL',
        'RegistroApellidos' => $apenom['apellido'],
        'RegistroNombres' => $apenom['nombres'],
        'RegistroEdad' => 'NULL',
        'RegistroAsisSocial' => 'NULL',
        'RegistroEstabId' => 'NULL',
        'RegistroSector' => 'NULL',
        'RegistroFchBaja' => 'NULL',
        'RegistroUsuBaja' => 'NULL',
        'RegistroFchCierre' => 'NULL',
        'RegistroMotcierre' => 'NULL',
        'RegistroUsuCierre' => 'NULL',
        'RegistroEstaCierre' => 'NULL',
        'RegistroDomicilio' => $residencia['ResiDire'],
        'RegistroLocalidad' => $residencia['ResiLocal']

        // Agrega más mapeos de columnas aquí
    );

    return $mappedRow;
}
  
      private function separar_nombres($cadena) {
          $apenom_array = explode(" ", $cadena);
          $nombres = array_slice($apenom_array, 1);
          $nombre = implode(" ", $nombres);
          return [
            "apellido" => $apenom_array[0],
            "nombres" => $nombre,
          ];
        }
  
    }


// Instanciar y ejecutar la migración si es una solicitud AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
  $pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
  $pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

  $origenDB = new DataTables($pdoO, 'NotiCtrles', 'IdCtrol');
  $destinoDB = new DataTables($pdoD, 'Notificacion', 'NotificacionId');
  $domicilio = new DataTables($pdoO, 'NIÑORESIDENCIA', 'ResiNiño');

  $migrator = new DatabaseMigrator($origenDB, $destinoDB, $domicilio);
  $migrator->migrateTable('tabla_origen', 'tabla_destino');
  exit; // Detener la ejecución después de la migración
}
?>
































<?php
/*
require_once('DataTables.php');

require_once('DataTables.php');

class DatabaseMigrator {
    private $origenDB;
    private $destinoDB;
    private $domicilio;
    
    public function __construct(DataTables $origenDB,DataTables $destinoDB, DataTables $domicilio) {
     
        $this->origenDB = $origenDB;
        $this->destinoDB = $destinoDB;
        $this->domicilio = $domicilio;
           }

  public function migrateTable($origenTable, $destinoTable) {
    $origenData = $this->origenDB->findAll($origenTable);

   // var_dump($origenData); 


    $totalRecords = $this->origenDB->total($origenTable);
    $offset = 0;

    foreach ($origenData as $row) {
      $mappedRow = $this->mapColumns($row);
      $this->destinoDB->save($mappedRow);

      $offset++;
      $progress = ($offset / $totalRecords) * 100;

      // Enviar el progreso como respuesta AJAX
      echo('<p>Progreso: ' . number_format($progress, 2) . '%</p>');

      // Flushear el búfer de salida para enviar la información al navegador inmediatamente
      ob_flush();
      flush();
    }
}
private function mapColumns($row) {
  // Aquí defines el mapeo de nombres de columnas entre las tablas origen y destino.
  // Por ejemplo, si la tabla origen tiene 'nombre' y la tabla destino espera 'nombre_completo':
  if ( $row['Sexo']=="Femenino"){$row['Sexo']=2;} else{$row['Sexo']=1;};
  $apenom = $this->separar_nombres($row['ApeNom']);
  $residencia = $this->domicilio->findById($row['IdNiño']);
  $mappedRow = array(
      'RegistroId' => $row['IdNiño'],
      'RegistroAoResidId' => $row['Aoresi'],
      'RegistroNomCompleto' => $row['ApeNom'],
      'RegistroNroDocumento' => $row['Dni'],
      'RegistroFecha' => $row['FechaCapta'],
      'RegistroFchNac' => $row['FechaNto'],
      'RegistroPeso' => $row['Peso'],
      'RegistroSemGestacion' => $row['Semanas'],
      'SexoId' => $row['Sexo'],
      'RegistroTalla' => $row['Talla'],
      'EtniaId' => $row['TpoEtnia'],
      'RegistroUsuCarga' => $row['UsuId'],
      'RegistroFchIns' => 'NULL',
      'MotivoCargaId' => 'NULL',
      'RegistroApellidos' => $apenom['apellido'],
      'RegistroNombres' => $apenom['nombres'],
      'RegistroEdad' => 'NULL',
      'RegistroAsisSocial' => 'NULL',
      'RegistroEstabId' => 'NULL',
      'RegistroSector' => 'NULL',
      'RegistroFchBaja' => 'NULL',
      'RegistroUsuBaja' => 'NULL',
      'RegistroFchCierre' => 'NULL',
      'RegistroMotcierre' => 'NULL',
      'RegistroUsuCierre' => 'NULL',
      'RegistroEstaCierre' => 'NULL',
      'RegistroDomicilio' => $residencia['ResiDire'],
      'RegistroLocalidad' => $residencia['ResiLocal']

      // Agrega más mapeos de columnas aquí
  );

  return $mappedRow;
}

    private function separar_nombres($cadena) {
        $apenom_array = explode(" ", $cadena);
        $nombres = array_slice($apenom_array, 1);
        $nombre = implode(" ", $nombres);
        return [
          "apellido" => $apenom_array[0],
          "nombres" => $nombre,
        ];
      }

  }

// Instanciar y ejecutar la migración si es una solicitud AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
  $pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
  $pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

  $origenDB = new DataTables($pdoO, 'NotiCtrles', 'IdCtrol');
  $destinoDB = new DataTables($pdoD, 'Notificacion', 'NotificacionId');
  $domicilio = new DataTables($pdoO, 'NIÑORESIDENCIA', 'ResiNiño');

  $migrator = new DatabaseMigrator($origenDB, $destinoDB, $domicilio);
  $migrator->migrateTable('tabla_origen', 'tabla_destino');
  exit; // Detener la ejecución después de la migración
}
/*
*/


require_once('DataTables.php');

class DatabaseMigrator {
    private $origenDB;
    private $destinoDB;
    private $domicilio;
    
    public function __construct(DataTables $origenDB,DataTables $destinoDB, DataTables $domicilio) {
     
        $this->origenDB = $origenDB;
        $this->destinoDB = $destinoDB;
        $this->domicilio = $domicilio;
           }

    public function migrateTable($origenTable, $destinoTable) {
        $origenData = $this->origenDB->findAll($origenTable); // Leer datos de la tabla origen
        //var_dump($origenData); 
        $totalRecords = $this->origenDB->total($origenTable);
        $offset = 0;
        foreach ($origenData as $row) {
            $mappedRow = $this->mapColumns($row); // Mapear nombres de columnas
            $this->destinoDB->save($mappedRow); // Insertar en tabla destino
            $offset += $offset;
            $progress = ($offset / $totalRecords) * 100;

      // Enviar el progreso como respuesta AJAX
      echo('<p>Progreso: ' . number_format($progress, 2) . '%</p>');

      // Flushear el búfer de salida para enviar la información al navegador inmediatamente
      ob_flush();
      flush();
          //  verAvance($offset,$totalrecord);

        

        }
    }
/*
    private function verAvance($offset,$totalrecord) {
        // Calcular el porcentaje de progreso
        $progress = ($offset / $totalRecords) * 100;

        // Salida HTML para mostrar el progreso
        echo('<p>Progreso: ' . number_format($progress, 2) . '%</p>');
        
        // Flushear el búfer de salida para enviar la información al navegador inmediatamente
        ob_flush();
        flush();

        // Pausa de 1 segundo para controlar la velocidad de actualización
        sleep(1);

    }
*/
    private function mapColumns($row) {
        // Aquí defines el mapeo de nombres de columnas entre las tablas origen y destino.
        // Por ejemplo, si la tabla origen tiene 'nombre' y la tabla destino espera 'nombre_completo':
        if ( $row['Sexo']=="Femenino"){$row['Sexo']=2;} else{$row['Sexo']=1;};
        $apenom = $this->separar_nombres($row['ApeNom']);
        $residencia = $this->domicilio->findById($row['IdNiño']);
        $mappedRow = array(
            'RegistroId' => $row['IdNiño'],
            'RegistroAoResidId' => $row['Aoresi'],
            'RegistroNomCompleto' => $row['ApeNom'],
            'RegistroNroDocumento' => $row['Dni'],
            'RegistroFecha' => $row['FechaCapta'],
            'RegistroFchNac' => $row['FechaNto'],
            'RegistroPeso' => $row['Peso'],
            'RegistroSemGestacion' => $row['Semanas'],
            'SexoId' => $row['Sexo'],
            'RegistroTalla' => $row['Talla'],
            'EtniaId' => $row['TpoEtnia'],
            'RegistroUsuCarga' => $row['UsuId'],
            'RegistroFchIns' => 'NULL',
            'MotivoCargaId' => 'NULL',
            'RegistroApellidos' => $apenom['apellido'],
            'RegistroNombres' => $apenom['nombres'],
            'RegistroEdad' => 'NULL',
            'RegistroAsisSocial' => 'NULL',
            'RegistroEstabId' => 'NULL',
            'RegistroSector' => 'NULL',
            'RegistroFchBaja' => 'NULL',
            'RegistroUsuBaja' => 'NULL',
            'RegistroFchCierre' => 'NULL',
            'RegistroMotcierre' => 'NULL',
            'RegistroUsuCierre' => 'NULL',
            'RegistroEstaCierre' => 'NULL',
            'RegistroDomicilio' => $residencia['ResiDire'],
            'RegistroLocalidad' => $residencia['ResiLocal']

            // Agrega más mapeos de columnas aquí
        );

        return $mappedRow;
    }

    private function separar_nombres($cadena) {
        $apenom_array = explode(" ", $cadena);
        $nombres = array_slice($apenom_array, 1);
        $nombre = implode(" ", $nombres);
        return [
          "apellido" => $apenom_array[0],
          "nombres" => $nombre,
        ];
      }

    }



 
// Uso de la clase

$pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
$pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

$origenDB = new DataTables($pdoO, 'NIÑOS', 'IdNiño');
$destinoDB = new DataTables($pdoD, 'Registro', 'RegistroId');
$domicilio = new DataTables($pdoO, 'NIÑORESIDENCIA', 'ResiNiño');

$migrator = new DatabaseMigrator($origenDB, $destinoDB, $domicilio);
$migrator->migrateTable('tabla_origen', 'tabla_destino');



