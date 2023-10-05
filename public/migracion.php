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
            $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
            // Establece el tamaño del lote que deseas migrar en cada iteración
            $batchSize = 100; // Puedes ajustarlo según tus necesidades
            for ($i = 0; $i < $batchSize && $offset < $totalRecords; $i++) {
                // Obtiene el registro en la posición actual del offset
                $row = $origenData[$offset];
            
                // Realiza la migración de este registro
                $mappedRow = $this->mapColumns($row);
                $this->destinoDB->save($mappedRow);
            
                $offset++;
            }
            // Calcula el progreso actual
            $progress = ($offset / $totalRecords) * 100;

// Devuelve el progreso actual y el nuevo valor de $offset en formato JSON
                echo json_encode(['offset' => $offset, 'progress' => $progress]);

    }
    
    private function mapColumns($origenRow) {
      // Define el mapeo de nombres de columnas entre las tablas origen y destino.
      
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
  
  
  

$pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
$pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

$origenDB = new DataTables($pdoO, 'NIÑOS', 'IdNiño');
$destinoDB = new DataTables($pdoD, 'Registro', 'RegistroId');
$domicilio = new DataTables($pdoO, 'NIÑORESIDENCIA', 'ResiNiño');

$migrator = new DatabaseMigrator($origenDB, $destinoDB, $domicilio);
$migrator->migrateTable('tabla_origen', 'tabla_destino');
?>
