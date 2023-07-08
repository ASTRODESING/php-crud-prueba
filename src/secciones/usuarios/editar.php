<?php
include("../../db.php");

if (isset($_POST["nombre-usuario"])) {
    print_r($_POST["id"]);
    $id = $_POST["id"];
    $nombreusuario = $_POST["nombre-usuario"];
    $contrasena = $_POST["contrasena"];
    $correo = $_POST["correo"];

    $query = $conection->prepare("UPDATE usuario 
    SET nombreusuario=:nombreusuario,
    contrasena=:contrasenaa,
    correo=:coreeoo
    WHERE id=:id2
    ");
    $query->bindParam(":id2", $id);
    $query->bindParam(":nombreusuario", $nombreusuario);
    $query->bindParam(":contrasenaa", $contrasena);
    $query->bindParam(":coreeoo", $correo);
    $query->execute();
    header("Location:index.php");

}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = $conection->prepare("SELECT * FROM usuario WHERE (id=:id)");
    $query->bindParam(":id", $id);
    $query->execute();
    $usuarioplace = $query->fetchAll(PDO::FETCH_ASSOC);
    print_r($usuarioplace);
}


?>
<link href="../../../dist/output.css" rel="stylesheet">
<?php include("../../templates/header.php"); ?>
<main>


    <div class="flex w-auto justify-center">
        <div class="bg-gray-800 rounded-md w-10/12 text-slate-300 flex m-4 items-center flex-col shadow-lg shadow-black">
            <div class="flex flex-row">
                <p class=" p-3 m-1 font-bold">Editar Usuario</p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/usuarios">Regresar</a>
            </div>

            <div class="m-1 w-11/12">
                <form action="<?php echo $url_base ?>secciones/usuarios/editar.php " method="post" enctype="multipart/form-data" class="flex flex-col items-center">

                    <label for="" class="font-bold text-center mb-2 mt-2">Actualizar Nombre </label>

                    <input type="text" name="id" class="hidden" value="<?php echo $usuarioplace[0]["id"]; ?>">

                    <input type="text" name="nombre-usuario" class="bg-slate-400 rounded-lg p-2 w-96 m-2 text-black shadow-md shadow-black placeholder:text-white" value="<?php echo $usuarioplace[0]["nombreusuario"]; ?>">

                    
                    <label for="" class="font-bold text-center mb-2 mt-2">Actualizar Contraseña</label>

                    <input type="password" name="contrasena" class="bg-slate-400 rounded-lg p-2 w-96 m-2 text-black shadow-md shadow-black placeholder:text-white" value="<?php echo $usuarioplace[0]["contrasena"]; ?>">

                    
                    <label for="" class="font-bold text-center mb-2 mt-2">Actualizar Correo</label>

                    <input type="text" name="correo" class="bg-slate-400 rounded-lg p-2 w-96 m-2 text-black shadow-md shadow-black placeholder:text-white" value="<?php echo $usuarioplace[0]["correo"]; ?>">

                    <div class=" flex flex-row">
                        <input type="submit" class=" bg-green-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg m-2" value="Agregar">
                        <a class=" m-2 bg-red-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/usuarios"> Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


</main>
<?php include("../../templates/footer.php"); ?>