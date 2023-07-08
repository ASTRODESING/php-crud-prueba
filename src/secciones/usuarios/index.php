<?php
include("../../db.php");
$query = $conection->prepare("SELECT * FROM `usuario`");
$query->execute();
$lista_usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["txtID"])) {
    $txtID = $_GET["txtID"];
    $query = $conection->prepare("DELETE FROM usuario WHERE id=:id");
    $query->bindParam(":id", $txtID);
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
                <p class=" p-3 m-1 font-bold">Lista de Usuarios</p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/usuarios/crear.php">Crear Usuario</a>
            </div>
            <div class="m-1 w-11/12">
                <table style="width: 100%;">
                    <thead>
                        <th class="font-normal text-center text-slate-300 p-1">ID</th>
                        <th class="font-normal text-center text-slate-300 p-1">Nombre</th>
                        <th class="font-normal text-center text-slate-300 p-1">Contraseña</th>
                        <th class="font-normal text-center text-slate-300 p-1">Correo</th>
                        <th class="font-normal text-center text-slate-300 p-1">Acciones</th>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_usuarios as $usuario) { ?>
                            <tr>
                                <td class="text-slate-300"><?php echo $usuario["id"] ?></td>
                                <td class="text-slate-300"><?php echo $usuario["nombreusuario"] ?></td>
                                <td class="text-slate-300">***</td>
                                <td class="text-slate-300"><?php echo $usuario["correo"] ?></td>
                                <td class="p-4">
                                    <a class=" bg-red-700 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="index.php?txtID=<?php echo $usuario["id"]; ?>">Eliminar</a>
                                    <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/usuarios/editar.php?id=<?php echo $usuario["id"];?>">Editar</a>
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