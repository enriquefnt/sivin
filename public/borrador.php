<?php
// Lógica para verificar el progreso de la migración
// Esta lógica debe proporcionar información sobre el progreso actual de la migración
// Puedes almacenar el progreso en una variable o en una base de datos
// Aquí, simularemos un progreso ficticio

$progress = 0; // Porcentaje de progreso actual (0-100)
$completed = false; // Variable para indicar si la migración ha finalizado

// Lógica ficticia de progreso (simula un progreso gradual)
if ($progress < 100) {
    $progress += rand(1, 100); // Aumentar el progreso de forma aleatoria
} else {
    $completed = true; // Marcar como completado cuando se alcanza el 100%
}

// Enviar el progreso como respuesta
if ($completed) {
    echo 'Completado'; // Indicar que la migración ha finalizado
} else {
    echo "Progreso: $progress%"; // Enviar el progreso actual
}




/*
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
           // echo $totalRecords;
            foreach ($origenData as $row) {
                $mappedRow = $this->mapColumns($row); // Mapear nombres de columnas
                $this->destinoDB->save($mappedRow); // Insertar en tabla destino
            //    echo $offset;
            }

            $offset += $batchSize;
            $progress = array(
                'transferred' => $offset,
                'total' => $totalRecords
            );
            echo json_encode($progress);
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
*/