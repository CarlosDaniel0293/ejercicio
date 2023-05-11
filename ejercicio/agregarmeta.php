<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from empleados where id = ?;");
$sentencia->execute([$codigo]);
$empleados = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_meta = $bd->prepare("select * from metas where id_empleado = ?;");
$sentencia_meta->execute([$codigo]);
$meta = $sentencia_meta->fetchAll(PDO::FETCH_OBJ); 

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos para la meta del empleado: <br><?php echo $empleados->nombres.' '.$empleados->apellidos; ?>
                </div>
                <form class="p-4 bg-dark text-light" method="POST" action="registrarmeta.php">
                    <div class="mb-3">
                        <label class="form-label">Meta: </label>
                        <input type="text" class="form-control" name="txtMeta" style="font-style: italic;" placeholder="Ingresar meta establecida" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiempo estimado para cumplir Meta: </label>
                        <input type="text" class="form-control" name="txtDuracion" style="font-style: italic;" placeholder="Ingresar tiempo estimado" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $empleados->id; ?>"><P></P>
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Registrar">
                        <input type="reset" class="btn btn-secondary btn-lg btn-block" value="Limpiar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Lista de Metas
                </div>
                <div class="col-12 bg-dark">
                    <table class="table text-light">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Meta</th>
                                <th scope="col">Duracion (dias)</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($meta as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->meta; ?></td>
                                    <td><?php echo $dato->duracion; ?></td>
                                    <td><a class="text-info" href="enviarmensaje.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                    <td><a class="text-success" href="enviarlink.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-link-45deg"></i></a></td>
                                    <td><a class="text-info" href="enviarvideo.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-camera-reels"></i></a></td>
                                    <td><a class="text-link" href="enviarubicacion.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-geo-alt"></i></a></td>
                                    <td><a class="text-warning" href="eliminarmeta.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-x-circle"></i></a></td>
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

<?php include 'template/footer.php' ?> 
