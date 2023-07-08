<?php
include("../../db.php");
$sentencia = $conection->prepare("SELECT *,
(SELECT nombrepuesto
 FROM puestos 
 WHERE puestos.id=empleados.idpuesto
  limit 1)
   as puesto 
   FROM empleados");
$sentencia->execute();
$listaempleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];


    $query = $conection->prepare("SELECT * FROM empleados WHERE (id=:id)");
    $query->bindParam(":id", $txtID);
    $query->execute();
    $nombre_archivos = $query->fetch(PDO::FETCH_LAZY);

    if(isset($nombre_archivos["foto"]) && $nombre_archivos["foto"]!=""){
        if(file_exists("./fotosEmpleados/".$nombrefoto["foto"])){
            unlink("./fotosEmpleados/".$nombrefoto["foto"]);
        }
    }
    if(isset($nombre_archivos["cv"]) && $nombre_archivos["cv"]!=""){
        if(file_exists("./cvEmpleados/".$nombrefoto["cv"])){
            unlink("./cvEmpleados/".$nombrefoto["cv"]);
        }
    }

    
    $query = $conection->prepare("DELETE FROM empleados WHERE id=:id");
    $query->bindParam(":id",$txtID);
    $query->execute();
    header("Location:index.php");
    
}


?>


<link href="../../../dist/output.css" rel="stylesheet">
<?php include("../../templates/header.php"); ?>
<main>

    <div class="flex w-auto justify-center">
        <div class="bg-gray-800 rounded-md w-10/12 text-slate-300 flex m-4 items-center flex-col shadow-lg shadow-black">
            <div class="flex flex-row">
                <p class=" p-3 m-1 font-bold">Lista de Empleados</p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/empleados/crear.php">Crear Empleado</a>
            </div>
            <div class="m-1 w-11/12">
                <table style="width: 100%;">
                    <thead>
                        <th class="font-normal text-center text-slate-300 p-1">Nombre</th>
                        <th class="font-normal text-center text-slate-300 p-1">Foto</th>
                        <th class="font-normal text-center text-slate-300 p-1">Puesto</th>
                        <th class="font-normal text-center text-slate-300 p-1">Fecha de Ingreso</th>
                        <th class="font-normal text-center text-slate-300 p-1">Acciones</th>
                    </thead>
                    <tbody>
                        <?php foreach ($listaempleados as $empleado) { ?>
                            <tr>
                                <td class="text-white"><?php echo $empleado["nombre"] ?></td>
                                <td><img width="50" src="./fotosEmpleados/<?php echo $empleado["foto"] ?>" alt=""></td>
                                <td class="text-white"><?php echo $empleado["puesto"] ?></td>
                                <td class="text-white"><?php echo $empleado["fechaingreso"] ?></td>
                                <td>
                                    <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="./cvEmpleados/<?php echo $empleado["cv"] ?>">Ver Cv</a>
                                    <a class="m-2 bg-red-700 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="index.php?txtID=<?php echo $empleado["id"]; ?>">Eliminar</a>
                                    <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/empleados/editar.php?id=<?php echo $empleado["id"]; ?>">Editar</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>


</main>
<?php include("../../templates/footer.php"); ?>