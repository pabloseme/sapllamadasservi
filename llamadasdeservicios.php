<?php

session_start();
ob_start();

$xmotor=trim($_POST['motorr']);

// Host name
$host = "https://190.2.251.208";

// Port
$port = 50000;

$filtro1=rawurlencode(' eq ');
$param='?$filter=U_Motor'.$filtro1."'".$xmotor."'";

       


$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array($_SESSION['logged_in_user_id']));
curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/sml.svc/LLAMADACONSUL".$param);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

$response = curl_exec($curl);



///COMO ESTE ARCHIVO ES LLAMADO DESDE UNA PROMESA, SOLO DEBO ENVIAR UNA SOLA LINEA CON ECHO
///SI PONGO MAS DE UNA GENERA ERROR

//echo $response ;

$objx = json_decode($response);
$arregloq=$objx->{'value'}; //esto es un arreglo como maximo en una primera instancia tendra 20

echo json_encode($arregloq);


?>