<?php

$dni= $_POST['dni'];

if ($dni===''){
    echo json_encode('llene los campos');
}else
{
    echo json_encode('coorrecto');
}
?>
