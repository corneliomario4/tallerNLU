<?php

require_once "./libreria_dialogflow.php";
require_once './conexion.php';


$usuario = "bot";
$password = "Bot123";

$intent = obtener_intent();

switch($intent){

    case "ordenar inicio - yes":
        //obtener las variables solicitadas en dialogflow
        $parametros = obtener_variables_contexto();
        $mesa = $parametros['no_mesa'];
        $personas = $parametros['no_personas'];
        $pedidos = $parametros["Pedidos"];
        $mensaje = "Tu orden fue procesada de la siguiente manera: \n";
        $id_venta = random_int(1, 999999);
        $venta = "INSERT INTO ordenes (id_orden, no_mesa, no_personas) values ($id_venta, $mesa, $personas)";
        $insertar_venta = mysqli_query($conn, $venta);
        $suma = 0;
        if($insertar_venta){

          foreach ($pedidos as $pedido) {

            if(isset($pedido['Bebidas'])){
              $item = $pedido['Bebidas'];
              $cantidad = $pedido['number'];
              $consulta = "SELECT * FROM productos WHERE nombre = '$item'";
              //$mensaje .= "\n $consulta  \n";
              $result = mysqli_query($conn, $consulta);
              if($result){
                $elemento = mysqli_fetch_assoc($result);
                $id_producto = $elemento['id_producto'];
                $precio = $elemento['precio'];
                $nombre = $elemento['nombre'];
                $suma = $suma + ($precio * $cantidad);
                $total = $precio * $cantidad;
                $mensaje .= "$cantidad X $nombre $ $total \n";
                $total = $precio * $cantidad;
                $insertar_comanda = "INSERT INTO comandas (producto, cantidad, total, id_orden) values ($id_producto, $cantidad, $total, $id_venta)";
                $ejecutar_comanda = mysqli_query($conn, $insertar_comanda);

              }

            }
            else if(isset($pedido['Desayunos'])){

              $item = $pedido['Desayunos'];
              $cantidad = $pedido['number'];
              $consulta = "SELECT * FROM productos WHERE nombre = '$item'";
              //$mensaje .= "\n $consulta \n";
              $result = mysqli_query($conn, $consulta);
              if($result){
                $elemento = mysqli_fetch_assoc($result);
                $precio = $elemento['precio'];
                $nombre = $elemento['nombre'];
                $id_producto = $elemento['id_producto'];
                $total = $precio * $cantidad;
                $suma = $suma + ($precio * $cantidad);

                $mensaje .= "$cantidad X $nombre $ $total \n";

                $total = $precio * $cantidad;
                $insertar_comanda = "INSERT INTO comandas (producto, cantidad, total, id_orden) values ($id_producto, $cantidad, $total, $id_venta)";
                $ejecutar_comanda = mysqli_query($conn, $insertar_comanda);
              }

            }
            else if(isset($pedido['Snack'])){
              $item = $pedido['Snack'];
              $cantidad = $pedido['number'];
              $consulta = "SELECT * FROM productos WHERE nombre = '$item'";
              //$mensaje .= "\n $consulta \n";
              $result = mysqli_query($conn, $consulta);
              if($result){
                $elemento = mysqli_fetch_assoc($result);
                $precio = $elemento['precio'];
                $nombre = $elemento['nombre'];
                $id_producto = $elemento['id_producto'];
                $total = $precio * $cantidad;
                $suma = $suma + ($precio * $cantidad);

                $mensaje .= "$cantidad X $nombre $ $total \n";

                $total = $precio * $cantidad;
                $insertar_comanda = "INSERT INTO comandas (producto, cantidad, total, id_orden) values ($id_producto, $cantidad, $total, $id_venta)";
                $ejecutar_comanda = mysqli_query($conn, $insertar_comanda);

              }
            }
          }

        }

        $actualizar_total = "UPDATE ordenes SET total=$suma WHERE id_orden = $id_venta";
        $actualizar = mysqli_query($conn, $actualizar_total);

        $mensaje .= "\n tu numero de orden para futuras operaciones es: $id_venta, El total de tu compra es: $suma";
        if($actualizar){
          enviar_texto("$mensaje");
        }
        else {
          //elimiar comandas y eliminar ordenar
          enviar_texto("Tu orden no pudo ser procesada, por favor intenta de nuevo");
        }
        break;

    case "consulta_precios":
      $parametros = obtener_variables();
      if(!empty($parametros['Snack'])){
        $nombre_producto = $parametros['Snack'];
        $consulta = "SELECT precio FROM productos WHERE nombre = '$nombre_producto'";
        $result = mysqli_query($conn, $consulta);
        $elemento = mysqli_fetch_assoc($result);
        $precio = $elemento['precio'];

        $mensaje = "El precio de $nombre_producto es: $ $precio";

        enviar_texto($mensaje);
      }
      else if(!empty($parametros['Bebidas'])){
        $nombre_producto = $parametros['Bebidas'];
        $consulta = "SELECT precio FROM productos WHERE nombre = '$nombre_producto'";
        $result = mysqli_query($conn, $consulta);
        $elemento = mysqli_fetch_assoc($result);
        $precio = $elemento['precio'];

        $mensaje = "El precio de $nombre_producto es: $ $precio";

        enviar_texto($mensaje);
      }
      else if(!empty($parametros['Desayunos'])){
        $nombre_producto = $parametros['Desayunos'];
        $consulta = "SELECT precio FROM productos WHERE nombre = '$nombre_producto'";
        $result = mysqli_query($conn, $consulta);
        $elemento = mysqli_fetch_assoc($result);
        $precio = $elemento['precio'];

        $mensaje = "El precio de $nombre_producto es: $ $precio";

        enviar_texto($mensaje);
      }
      break;


    case "menu":
       //enviar_texto(origen());
       enviar_imagenes(["https://lunabar.tech/menu.jpeg"], "DEFAULT");
      // enviar_texto("Cuando estés listo para ordenar, solo dí, estoy listo para ordenar y estré encantado de tomar tu orden :)");
      break;
}



?>
