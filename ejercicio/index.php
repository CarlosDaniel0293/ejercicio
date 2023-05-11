<?php include 'template/header.php'?>

<!--ejecuta la consulta SQL en la base de datos-->
<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from empleados");
    $empleados = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container mt-4" >
    <div class="row justify-content-center">

        
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-light text-dark">
                    Ingresar datos del empleado
                </div>


                <form class="p-4 bg-dark text-light" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Nombres: </label>
                        <input type="text" class="form-control" name="txtNombres" style="font-style: italic;" placeholder="Ingresar nombres" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos: </label>
                        <input type="text" class="form-control" name="txtApellidos" style="font-style: italic;" placeholder="Ingresar apellidos" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo: </label>
                        <input type="email" class="form-control" name="txtCorreo" style="font-style: italic;" placeholder="Ingresar correo electronico" autofocus required>
                        <small id="emailHelp" class="form-text text-light" style="font-style: italic;">Nunca compartiremos tu correo con nadie mas.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular: </label>
                        <input type="number" class="form-control" name="txtCelular" style="font-style: italic;" placeholder="Ingresar numero de celular" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Registrar">
                        <input type="reset" class="btn btn-secondary btn-lg btn-block" value="Limpiar">
                    </div>
                </form>

                
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Lista de Empleados
                </div>
                <div class="p-4 bg-dark">
                    <table class="table align-middle text-light">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Celular</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($empleados as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->id; ?></td>
                                <td><?php echo $dato->nombres; ?></td>
                                <td><?php echo $dato->apellidos; ?></td>
                                <td><?php echo $dato->correo; ?></td>
                                <td><?php echo $dato->celular; ?></td>
                                <td><a class="text-info" href="editar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-pen"></i></a></td>
                                <td><a class="text-success" href="agregarmeta.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-lightning"></i></a></td>
                                <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-warning" href="eliminar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-x-circle"></i></a></td>
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'template/footer.php'?>

