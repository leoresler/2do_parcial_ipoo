<?php
include_once("Categoria.php");
include_once("Torneo.php");
include_once("Equipo.php");
include_once("Partido.php");
include_once("PartidoFutbol.php");
include_once("PartidoBasquetbol.php");

$catMayores = neW Categoria(1,'Mayores');
$catJuveniles = neW Categoria(2,'Juveniles');
$catMenores = neW Categoria(1,'Menores');

$objE1 = neW Equipo("Equipo Uno", "Cap.Uno",1,$catMayores);
$objE2 = neW Equipo("Equipo Dos", "Cap.Dos",2,$catMayores);

$objE3 = neW Equipo("Equipo Tres", "Cap.Tres",3,$catJuveniles);
$objE4 = neW Equipo("Equipo Cuatro", "Cap.Cuatro",4,$catJuveniles);

$objE5 = neW Equipo("Equipo Cinco", "Cap.Cinco",5,$catMayores);
$objE6 = neW Equipo("Equipo Seis", "Cap.Seis",6,$catMayores);

$objE7 = neW Equipo("Equipo Siete", "Cap.Siete",7,$catJuveniles);
$objE8 = neW Equipo("Equipo Ocho", "Cap.Ocho",8,$catJuveniles);

$objE9 = neW Equipo("Equipo Nueve", "Cap.Nueve",9,$catMenores);
$objE10 = neW Equipo("Equipo Diez", "Cap.Diez",9,$catMenores);

$objE11 = neW Equipo("Equipo Once", "Cap.Once",11,$catMayores);
$objE12 = neW Equipo("Equipo Doce", "Cap.Doce",11,$catMayores);


// 1.
$torneo = new Torneo(100000);

// 2. a.
$partidoBasquet1 = new PartidoBasquetbol(11, '2024-05-05', $objE7, 80, $objE8, 120, 7);
$partidoBasquet2 = new PartidoBasquetbol(12, '2024-05-06', $objE9, 81, $objE10, 110, 8);
$partidoBasquet3 = new PartidoBasquetbol(13, '2024-05-07', $objE11, 115, $objE12, 85, 9);

// 2. b.
$partidoFutbol1 = new PartidoFutbol(14, '2024-05-07', $objE1, 3, $objE2, 2);
$partidoFutbol2 = new PartidoFutbol(15, '2024-05-08', $objE3, 0, $objE4, 1);
$partidoFutbol3 = new PartidoFutbol(16, '2024-05-09', $objE5, 2, $objE6, 3);

// 3.
$torneo->ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol');
$torneo->ingresarPartido($objE11, $objE11, '2024-05-23', 'basquetbol');
$torneo->ingresarPartido($objE9, $objE10, '2024-05-25', 'basquetbol');

// ingreso de partidos
echo "Respuesta partido 1: ";
$resp1 = $torneo->ingresarPartido($objE5, $objE11, '2024-05-23', 'futbol');
echo $resp1 . "\n";
echo "Cantidad de equipos: " . count($torneo->getColPartidos()) . "\n";

echo "Respuesta partido 2: ";
$resp2 = $torneo->ingresarPartido($objE11, $objE11, '2024-05-23', 'basquet');
echo $resp2 . "\n";
echo "Cantidad de equipos: " . count($torneo->getColPartidos()) . "\n";

echo "Respuesta partido 3: ";
$resp3 = $torneo->ingresarPartido($objE9, $objE10, '2024-05-25', 'basquet');
echo $resp3 . "\n";
echo "Cantidad de equipos: " . count($torneo->getColPartidos()) . "\n";

// dar ganadores de básquet y fútbol
echo "Ganadores de básquet: ";
foreach ($torneo->darGanadores('basquet') as $ganador) {
    echo $ganador . ", ";
}
echo "\n";

echo "Ganadores de fútbol: ";
foreach ($torneo->darGanadores('futbol') as $ganador) {
    echo $ganador . ", ";
}
echo "\n";

// calcular premio para cada partido
echo "Premio para partido 1: ";
foreach ($torneo->calcularPremioPartido($partidoFutbol1) as $resultado) {
    echo "Equipo ganador: " . $resultado['equipoGanador'] . ", Premio: " . $resultado['premioPartido'] . "\n";
}

echo "Premio para partido 2: ";
foreach ($torneo->calcularPremioPartido($partidoBasquet1) as $resultado) {
    echo "Equipo ganador: " . $resultado['equipoGanador'] . ", Premio: " . $resultado['premioPartido'] . "\n";
}

echo "Premio para partido 3: ";
foreach ($torneo->calcularPremioPartido($partidoBasquet2) as $resultado) {
    echo "Equipo ganador: " . $resultado['equipoGanador'] . ", Premio: " . $resultado['premioPartido'] . "\n";
}

// 4.
echo $torneo;

?>

