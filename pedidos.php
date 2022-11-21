<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>


  <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">

        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Inicio</a></li>
          <li><a href="pedidos.php" class="nav-link px-2 text-secondary">Ver pedidos</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button>
        </div>
      </div>
    </div>
  </header>
  <body>


    <div class="container">
    <h2 class='mt-3' style='text-align:center;'>Ordenes</h2>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Mesa #</th>
            <th scope="col">No. de personas</th>
            <th scope="col">Total</th>
            <th scope="col">Estatus</th>
            <th scope="col">Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php
                require_once 'conexion.php';

                $sql = "select * from ordenes";

                $result = mysqli_query($conn, $sql) or die("Connection failed: " . mysqli_connect_error($sql));

                while ($prod = mysqli_fetch_assoc($result)) {

                    echo(
                        "<script>"
                        ."console.log('$sql');"
                        ."</script>"
                    );

                    $id = $prod['id_orden'];
                    $mesa = $prod['no_mesa'];
                    $personas = $prod['no_personas'];
                    $total = $prod['total'];
                    $estatus = $prod['estatus'];


                    echo(
                        "<tr>"
                        ."<th scope='row'>$id</th>"
                        ."<td>$mesa</td>"
                        ."<td>$personas</td>"
                        ."<td>$ $total</td>"
                        ."<td>$estatus</td>"
                        ."<td>  <a class='btn btn-success'> Atender </a>  <a class='btn btn-danger'> Cancelar </a>   </td>"
                        ."<tr>"
                    );


                }
            ?>

        </tbody>
    </table>

</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
