<?php
// Host name
$host = "https://190.2.251.208";

// Port
$port = 50000;

//sesion
$sesion="";

// Login credentials
$params = [
    "UserName" => "dseme",
    "Password" => "4321",
    "CompanyDB" => "YUHMAKSA_PRD",
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/Login");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,(array('Content-Type:application/json')));
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

$response = curl_exec($curl);

//echo $response ;
//echo json_encode($params);
//echo json_encode($response);
echo $response;

$obj = json_decode($response);
$varsesion=$obj->{'SessionId'};

echo "<br />";
echo "<br />";

echo "Numero de Sesion :".$varsesion."<br />";

$routeId = "";

curl_setopt($curl, CURLOPT_HEADERFUNCTION, function($curl, $string) use (&$routeId){
    $len = strlen($string);

    if(substr($string, 0, 10) == "Set-Cookie"){
        preg_match("/ROUTEID=(.+);/", $string, $match);

        if(count($match) == 2){ 
            $routeId = $match[1];
        }
    } 
    return $len;
});

curl_exec($curl);

echo "ROUTERID :".$routeId;

echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";


$headers[] = "Cookie: B1SESSION=" . $varsesion . "; ROUTEID=" . $routeId . ";";

$selectx = '?$select=CardCode,CardName,FederalTaxID';




$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/EmployeesInfo(5)");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

echo $response;      //muestra el detalle total en json de los clientes los primeros 20
$objclientesaux = json_decode($response);


//echo $objclientesaux->{'odata.metadata'}."<br />";
//echo $objclientesaux->{'odata.nextLink'}."<br />";
//$tanda2=$objclientesaux->{'odata.nextLink'};


$arreglo=$objclientesaux->{'value'};   //guardar el array en una variable

echo $arreglo[0]->CardCode." Nombre :".$arreglo[0]->CardName."Numero de dni/cuil".$arreglo[0]->FederalTaxID;
echo "<br />";
echo "<br />";

//$data cumple la funcion de subindice
foreach ($arreglo as $data) {
	echo $data->CardCode." - ".$data->CardName."<br />";
}

echo "<br />";
echo "<br />";

/////mostrar los siguientes 20 siguientes
$curl0 = curl_init();
curl_setopt($curl0, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl0, CURLOPT_URL, $host . ":" . $port . $tanda2);
curl_setopt($curl0, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl0, CURLOPT_SSL_VERIFYPEER, false);

$response10 = curl_exec($curl0);
$objclientesaux10 = json_decode($response10);

//echo $response10;      //muestra el detalle total en json de los clientes 2º tanda2

$arreglo10=$objclientesaux10->{'value'};   //guardar el array en una variable

foreach ($arreglo10 as $data10) {
	echo $data10->CardCode." - ".$data10->CardName."<br />";
}

echo "<br />";
echo "<br />";


//$objclientes = json_decode($response);
//print_r($objclientes);

echo "<br />";
echo "<br />";

//echo $objclientes->{'odata.metadata'};







echo "<br />";
echo "<br />";

//$objclientes1 = json_decode($response,true);
//print_r($objclientes1);
//var_dump($objclientes);







echo "<br />";
echo "<br />";
echo "<br />";

?>


