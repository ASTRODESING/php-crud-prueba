<?php
include("../../db.php"); 

if($_POST){
    //Se evalua que el nombre del puesto se haya enviado por el metodo post, si existe, se le asigna el nombre, si no existe la varie queda como ""
    $nombre1= (isset($_POST["nombre1"])?$_POST["nombre1"]:"");
    $nombre2= (isset($_POST["nombre2"])?$_POST["nombre2"]:"");
    $apellido1= (isset($_POST["apellido1"])?$_POST["apellido1"]:"");
    $apellido2= (isset($_POST["apellido2"])?$_POST["apellido2"]:"");


    $cv = (isset ($_FILES["curriculum"])?$_FILES["curriculum"]:"");
    $foto = (isset ($_FILES["foto"])?$_FILES["foto"]:"");

    $puesto = (isset ($_POST["puesto"])?$_POST["puesto"]:"");
    $fecha = (isset ($_POST["fecha"])?$_POST["fecha"]:"");

    //Se comineza la insercion del dato
    $query = $conection->prepare("INSERT INTO empleados(id,nombre,segundonombre,apellido,segundoapellido,cv,foto,idpuesto,fechaingreso) VALUES(null,:nombre1,:nombre2,:apellido1,:apellido2,:cv,:foto,:puesto,:fecha)");


    $fecha_archivos = new DateTime();


    $nombrefoto = ($foto!="")?$fecha_archivos->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    $tmp_foto=$_FILES["foto"]["tmp_name"];
    if($tmp_foto!=""){
        move_uploaded_file($tmp_foto,"./fotosEmpleados/".$nombrefoto);
    }



    $nombrecv = ($cv!="")?$fecha_archivos->getTimestamp()."_".$_FILES["curriculum"]["name"]:"";
    $tmp_cv=$_FILES["curriculum"]["tmp_name"];
    if($tmp_cv!=""){
        move_uploaded_file($tmp_cv,"./cvEmpleados/".$nombrecv);
    }

    $query->bindParam(":nombre1",$nombre1);
    $query->bindParam(":nombre2",$nombre2);
    $query->bindParam(":apellido1",$apellido1);
    $query->bindParam(":apellido2",$apellido2);
    $query->bindParam(":cv",$nombrecv);
    $query->bindParam(":foto",$nombrefoto);
    $query->bindParam(":puesto",$puesto);
    $query->bindParam(":fecha",$fecha);
    $query->execute();
    header("Location:index.php");

}
$query = $conection->prepare("SELECT * FROM `puestos`");
$query->execute();
$lista_puestos = $query->fetchAll(PDO::FETCH_ASSOC);


?>


<link href="../../../dist/output.css" rel="stylesheet">
<?php include("../../templates/header.php"); ?>
<main>

    <div class="flex w-auto justify-center">
        <div class="bg-gray-800 rounded-md w-10/12 text-slate-300 flex m-4 items-center flex-col shadow-lg shadow-black">
            <div class="flex flex-row">
                <p class=" p-3 m-1 font-bold">Datos de Empleados</p>
                <a class=" m-2 bg-blue-800 text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/empleados">Regresar</a>
            </div>

            <div class="m-1 w-11/12">
                <form action="" method="post" enctype="multipart/form-data" class="flex flex-col items-center">
                    <label for="" class="font-bold text-center mb-2 mt-2">Primer Nombre</label>
                    <input type="text" name="nombre1" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <label for="" class="font-bold text-center mb-2 mt-2">Segundo Nombre</label>
                    <input type="text" name="nombre2" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <label for="" class="font-bold text-center mb-2 mt-2">Primer Apellido</label>
                    <input type="text" name="apellido1" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <label for="" class="font-bold text-center mb-2 mt-2">Segundo Apellido</label>
                    <input type="text" name="apellido2" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <label for="" class="font-bold text-center mb-2 mt-2">CV</label>
                    <input type="file" name="curriculum" id="" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <label for="" class="font-bold text-center mb-2 mt-2">Foto</label>
                    <input type="file" name="foto" id="" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <label for="" class="font-bold text-center mb-2 mt-2">Puesto</label>
                    <select name="puesto" id="" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">
                        <?php foreach ($lista_puestos as $puesto){?>
                            <option value="<?php echo $puesto["id"] ?>"> <?php echo $puesto["nombrepuesto"]?></option>
                         <?php } ?>
                    </select>


                    <label for="" class="font-bold text-center mb-2 mt-2">Fecha de Ingreso</label>
                    <input type="date" name="fecha" id="" class="bg-slate-400 rounded-lg p-2 w-96 text-black shadow-md shadow-black">


                    <div class=" flex flex-row">
                        <input type="submit" class=" bg-green-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg m-2" value="Agregar">
                        <a class=" m-2 bg-red-500 font-bold text-slate-300 p-2 border-2 border-slate-300 rounded-lg text-center" href="<?php echo $url_base ?>secciones/empleados"> Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</main>
<?php include("../../templates/footer.php"); ?>