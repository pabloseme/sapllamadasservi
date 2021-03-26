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

?>


