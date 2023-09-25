<?php 
require_once('DataTables.php');

class DatabaseMigrator {
    private $origenDB;
    private $destinoDB;
    
    
    public function __construct(DataTables $origenDB,DataTables $destinoDB) {
     
        $this->origenDB = $origenDB;
        $this->destinoDB = $destinoDB;
        
           }

           public function migrateTable($origenTable, $destinoTable) {
            try {
            //$stmt = $this->origenDB->getConnection()->prepare("CALL migraNotCtrl()");
            //$stmt = $this->origenDB->getConnection()->prepare("CALL migraNotCtrl()");
            $stmt = $this->origenDB->getConnection()->prepare("SELECT * FROM NotiCtrles;");
            $stmt->execute();

            // Obtener los resultados del procedimiento almacenado
            $origenData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump($origenData); 
            }
            catch (PDOException $e) {
                echo 'Error en la ejecución del procedimiento almacenado: ' . $e->getMessage();
            }
            $totalRecords = count($origenData); // Total de registros a procesar
            $offset = 0;
        
            foreach ($origenData as $row) {
                $mappedRow = $this->mapColumns($row); // Mapear nombres de columnas
                $this->destinoDB->save($mappedRow); // Insertar en tabla destino
                
                $offset++; // Incrementar el contador de registros procesados
        
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
        }
        

    private function mapColumns($origenRow) {
        // Aquí defines el mapeo de nombres de columnas entre las tablas origen y destino.
        // Por ejemplo, si la tabla origen tiene 'nombre' y la tabla destino espera 'nombre_completo':
        
       
        $mappedRow = array(
            
'NotificacionId' => 'NULL',
'RegistroId' => $origenRow['IdNiño'],
'NotificacionFchIns' =>'NULL',
'NotificacionEstaBIns' =>'NULL',
'NotificacionEdad' =>'NULL',
' NotificacionFecha' => $origenRow['Fecha'],
' NotificacionLugAtenc' =>'NULL',
' NotificacionFchInternac' =>'NULL',
' NotificacionDiagIDIntern' =>'NULL',
' NotificacionFchAltaIntern' =>'NULL',
' NotificacionPeso' => $origenRow['Peso'],
' NotificacionZscorePeso' => $origenRow['ZPesoEdad'],
' NotificacionTalla' => $origenRow['Talla'],
' NotificacionZscoreTalla' => $origenRow['ZTallaEdad'],
' NotificacionIMC' =>'NULL',
' NotificacionZscoreImc' => $origenRow['ZIMCEdad'],
' NotificacionObsAntrop' =>'NULL',
' NotificacionDesnutricion' =>'NULL',
' NotificacionUsuNot' =>'NULL',
' NotificacionFchBaja' =>'NULL',
' NotificacionUsuBaja' =>'NULL',
' NotificacionSeClasId' =>'NULL',
' NotificacionSeDxNuId' =>'NULL',
' NotificacionSevClasId' =>'NULL',
' NotificacionSevDxNuId' =>'NULL',
' NotificacionSgClasId' =>'NULL',
' NotificacionSgDxNuId' =>'NULL',
' NotificacionDiagObserva' =>'NULL',
' Notificacionzpr' =>'NULL',
' Notificacionzpg' =>'NULL',
' Notificacionzpb' =>'NULL',
' Notificacionztr' =>'NULL',
' Notificacionztg' =>'NULL',
' Notificacionztb' =>'NULL',
' Notificacionzir' =>'NULL',
' Notificacionzig' =>'NULL',
' Notificacionzib' =>'NULL'

        );
        var_dump($mappedRow); 
        return $mappedRow;
    }

    




}

// Uso de la clase

$pdoO = new PDO('mysql:host=200.45.111.99;dbname=MSP_NUTRICION; charset=utf8', 'SiViNSalta', '@#sivin#@salta!%2020&&');
$pdoD = new PDO('mysql:host=212.1.210.73;dbname=saltaped_sivinsalta; charset=utf8', 'saltaped_sivin', 'sivin7625');

$origenDB = new DataTables($pdoO, 'NotiCtrles', 'IdCtrol');
$destinoDB = new DataTables($pdoD, 'Notificacion', 'NotificacionId');


$migrator = new DatabaseMigrator($origenDB, $destinoDB);
$migrator->migrateTable('tabla_origen', 'tabla_destino');

