<?php
require('config.php');
$numero_aleatorio = mt_rand(1000000,999999999);
$logueado = 'NO';
$query = "UPDATE usuarios SET logueado = :logueado WHERE ID = :cookie";
        $query_params = array(
            ':cookie' => $_COOKIE['id_usuario'],
            ':logueado' => $logueado
        );
        try { 
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ /*die("Fallamos al realizar la accion: " . $ex->getMessage());*/ 
		// Si tenemos problemas para ejecutar la consulta imprimimos el error
			echo "<div class='panel-body'>
                    <div class='alert alert-warning alert-dismissable'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                          Tenemos problemas al ejecutar la consulta :c El error es el siguiente: 
					</div>
				  </div>" .$ex->getMessage();}
setcookie("id_usuario", '', time()-1000);
setcookie("marca_aleatoria_usuario",'', time()-1000);
sleep(1);
header('Location: index.php?accion=salir');
?>
