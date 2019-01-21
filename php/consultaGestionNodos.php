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
        
        $regiones = array(); 
        readState_Regions( $conn , $regiones );
        echo json_encode($regiones, JSON_PRETTY_PRINT);

    } 

    function readState_Regions( $conn , &$regiones ){
        $query = "SELECT idRegion, idEstado, nombre 
                  FROM region_estado INNER JOIN 
                       estado USING ( idEstado )";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if ( !(array_key_exists($row["idRegion"], $regiones)) ) {
                $regiones[$row["idRegion"]] = array();     
            }
            array_push( $regiones[$row["idRegion"]], array( 
                                                            "idEstado" => $row["idEstado"], 
                                                            "nombre" => $row["nombre"]
                                                          )
                      );
        }
        $result->close();
    }
?>    
