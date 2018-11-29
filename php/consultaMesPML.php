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
            readPrices( $conn , $response , $_POST["idRegion"] , $_POST["year"] , $_POST["month"] );
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
        
    }
    

    function readDates( $conn , &$regiones ){
        $query = "SELECT idRegion, YEAR(fecha) AS year, MONTH(fecha) AS month 
                  FROM precio_mda INNER JOIN 
                       nodo USING(idNodo) 
                  GROUP BY idRegion, year , month";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if ( !(array_key_exists($row["idRegion"], $regiones)) ) {
                    $regiones[$row["idRegion"]] = array();
            }
            if ( !(array_key_exists($row["year"], $regiones[$row["idRegion"]])) ) {
                    $regiones[$row["idRegion"]][$row["year"]] = array();
            }
            array_push( $regiones[$row["idRegion"]][$row["year"]] , $row["month"] );
        }
        $result->close();
    }

    function readPrices( $conn , &$regiones , $idRegion , $year , $month ){
        $query = "SELECT idNodo, DAY(fecha) as day, AVG(precioMarginal) AS avgprice 
                  FROM precio_mda 
                  WHERE idNodo IN ( SELECT idNodo 
                                    FROM nodo 
                                    WHERE idRegion = '$idRegion' ) 
                    AND YEAR(fecha) = $year 
                    AND MONTH(fecha) = $month 
                  GROUP BY idNodo,fecha";

        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if ( !(array_key_exists($row["idNodo"], $regiones)) ) {
                    $regiones[$row["idNodo"]] = array();
            }
            if ( !(array_key_exists($row["day"], $regiones[$row["idNodo"]])) ) {
                    $regiones[$row["idNodo"]][$row["day"]] = $row["avgprice"];
            }
        }
        $result->close(); 
    }
?>    
