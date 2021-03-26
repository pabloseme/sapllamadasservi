<html>
    <head>
        <title>LOGIN</title>

    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link rel="stylesheet" type="text/css" href="css/estilos.css">
       
    </head>
    <body>
        <form class="row g-3 needs-validation" >    
            <div class="container" id='loginx'>  
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h2>LOGIN</h2>
                    </div>
                
                    <div class="panel-body">
                        <h4>Usuario :</h4>
                        <input type="text"class="form-control" name="usuario" placeholder="Ingrese el Usuario "> <br>
                        <h4>Contraseña :</h4>
                        <input type="password" class="form-control" name="clave" placeholder="Ingrese la Clave "> <br>                   
                        <h4>Seleccione la Base datos a Ingresar</h4>
                        <select class="form-control">
                            <option selected></option>
                                <option value="1">Yuhmak S.A</option>
                                <option value="2">Test Yuhmak S.A</option>                                
                        </select>                        
                    </div>
                     <div class="panel-footer">
                        <button class="btn btn-primary" type="submit" >Ingresar</button>
                        
                    </div>                                   
                </div>    
            </div>
        </form>    
        
        <script >
            console.log('Esta funcionando');
        </script>
       
    </body>
</html>






