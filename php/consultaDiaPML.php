<?php
    
    _main();

    function _main(){
        
        $db_params = parse_ini_file( dirname(__FILE__).'/db_params.ini', false );
        
        $conn = new mysqli( $db_params['host'], 
                            $db_params['user'],
                            $db_params['password'],
                            $db_params['dbname']  
                          );
        
        if ( $conn->connect_error ) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $response = array(); 
        $typeOfQuery = $_POST["data"];        
        
        if ( $typeOfQuery == "DATES" ){
            readDates( $conn , $response );
        }
        else if ( $typeOfQuery == "PML" ){
            readPrices( $conn , $response , $_POST["idRegion"] , $_POST["fecha"] );
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
        
    }
    

    function readDates( $conn , &$regiones ){
        $query = "SELECT idRegion, MIN(fecha) AS MIN, MAX(fecha) AS MAX 
                  FROM precio_mda INNER JOIN 
                       nodo USING(idNodo) 
                  GROUP BY idRegion";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            $region = $row["idRegion"];
            $regiones[$region] = array(
                                       "min" => $row["MIN"],
                                       "max" => $row["MAX"]
                                      );
        }
        $result->close();
    }

    function readPrices( $conn , &$regiones , $idRegion , $fecha ){
        $query = "SELECT idNodo,hora,precioMarginal AS precio 
                  FROM precio_mda 
                  WHERE idNodo IN ( 
                                    SELECT idNodo 
                                    FROM nodo 
                                    WHERE idRegion = '$idRegion' 
                                  ) 
                    AND fecha = '$fecha'";

        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if ( !(array_key_exists($row["idNodo"], $regiones)) ) {
                    $regiones[$row["idNodo"]] = array();
            }
            if ( !(array_key_exists($row["hora"], $regiones[$row["idNodo"]])) ) {
                    $regiones[$row["idNodo"]][$row["hora"]] = $row["precio"];
            }
        }
        $result->close(); 
    }
?>    
