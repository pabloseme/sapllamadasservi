<?php
        include("conexion.php");
    
        
    
        $nombre=trim($_POST['usuario']);
        $clave=trim($_POST['clave']);
    
        $consulta="select * from usuario where usu='$nombre' and clave='$clave' ";        
        $resultado=mysqli_query($conex,$consulta);

        $filas=mysqli_num_rows($resultado);
        if ($filas>0){
            header("location:index.html");  //direcciona a otra pagina
        }else{
            echo "Error en la autenticacion";
            header("location:login.php");  //direcciona a otra pagina

        }
        mysqli_free_result($resultado);
        mysqli_close($conex);


        
    
?>