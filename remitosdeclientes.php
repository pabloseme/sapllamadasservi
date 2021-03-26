<?php

session_start();
ob_start();

$dnicuit=trim($_POST['dni']);

// Host name
$host = "https://190.2.251.208";

// Port
$port = 50000;

$filtro1=rawurlencode(' eq ');
$param='?$filter=LicTradNum'.$filtro1."'".$dnicuit."'";

       


$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array($_SESSION['logged_in_user_id']));
curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/sml.svc/YUH_LLAMADADECLIENTES".$param);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

$response = curl_exec($curl);



///COMO ESTE ARCHIVO ES LLAMADO DESDE UNA PROMESA, SOLO DEBO ENVIAR UNA SOLA LINEA CON ECHO
///SI PONGO MAS DE UNA GENERA ERROR

//echo $response ;

$objx = json_decode($response);
$arreglo=$objx->{'value'}; //esto es un arreglo como maximo en una primera instancia tendra 20
$bandera=0;
$i=20;
while (property_exists($objx,"@odata.nextLink")):

   // while ($bandera==0):
    ///tomo los datos de las primeras 20 motos 

    ///ejecuto nuevamente la llamada al service layer con las 20 siguiete 
    $param=$objx->{"@odata.nextLink"};
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array($_SESSION['logged_in_user_id']));
    curl_setopt($curl, CURLOPT_URL, $host . ":" . $port . "/b1s/v1/sml.svc/".$param);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

    $response = curl_exec($curl);
    $objx = json_decode($response);    
    $arregloaux=$objx->{'value'};
    $j=0;  
    $longitud=count($arregloaux,0);
    
    while ($j<$longitud):
        $arreglo[$i]=$arregloaux[$j];

        $j=$j+1;
        $i=$i+1;
    endwhile; 


    $bandera=1;
endwhile;


//if ($bandera>0):
//    echo json_encode('tiene mas de 20 registro');     
//else:
//    echo json_encode('no iene mas de 20 registro');     
//endif;        



//este if funiona correctamente
//if (property_exists($objx,"@odata.nextLink")):
//    echo json_encode('tiene mas de 20 registro');    
//else:
//    echo json_encode('no tiene mas de 20 registro');        
//endif;



//echo 'Nombre de la Unidad : '.$arreglo2[0]->Dscription;
//echo json_encode('Chasis : '.$arreglo1[0]->CHASIS);
//echo json_encode('Motor  : '.$arreglo1[0]->MOTOR);
//echo json_encode('Motor  : '.$arreglo1[0]->MOTOR);
//echo json_encode('Motor  : '.$arreglo1[0]->AliasName);
echo json_encode($arreglo);


?>
