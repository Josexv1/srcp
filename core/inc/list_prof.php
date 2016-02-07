<?php
$query = "  SELECT  ID,
                    cedula,
                    nombre,
                    apellido,
                    condicion,
                    telefono
            FROM    profesores
         ";
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
    }
    catch(PDOException $ex){
    echo "Error > " .$ex->getMessage();
    }
    $rows = $stmt->fetchAll();
?>
