
//////////////////////////////////////////////////////////
 var formulario=document.getElementById('formulariodni');
 var respuesta =document.getElementById('respuesta');
 var respuesta1 =document.getElementById('respuesta1');

 formulario.addEventListener('submit',function(e){
     e.preventDefault(); //evita que por defecto envie datos el formulario
     console.log('Diste un click');

     var datos = new FormData(formulario);

     console.log(datos);
     console.log(datos.get('dni'));

     fetch('BusinessPartners.php',{
         method: 'POST',
         body: datos,
         credentials: 'include'
     })

    .then(res => res.json())       ///recibimos una respuesta en formato json
    .then(data => {                ///aqui nos llegan los datos
            console.log(data)
            respuesta.innerHTML= `
            <div class="alert alert-primary" role="alert">
                ${data}
            </div>
            `                 
            //LLAMAR UNIDADES RELACIONADAS AL DNI-CUIT INGRESADO
            fetch('remitosdeclientes.php',{
                method: 'POST',
                body: datos,
                credentials: 'include'
            })

            .then(res => res.json())
            .then(data => {
                   console.log(data)

                   var tabla = `
                   <table class="table" id="tablaprincipal">
                   <thead>
                     <tr>
                       <th>Nº Remito</th>
                       <th>Descripcion</th>
                       <th>Nº Motor</th>
                       <th>Nº Chasis</th>     
                       <th>Sucursal de Venta</th>                   
                       <th>Accion</th>                               
                     </tr>
                   </thead>`

                   tabla+=`
                   <tbody>
                    
                     `    
                                                                                                                                                                             
                  for (var i=0;i<data.length;i++)   {
                      tabla+=`<tr><td>${data[i].PTICode}-${data[i].FolNumFrom}</td><td>${data[i].Dscription}</td><td>${data[i].MOTOR}</td><td>${data[i].CHASIS}</td><td>${data[i].AliasName}</td><td><button type="button" class="btn btn-success"  onClick="verificarservice('${data[i].MOTOR}')">Servicio</button></td></tr> `         
                   
                  }
                
                  tabla+=`</tbody></table>`
                   
                  respuesta1.innerHTML=tabla;
                  
                  

                  

               })

            

    })
 })


 function verificarservice(parmotor){
  //alert(parmotor);

  var tabla1 =document.getElementById('tablaprincipal');
  
  //oculto la tabla para luego mostrar una respuesta de si encontro service para la unidad indicada
  tabla1.setAttribute("style","display:none");

  ///
  var varmotor=parmotor;
  

  $.ajax({
      method:'post',
      url:'llamadasdeservicios.php',
      //estas con las variables a pasar a PHP, donde el key es el nombre a 
      //recibir  como $_POST['motorr']
      data:{motorr: 'M000529'},   
      datatype: 'json',
      //funcion se llama cuando termina de procesar el request u utiliza el responsex para obtener
      //la data que se imprimio de php
      success: function(responsex){
        //alert('El servidor devolvio '+responsex);
        console.log(JSON.parse(responsex));
      }   
    });

}


 


 

 

 