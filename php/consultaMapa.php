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
        readRegions( $conn , $regiones );
        readConsumption( $conn , $regiones );
        echo json_encode($regiones, JSON_PRETTY_PRINT);

    }

    function readRegions( $conn , &$regiones ){
        $query = "SELECT DISTINCT idRegion FROM consumo";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            $region = $row["idRegion"];
            $regiones[$region] = array();
        }
        $result->close();
    }

    function readConsumption( $conn , &$regiones ){
        $query = "SELECT * FROM consumo";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if ( !(array_key_exists($row["year"], $regiones[$row["idRegion"]])) ) {
                $regiones[$row["idRegion"]][$row["year"]] = array();     
            }
            $regiones[$row["idRegion"]][$row["year"]][$row["month"]] = $row["cantidad"];     
        }
        $result->close();
    }
?>    
