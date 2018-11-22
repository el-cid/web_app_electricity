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
    
        $inputFile = fopen('datosNodos/catalogoFiltrado.csv','r');
        
        $fileData = array();

        parse( $inputFile , $fileData );
        insertDataToDB( $conn, $fileData );
        
        fclose( $inputFile );
    
    }
    
    function parse( $sourceFile , &$outputData ){
        $header = true;
        while ( $line = fgets( $sourceFile ) ) {
            if ( $header == true ){
                $header = false;    
            }
            else{
                $row = explode( ',' , $line );
                $data = array(
                              "idRegion" => $row[0],
                              "idNodo" => $row[1],
                              "nombre" => $row[2],
                              "tension" => $row[3],
                              "idEstado" => substr( $row[4] , 0 , -1 )
                             );
                array_push( $outputData, $data );
            }
        }
    }

    function insertDataToDB( $conn, $fileData ){
        $stringArray = array();
        foreach ($fileData as $tuple){
            $tupleString = "('" . $tuple["idRegion"] ."'"
                                . ",'" . $tuple["idNodo"] . "'"
                                . ",'" . $tuple["nombre"] . "'"
                                . "," . $tuple["tension"]
                                . ",'" . $tuple["idEstado"] . "'"
                                . ")";
            array_push( $stringArray , $tupleString );
        }
        $query = 'INSERT INTO nodo ( idRegion , idNodo , nombre , tension , idEstado ) VALUES ' . implode(',', $stringArray);
        $conn->query($query);
    }
?>
