<?php
include("../../db.php");

if (isset($_POST["nombre-puesto"])) {
    print_r($_POST);
    $id = $_POST["id"];
    $nombrepuesto = $_POST["nombre-puesto"];

    $query = $conection->prepare("UPDATE puestos 
    SET nombrepuesto=:nombrepuest
    WHERE id=:id");
    $query->bindParam(":id", $id);
    $query->bindParam(":nombrepuest", $nombrepuesto);
    $query->execute();
    header("Location:index.php");

}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = $conection->prepare("SELECT * FROM puestos WHERE (id=:id)");
    $query->bindParam(":id", $id);
    $query->execute();
    $nombrepuestoplace = $query->fetchAll(PDO::FETCH_ASSOC);
}


?>
<link href="../../../dist/output.css" rel="stylesheet">
<?php include("../../templates/header.php"); ?>
<main>


    <div class="flex w-auto justify-center">
        <div class="bg-gray-800 rounded-md w-10/12 text-slate-300 flex m-4 items-center flex-col shadow-lg shadow-black">
            <div class="flex flex-row">
                <p class=" p-3 m-1 font-bold">Editar Puesto</p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/puestos">Regresar</a>
            </div>

            <div class="m-1 w-11/12">
                <form action="<?php echo $url_base ?>secciones/puestos/editar.php " method="post" enctype="multipart/form-data" class="flex flex-col items-center">

                    <label for="" class="font-bold text-center mb-2 mt-2">Actualizar Nombre Puesto</label>

                    <input type="text" name="id" class="hidden" value="<?php echo $nombrepuestoplace[0]["id"]; ?>">

                    <input type="text" name="nombre-puesto" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black placeholder:text-white" placeholder="<?php echo $nombrepuestoplace[0]["nombrepuesto"]; ?>">

                    <div class=" flex flex-row">
                        <input type="submit" class=" bg-green-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg m-2" value="Agregar">
                        <a class=" m-2 bg-red-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/puestos"> Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


</main>
<?php include("../../templates/footer.php"); ?>