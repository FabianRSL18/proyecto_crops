<?php
require_once('../sistema.class.php');
$app = new Sistema;
$roles = $app -> get_rol('luislao@itcelaya.edu.mx');
print_r($roles);
$privilegio = $app -> get_privilegio('luislao@itcelaya.edu.mx');
print_r($privilegio)
?>