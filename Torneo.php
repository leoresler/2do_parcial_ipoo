<?php

class Torneo {
    private $colPartidos; 
    private $importePremio;

    public function __construct($importePremio)
    {
        $this->colPartidos = [];
        $this->importePremio = $importePremio;
    }

    // metodos GET y SET
    public function getImportePremio() {
        return $this->importePremio;
    }
    public function setImportePremio($importePremio) {
        $this->importePremio = $importePremio;
    }

    public function getColPartidos() {
        return $this->colPartidos;
    }
    public function setColPartidos($colPartidos) {
        $this->colPartidos = $colPartidos;
    }


    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) {
        $coleccionPartidos = $this->getColPartidos();

        if ($tipoPartido instanceof PartidoFutbol) {
            if (($OBJEquipo1->getObjCategoria()->getidcategoria() == $OBJEquipo2->getObjCategoria()->getidcategoria()) && ($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores())) {
                $partido = new PartidoFutbol($tipoPartido->getIdpartido(), $fecha, $OBJEquipo1, $OBJEquipo1->getCantGolesE1(), $OBJEquipo2, $OBJEquipo2->getCantGolesE2());
                array_push($coleccionPartidos, $partido);
            }
        }

        if ($tipoPartido instanceof PartidoBasquetbol) {
            if (($OBJEquipo1->getObjCategoria()->getidcategoria() == $OBJEquipo2->getObjCategoria()->getidcategoria()) && ($OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores())) {
                $partido = new PartidoBasquetbol($tipoPartido->getIdpartido(), $fecha, $OBJEquipo1, $OBJEquipo1->getCantGolesE1(), $OBJEquipo2, $OBJEquipo2->getCantGolesE2(), $tipoPartido->getCantInfracciones());
                array_push($coleccionPartidos, $partido);
            }
        }
        $this->setColPartidos($coleccionPartidos);

        return $coleccionPartidos;
    }


    public function darGanadores($deporte) {
        $ganadores = [];
        $coleccionPartidos = $this->getColPartidos();
    
        foreach ($coleccionPartidos as $partido) {
            if (($partido instanceof PartidoFutbol && $deporte === 'futbol') || ($partido instanceof PartidoBasquetbol && $deporte === 'basquet')) {
                $ganadorPartido = $partido->darEquipoGanador();
                if (!is_array($ganadorPartido)) {
                    $ganadores[] = ['partido' => $partido, 'equipo' => $ganadorPartido];
                } else {
                    foreach ($ganadorPartido as $equipo) {
                        $ganadores[] = ['partido' => $partido, 'equipo' => $equipo];
                    }
                }
            }
        }
    
        return $ganadores;
    }
    

    public function calcularPremioPartido($OBJPartido) {
        $resultados = [];
        $importePremio = $this->getImportePremio();
    
        if ($OBJPartido instanceof PartidoFutbol) {
            $deporte = 'futbol';
        } elseif ($OBJPartido instanceof PartidoBasquetbol) {
            $deporte = 'basquet';
        }
    
        $ganadores = $this->darGanadores($deporte);
    
        foreach ($ganadores as $ganador) {
            if ($ganador['partido'] === $OBJPartido) { // Verificamos si el partido es el mismo que el proporcionado
                $coeficientePartido = $OBJPartido->coeficientePartido();
                $premioPartido = $coeficientePartido * $importePremio;
                $resultados[] = [
                    'equipoGanador' => $ganador['equipo'],
                    'premioPartido' => $premioPartido
                ];
            }
        }
    
        return $resultados;
    }
    
    
    public function __toString() {
        $cadena = "Importe Premio: " . $this->getImportePremio() . "\n";
        $cadena .= "Partidos:\n";
    
        foreach ($this->getColPartidos() as $partido) {
            $cadena .= $partido . "\n";
        }
    
        return $cadena;
    }    



}