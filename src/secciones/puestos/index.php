<?php
include("../../db.php");
$query = $conection->prepare("SELECT * FROM `puestos`");
$query->execute();
$lista_puestos = $query->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];
    $query = $conection->prepare("DELETE FROM puestos WHERE id=:id");
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
                <p class=" p-3 m-1 font-bold">Lista de Puestos </p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/puestos/crear.php">Crear Puesto</a>
            </div>
            <div class="m-1 w-11/12">
                <table style="width: 100%;">
                    <thead>
                        <th class="font-normal text-center text-slate-300 p-1">Id</th>
                        <th class="font-normal text-center text-slate-300 p-1">Nombre del Puesto</th>
                        <th class="font-normal text-center text-slate-300 p-1">Acciones</th>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_puestos as $puesto) { ?>
                            <tr>
                                <td class="p-2 text-white"><?php echo $puesto["id"] ?></td>
                                <td class="p-2 text-white"><?php echo $puesto["nombrepuesto"] ?></td>
                                <td class="p-4">
                                <a class="m-2 bg-red-700 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="index.php?txtID=<?php echo $puesto["id"]; ?>">Eliminar</a>
                                    <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/puestos/editar.php?id=<?php echo $puesto["id"]; ?>">Editar</a>
                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</main>
<?php include("../../templates/footer.php"); ?>