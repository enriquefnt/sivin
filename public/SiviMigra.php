<?php /*
require_once('DataTables.php');

class DatabaseMigrator {
    private $origenDB;
    private $destinoDB;
    
    public function __construct($origenDB, $destinoDB) {
        $this->origenDB = $origenDB;
        $this->destinoDB = $destinoDB;
    }

    public function migrateTable($origenTable, $destinoTable) {
        $origenData = $this->origenDB->findAll($origenTable); // Leer datos de la tabla origen

        foreach ($origenData as $row) {
            $mappedRow = $this->mapColumns($row); // Mapear nombres de columnas
            $this->destinoDB->save($destinoTable, $mappedRow); // Insertar en tabla destino
        }
    }

    private function mapColumns($origenRow) {
        // Aquí defines el mapeo de nombres de columnas entre las tablas origen y destino.
        // Por ejemplo, si la tabla origen tiene 'nombre' y la tabla destino espera 'nombre_completo':
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
            'RegistroApellidos' => 'NULL',
            'RegistroNombres' => 'NULL',
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
            'RegistroDomicilio' => 'NULL',
            'RegistroLocalidad' => 'NULL'

            // Agrega más mapeos de columnas aquí
        );

        return $mappedRow;
    }
}

// Uso de la clase
$pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
$pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

$origenDB = new DataTables($pdoO, 'NIÑOS', 'IdNiño');
$destinoDB = new DataTables($pdoD, 'Registro', 'RegistroId');

$migrator = new DatabaseMigrator($origenDB, $destinoDB);
$migrator->migrateTable('tabla_origen', 'tabla_destino');
?>

/*

<?php */
require_once('DataTables.php');

class DatabaseMigrator {
    private $origenDB;
    private $destinoDB;
    
    public function __construct($origenDB, $destinoDB) {
        $this->origenDB = $origenDB;
        $this->destinoDB = $destinoDB;
    }

    public function migrateTable($origenTable, $destinoTable, $batchSize = 200) {
        $totalRecords = $this->origenDB->total($origenTable);
        $offset = 0;

        while ($offset < $totalRecords) {
            $origenData = $this->origenDB->findBatch($batchSize, $offset); // Leer un lote de registros

            foreach ($origenData as $row) {
                $mappedRow = $this->mapColumns($row); // Mapear nombres de columnas
                $this->destinoDB->save($mappedRow); // Insertar en tabla destino
            }

            $offset += $batchSize;
        }
    }

    private function mapColumns($origenRow) {
        // Mapeo de nombres de columnas
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
            'RegistroApellidos' => 'NULL',
            'RegistroNombres' => 'NULL',
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
            'RegistroDomicilio' => 'NULL',
            'RegistroLocalidad' => 'NULL'

            // columnas aquí
        );


       

        return $mappedRow;
    }

    private function separar_nombres($cadena) {
        $nombres = explode(" ", $cadena);
        $apellidos = array_slice($nombres, 1);
        $apellidos = implode(" ", $apellidos);
        return [
          "nombre" => $nombres[0],
          "apellidos" => $apellidos,
        ];
      }


}

// Uso de la clase
$pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
$pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

$origenDB = new DataTables($pdoO, 'NIÑOS', 'IdNiño');
$destinoDB = new DataTables($pdoD, 'Registro', 'RegistroId');

$migrator = new DatabaseMigrator($origenDB, $destinoDB);
$migrator->migrateTable('tabla_origen', 'tabla_destino');
?>
