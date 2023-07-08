<?php
include("../../db.php");

if($_POST){

    //Se evalua que el nombre del puesto se haya enviado por el metodo post, si existe, se le asigna el nombre, si no existe la varie queda como ""
    $nombreusuario= (isset($_POST["nombre-usuario"])?$_POST["nombre-usuario"]:"");
    $contraseña= (isset($_POST["contrasena"])?$_POST["contrasena"]:"");
    $correo= (isset($_POST["correo"])?$_POST["correo"]:"");
    //Se comineza la insercion de los datos
    $query = $conection->prepare("INSERT INTO usuario(id,nombreusuario,contrasena,correo) VALUES(null,:nombreusuario,:contrasena,:correo)");
    $query->bindParam(":nombreusuario",$nombreusuario);
    $query->bindParam(":contrasena",$contraseña);
    $query->bindParam(":correo",$correo);
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
                <p class=" p-3 m-1 font-bold">Datos del Usuario</p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/usuarios">Regresar</a>
            </div>

            <div class="m-1 w-11/12">
                <form action="" method="post" enctype="multipart/form-data" class="flex flex-col items-center">

                    <label for="" class="font-bold text-center mb-2 mt-2">Nombre Usuario</label>

                    <input type="text" name="nombre-usuario" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">

                    <label for="" class="font-bold text-center mb-2 mt-2">Contraseña</label>
                    <input type="password" name="contrasena" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">

                    <label for="" class="font-bold text-center mb-2 mt-2">Correo</label>

                    <input type="text" name="correo" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">

                    <div class=" flex flex-row">

                        <input type="submit"  class=" bg-green-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg m-2" value="Agregar">
                        
                        <a class=" m-2 bg-red-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/usuarios"> Cancelar</a>

                    </div>

                </form>
            </div>
        </div>
    </div>

</main>
<?php include("../../templates/footer.php"); ?>