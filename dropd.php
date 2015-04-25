<?php
//**************************************
//   Funcion para cargar el proncipal.//
//**************************************
function principal()
    { 
      // debemos llamar la base de datos obligatoriamente en cada funcion.
      include('config.php');
            // Creamos una busqueda
            $sql = 'SELECT * FROM configuracion';
            // Creamos la busqueda por nuestro metodo $db->query(La consulta anterior $sql)y asignamos los valores a $result
            $result = $db->query($sql);
            // Extraemos los valores de  $result
            $rows = $result->fetchAll();
            // Como estan en un arreglo, sacamos cada uno desde $rows

      foreach ($rows as $row)   
        {
           echo '<option value="'.$row['carrera'].'">'.$row['carrera'].'</option>';
        }

}

//**************************************
//    Primera seleccion de resultados  //
//**************************************
if(isset($_GET['funcion']) && $_GET['funcion'] == "drop_1") { 
   drop_1($_GET['drop_var']); 
}

function drop_1($drop_var)
{  
      // debemos llamar la base de datos obligatoriamente en cada funcion.
      include('config.php');
            // Creamos una busqueda
            $sql = 'SELECT * FROM secciones where carrera = :drop';
            // Creamos la busqueda por nuestro metodo $db->query(La consulta anterior $sql)y asignamos los valores a $result
            $query_p = array( 
            ':drop' => $drop_var
        ); 
                   try{ 
            $stmt = $db->prepare($sql); 
            $result = $stmt->execute($query_p); 
        } 
        catch(PDOException $ex){ 
    echo "Error :c" .$ex->getMessage();
    } 
        $rows = $stmt->fetchAll();

    
    echo '<select name="drop_2" id="drop_2">
          <option value=" " disabled="disabled" selected="selected">Selecciona una seccion</option>';

           foreach ($rows as $row) 
           {
              echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
           }
    
    echo '</select>';
    echo "<script type=\"text/javascript\">
$('#wait_2').hide();
    $('#drop_2').change(function(){
      $('#wait_2').show();
      $('#result_2').hide();
      $.get(\"dropd.php\", {
        funcion: \"drop_2\",
        drop_var: $('#drop_2').val()
      }, function(response){
        $('#result_2').fadeOut();
        setTimeout(\"finishAjax('result_2', '\"+escape(response)+\"')\", 400);
      });
        return false;
    });
</script>";
}


//**************************************
//    Segunda seleccion de resultados  //
//**************************************
if(isset($_GET['funcion']) && $_GET['funcion'] == "drop_2") { 
   drop_2($_GET['drop_var']); 
}

function drop_2($drop_var)
{  
      // debemos llamar la base de datos obligatoriamente en cada funcion.
      include('config.php');
            // Creamos una busqueda
            $sql = 'SELECT * FROM secciones where carrera = :drop';
            // Creamos la busqueda por nuestro metodo $db->query(La consulta anterior $sql)y asignamos los valores a $result
            $query_p = array( 
            ':drop' => $drop_var
        ); 
                   try{ 
            $stmt = $db->prepare($sql); 
            $result = $stmt->execute($query_p); 
        } 
        catch(PDOException $ex){ 
    echo "Error :c" .$ex->getMessage();
    } 
        $rows = $stmt->fetchAll();
    
    echo '<select name="drop_2" id="drop_2">
          <option value=" " disabled="disabled" selected="selected">Selecciona una seccion</option>';

           foreach ($rows as $row)
           {
              echo '<option value="'.$row['nombre'].'">'.$row['nombre'].'</option>';
           }
    
    echo '</select> ';
    echo '<input type="submit" name="submit" value="Submit" />';
}
?>