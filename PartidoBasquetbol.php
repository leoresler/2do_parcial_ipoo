<?php

class PartidoBasquetbol extends Partido {
    private $cantInfracciones;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfracciones)
    {

        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
    }


    // metodos GET y SET
    public function getCantInfracciones() {
        return $this->cantInfracciones;
    }
    public function setCantInfracciones($cantInfracciones) {
        $this->cantInfracciones = $cantInfracciones;
    }


    // coef = coeficiente_base_partido(que es 0.5) - (coef_penalización(que es 0.75)*cant_infracciones);

    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "Cantidad de infracciones: " . $this->getCantInfracciones() . "\n";
        return $cadena;
    }
    

    public function coeficientePartido() {
        $coefPartido = parent::coeficientePartido();
        $infraccionesTotales = $this->getObjEquipo1()->getCantInfracciones() + $this->getObjEquipo2()->getCantInfracciones();
        $coef = 0;

        // coef = coeficiente_base_partido - (coef_penalización*cant_infracciones);

        $coef = $coefPartido - (0.75 * $infraccionesTotales);
        return $coef;
    }


}