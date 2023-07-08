<?php
    $url_base="http://localhost/sistema_prueba/src/"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="bg-gray-700 py-6 relative">
            <div class=" container mx-auto flex justify-around font-semibold text-white" style="text-shadow: 0px 0px 5px black;">
                <a class="hover:text-blue-400 transition-all" href="<?php echo $url_base ?>">Sistema Prueba</a>
                <div>
                    <a class="hover:text-blue-400 transition-all p-2" href="<?php echo $url_base ?>/secciones/empleados"> Empleados</a>
                    <a class="hover:text-blue-400 transition-all p-2" href="<?php echo $url_base ?>/secciones/puestos"> Puestos de Trabajo</a>
                    <a class="hover:text-blue-400 transition-all p-2" href="<?php echo $url_base ?>/secciones/usuarios"> Usuarios</a>
                </div>
                <div>
                <a class="hover:text-blue-400 transition-all p-2" href="">Cerrar Sesion</a>
                </div>
            </div>
        </nav>
    </header>