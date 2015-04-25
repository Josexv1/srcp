<?php
setcookie("id_usuario", '', time()-1000);
setcookie("marca_aleatoria_usuario",'', time()-1000);
sleep(1);
header('Location: index.php?accion=salir');
?>
