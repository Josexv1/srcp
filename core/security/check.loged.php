<?php
if (! defined ( 'SRCP' )) {
  die ( "Logged Hacking attempt!" );
}
if ($_COOKIE["session"]!=""){
$query = "  SELECT  logueado
            FROM    usuarios
            WHERE   cookie = :cookie
         ";
$query_params = array(
                      ':cookie' => $_COOKIE['session']
                    );
    try{
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
      //echo del error!
    }
$row = $stmt->fetch();
if($row['logueado']=='SI'){
  $login_ok = true;
}else{
  $login_ok = 0;  
}
}
?>
