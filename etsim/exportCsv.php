<?php

include_once 'includes/inGame.inc.php';
$liste=listCurrentGameResults($mysqli, $_SESSION['id_etsim_game']);
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array_values(array('Round number', 'Bid volume', 'Demand volume', 'Market price', 'Income', 'Cost', 'Benefit', '% successful orders')), ';', ' ');
// loop over the rows, outputting them
//fputcsv($output, array_values($liste), ';', ' ');
foreach ($liste as $row) 
{
    /*fputcsv($output, $row);*/
    fputcsv($output, array_values($row), ';', ' ');
}



?>