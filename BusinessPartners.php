<?php

session_start();
ob_start();

$dnicuit=trim($_POST['dni']);


//*if ($dnicuit===''){
//*    echo json_encode('llene los campos');
//*}else
//*{
//*    echo json_encode('coorrecto');
//*}


// Host name
$host = "https://190.2.251.208";

// Port
$port = 50000;


//*echo $_SESSION['logged_in_user_id'];


$filtro1=rawurlencode(' eq ');
$param='?$filter=FederalTaxID'.$filtro1."'".$dnicuit."'";
$selectx='?$select=CardCode,CardName,FederalTaxID';
       

$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array($_SESSION['logged_in_user_id']));
//curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/BusinessPartners('C00026472')");
curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/BusinessPartners".$param);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
//curl_setopt($curl, CURLOPT_VERBOSE, 1);
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_HTTPHEADER,(array('Content-Type:application/json')));
//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

$response = curl_exec($curl);

//echo curl_error($curl);
//var_dump($response);


//echo "<br />";
//echo "<br />";

//echo $response ;


$obj = json_decode($response);
$arreglo=$obj->{'value'};

//echo json_encode("hola gente");
echo json_encode('Nombre del Cliente : '.$arreglo[0]->CardName);



?>
