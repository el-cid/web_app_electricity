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
        readConsumption( $conn , $regiones );
        echo json_encode($regiones, JSON_PRETTY_PRINT);

    } 

    function readConsumption( $conn , &$regiones ){
        $query = "SELECT consumo.year AS year, month, idRegion, cantidad FROM consumo";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if ( !(array_key_exists($row["year"], $regiones)) ) {
                $regiones[$row["year"]] = array();     
            }
            if ( !(array_key_exists($row["month"], $regiones[$row["year"]])) ) {
                $regiones[$row["year"]][$row["month"]] = array();     
            }
            array_push( $regiones[$row["year"]][$row["month"]], array( 
                                                                      "region" => $row["idRegion"], 
                                                                      "cantidad" => $row["cantidad"]
                                                                      )
                      );
        }
        $result->close();
    }
?>    
