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
    

        $files = glob('../datos/pml/datos0*.csv', GLOB_BRACE);
        foreach ( $files as $file ){
            $inputFile = fopen( $file , 'r' );            

            $fileData = array();
            parse( $inputFile , $fileData );

            $bufferSize = 3500;
            while ( NULL !== ($stringArray = getDataBuffer( $fileData , $bufferSize )) ){
                $query = 'INSERT INTO precio_mda (idNodo,fecha,hora,precioMarginal) VALUES' . implode(',', $stringArray);
                $conn->query($query);
            }       
 
            fclose( $inputFile );
        }
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
                              "fecha" => $row[0],
                              "hora" => $row[1],
                              "idNodo" => $row[2],
                              "precioMarginal" => substr( $row[3] , 0 , -1 )
                             );
                array_push( $outputData, $data );
            }
        }
    }

    function getDataBuffer( &$dataArray , $bufferSize ){
        $stringArray = array();
        for($i = 0; $i < $bufferSize; $i++){
            $tuple = array_pop($dataArray);
            if (!( $tuple === NULL )){
                $tupleString = "('" . $tuple["idNodo"] ."'"
                                    . ",'" . $tuple["fecha"] ."'"
                                    . "," . $tuple["hora"]
                                    . "," . $tuple["precioMarginal"]
                                    . ")";
                array_push( $stringArray , $tupleString );
            }
            else{
                break;
            }
        }
        $tuplesRead = count($stringArray);
        if ( $tuplesRead == 0 ){
            return NULL;
        }
        else{
            return $stringArray;
        }
    }

?>
