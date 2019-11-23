<?php
//die();
session_start();
$facturatotal=0;
$miObjeto = new stdClass();
$miObjeto->Factura = $_GET['patente'];
$miObjeto->precioPorHora=100;
date_default_timezone_set('America/Argentina/Buenos_Aires');
$horaSalida = mktime(); 
$Bandera=1;
//var_dump($miObjeto);
//die();


if(!($iden =  mysqli_connect("localhost", "root", "","phpdatabase"))) 
    die("Error: No se pudo conectar");

$sentencia = "SELECT
  FechaIngreso AS 'FechaIngreso',
  NOW(),
  TIMESTAMPDIFF(SECOND,FechaIngreso,NOW()) AS 'DateDiff'
  FROM patente
  WHERE patente_V = '$miObjeto->Factura'";

if($result=mysqli_query($iden,$sentencia)){
   while ($obj=mysqli_fetch_object($result))
        {
        
            $tiempo=$obj->DateDiff/60;
            $facturatotal=$tiempo*100;
           
        }
      // Free result set
      mysqli_free_result($result);
}

mysqli_close($iden);

echo "El total a pagar es: ";
echo $facturatotal;

?>
