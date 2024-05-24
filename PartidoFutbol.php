<?php

class PartidoFutbol extends Partido {
    private $coefMenor;
    private $coefJuvenil;
    private $coefMayor;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2)
    {

        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->coefMenor = 0.13;
        $this->coefJuvenil = 0.19;
        $this->coefMayor = 0.27;
    }


    // metodos GET y SET
    public function getCoefMenor() {
        return $this->coefMenor;
    }
    public function setCoefMenor($coefMenor) {
        $this->coefMenor = $coefMenor;
    }

    public function getCoefJuvenil() {
        return $this->coefJuvenil;
    }
    public function setCoefJuvenil($coefJuvenil) {
        $this->coefJuvenil = $coefJuvenil;
    }

    public function getCoefMayor() {
        return $this->coefMayor;
    }
    public function setCoefMayor($coefMayor) {
        $this->coefMayor = $coefMayor;
    }


    public function __toString()
    {
        $cadena = parent::__toString();
        return $cadena;
    }


    public function coeficientePartido() {
        $coefPartido = parent::coeficientePartido();
        $coef = 0;
        $categoria1 = $this->getObjEquipo1()->getDescripcion();
        $categoria2 = $this->getObjEquipo2()->getDescripcion();
        $golesTotales = $this->getCantGolesE1() + $this->getCantGolesE2();
        $jugadoresTotales = $this->getObjEquipo1()->getCantJugadores() + $this->getObjEquipo2()->getCantJugadores();
        
        // coef = 0,5 * cantGoles * cantJugadores donde cantGoles : es la cantidad de goles; cantJugadores : es la cantidad de jugadores.

        if ($categoria1 == "Menores" && $categoria2 == "Menores") {
            $coef = $this->getCoefMenor() * $golesTotales * $jugadoresTotales;
        } elseif ($categoria1 == "Juveniles" && $categoria2 == "Juveniles") {
            $coef = $this->getCoefJuvenil() * $golesTotales * $jugadoresTotales;
        } elseif ($categoria1 == "Mayores" && $categoria2 == "Mayores") {
            $coef = $this->getCoefMayor() * $golesTotales * $jugadoresTotales;
        } else {
            $coef = $coefPartido;
        }
        
        return $coef;
    }


}