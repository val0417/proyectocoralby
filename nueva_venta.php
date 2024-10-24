<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
  <body>
     

    <div class="container">
      <h3>Registrar ventas</h3>
      <p>Por favor ingrese todos los datos de su venta!</p>

       <div class="input-group mb-3">
            <input type="text" class="form-control" id="idCliente" placeholder="Ingresar una identificacion">
            <button class="btn btn-outline-secondary" onclick="ConsultarCliente();">Buscar</button>
       </div>

       <input type="text" readonly class="form-control-plaintext" id="nombreCliente" value="Cliente">
       <button class="btn btn-primary btn-sm" onclick="insertarFactura();">Iniciar Factura</button>
       <h5 id="numeroFactura">Factura: </h5>
       <h4>Agrega un producto</h4>
       <div class="input-group mb-3">
           <input type="text" class="form-control" id="txtCantidad" placeholder="Cantidad">
       </div>
       
       <div class="input-group mb-3">
            <input type="text" class="form-control" id="codigoProductos" placeholder="Ingrese un código">
            <button class="btn btn-outline-secondary" onclick=" buscarProductos();">Agregar</button>
       </div>
    
       <h4>Productos seleccionados</h4>

       <table class="table">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Precio</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Subtotal</th>
    </tr>
</thead>
<tbody id="resultadoProductos">

</tbody>
       </table>
       
       <h4 id="subtotal">Sub Total:</h4>
       <h4 id="iva">IVA %:</h4>
       <h4 id="total">Total Factura:</h4>
</div>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
        var id = 0; //Id del cliente
        var idfactura = 0;
        var Iva = 0;
        var total = 0;
        var SubTotalGeneral = 0;

        function ConsultarCliente(){
            var idCliente = document.getElementById("idCliente").value;
            $.ajax({
                url: 'consultar_clientes.php',
                method: 'POST',
                data: {
                    id_cliente : idCliente
                },
                dataType: 'json',
                success: function (data){
                    if(data.error){
                        alert(data.error)
                    }else{
                        document.getElementById("nombreCliente").value = data.cli_nom + " " + data.cli_apell;
                        id = data.cli_id;
                    }
                }
            });
        }

    
        function insertarFactura() {
          // Obtener el ID del cliente desde el input
          var cli_id = document.getElementById("idCliente").value;

          // Verificar si el ID del cliente está vacío
          if (cli_id === "") {
            alert("Por favor ingrese un ID de cliente");
            return;
          }

          // Enviar la solicitud AJAX para iniciar la factura
          $.ajax({
            url: 'iniciar_factura.php', // URL del archivo PHP que maneja la inserción
            type: 'POST',
            data: { cli_id: cli_id }, // Enviar el ID del cliente al servidor
            dataType: 'json', // Esperar una respuesta en formato JSON
            success: function(response) {
              if (response.success) {
                // Mostrar el número de factura en pantalla si la inserción fue exitosa
                document.getElementById("numeroFactura").textContent = "Factura: " + response.factura_id;
                alert("Factura iniciada con éxito. ID de factura: " + response.factura_id);
              } else {
                // Mostrar el error si la inserción falló
                alert("Error: " + response.error);
              }
            },
            error: function() {
              alert("Error en la solicitud.");
            }
          });
        }

        function buscarProductos(){
           var codigoProducto = document.getElementById("codigoProductos").value;
           var cant = document.getElementById("txtCantidad").value;

           $.ajax({
            url: 'buscar_productos.php',
            method: 'POST', 
            data:{
                codigoProductos: codigoProducto
            },
            dataType: 'json',
            success: function (data){   
                if(data.error){
                    alert(data.error)
                }else{
                   var resultadoProductos = document.getElementById("resultadoProductos");
                   var fila = document.createElement("tr");
                   let subTotal = data.pro_pre * cant;
                   SubTotalGeneral += subTotal;
                   
                   Iva = SubTotalGeneral *0.19;
                   Total = SubTotalGeneral + Iva;
                   insertarProductosFactura(idFactura, data.pro_id, cant);
                   fila.innerHTML = "<td>" + data.pro_id + "</td><td>" + data.pro_nom + "</td><td>" + data.pro_pre +  "</td><td>" + cant + "</td></td><td>" + subTotal +  "</td>";     
                    resultadoProductos.appendChild(fila);
                    document.getElementById("subtotal").innerText = "Sub Total:" + SubTotalGeneral;
                    document.getElementById("iva").innerText = "IVA 19%:" + Iva;
                    document.getElementById("total").innerText = "Total Factura:" + Total;

                }
            }
           });
        }


        function insertarProductosFactura(fac_enc_id, prod_id, fact_det_cant){
            $.ajax({
                url: 'insertar_productos_factura.php',
                method: 'POST',
                data: {
                    fac_enc_id : fac_enc_id,
                    prod_id: prod_id, 
                    fact_det_cant : fact_det_cant
                },
                dataType: 'json',
                success: function (data){
                    if(data.success){
                        alert("producto agregado correctamente!")
                    }else{
                        alert("Error al insertar el producto" + data.error)
                    }
                }
            });
        } 

        


</script>


  </body>
</html>