<?php
require_once ('seccion.class.php');
require_once('invernadero.class.php');
$appInvernadero = new invernadero();
$app=new Seccion();
$accion = (isset($_GET['accion']))?$_GET['accion']:NULL;
$id=(isset($_GET['id']))?$_GET['id']:null;

switch($accion){
    case 'crear':
        $invernaderos = $appInvernadero -> readAll();
        include("views/seccion/crear.php");
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app -> create($data);
        if($resultado){
            $mensaje = "La sección se ha agregado correctamente";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrió un error al agregar";
            $tipo = "danger";
        }
        $secciones = $app -> readAll();
        include('views/seccion/index.php');
        break;
        case 'actualizar':
            $secciones = $app -> readOne($id);
            $invernaderos = $appInvernadero -> readAll();
            include('views/seccion/crear.php');
            break;
        case 'modificar':
            $data = $_POST['data'];
            $resultado = $app->update($id, $data);
            if ($resultado){
                $mensaje = "La seccion se actualizo";
                $tipo="success";
            }else{
                $mensaje = "La seccion no se actualizo";
                $tipo="danger";
            }
            $secciones = $app -> readAll();
            include('views/seccion/index.php');
            break;
    
    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado = $app -> delete($id);
                if($resultado){
                    $mensaje = "La seccion se ha eliminado correctamente";
                    $tipo = "success";
                }else{
                    $mensaje = "Ocurrió un error";
                    $tipo = "danger";
                }
            }
        }
        $secciones = $app -> readAll();
        include("views/seccion/index.php");
        break;
    default:
        $secciones = $app -> readAll();
        include("views/seccion/index.php");
}
?>