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
    
    function stringifyMonth( $month ){
        switch( $month ){
            case 1:
                $result = "Enero";
                break;
            case 2:
                $result = "Febrero";
                break;
            case 3:
                $result = "Marzo";
                break;
            case 4:
                $result = "Abril";
                break;
            case 5: 
                $result = "Mayo";
                break;
            case 6:
                $result = "Junio";
                break;
            case 7:
                $result = "Julio";
                break;
            case 8:
                $result = "Agosto";
                break;
            case 9:
                $result = "Septiembre";
                break;
            case 10:
                $result = "Octubre";
                break;
            case 11:
                $result = "Noviembre";
                break;
            case 12:
                $result = "Diciembre";
                break;
        }
        return $result;
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
            array_push( $regiones[$row["idRegion"]][$row["year"]],array(                                                        
                                                                        "key" => stringifyMonth($row["month"]),
                                                                        "value" => $row["cantidad"]
                                                                        ));
        }
        $result->close();
    }
?>    
