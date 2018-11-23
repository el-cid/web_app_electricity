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
	$files = glob('../datos/consumo/consumo_201?.csv', GLOB_BRACE);
	$year = 2016;
        foreach ( $files as $file ){
            $inputFile = fopen( $file , 'r' );    
            $consumo = array();
	    parse( $inputFile , $consumo , $year );
            insertConsumptionDataToDB( $conn, $consumo );
	    fclose( $inputFile );
	    $year += 1;
	}    
    
    }
    
    function parse( $sourceFile , &$outputData , $year ){
        $header = true;
        while ( $line = fgets( $sourceFile ) ) {
            if ( $header == true ){
                $header = false;    
            }
            else{
                $row = explode( ',' , $line );
                $month = $row[0];
                numberizeMonth( $month );
                $rowSize = sizeof($row);
                for($i = 1; $i < $rowSize;$i++){
                    $idRegion = regionKey( $i );
                    $cantidad = str_replace(' ', '', $row[$i]);
                    if ( $i == $rowSize - 1){
                        $cantidad = substr( $cantidad , 0 , -1 );
                    }
                    $data = array(
                              "idRegion" => $idRegion,
                              "year" => $year,
                              "month" => $month,
                              "cantidad" => $cantidad
                             );
                    array_push( $outputData, $data );
                }
            }
        }
    }
    
    function regionKey( $i ){
        switch ( $i ){
            case 1:
                $key = "CEL";
                break;
            case 2:
                $key = "ORI";
                break;
            case 3:
                $key = "OCC";
                break;
            case 4:
                $key = "NOR";
                break;
            case 5:
                $key = "NTE";
                break;
            case 6:
                $key = "NES";
                break;
            case 7:
                $key = "PEN";
                break;
            case 8:
                $key = "BCA";
                break;
            case 9:
                $key = "BCS";
                break;
        }
        return $key;
    }
    
    function numberizeMonth( &$month ){        
        switch ( $month ) {
            case "ene":
                $month = 1;
                break;
            case "feb":
                $month = 2;
                break;
            case "mar":
                $month = 3;
                break;
            case "abr":
                $month = 4;
                break;
            case "may":
                $month = 5;
                break;
            case "jun":
                $month = 6;
                break;
            case "jul":
                $month = 7;
                break;
            case "ago":
                $month = 8;
                break;
            case "sep":
                $month = 9;
                break;
            case "oct":
                $month = 10;
                break;
            case "nov":
                $month = 11;
                break;
            case "dic":
                $month = 12;
                break;
        }
    }

    function insertConsumptionDataToDB( $conn, $consumo ){
        $datosConsumo = array();
        foreach ($consumo as $tuple){
            $tupleString = "('" . $tuple["idRegion"] ."'"
                               . ", " . $tuple["year"] 
                               . ", " . $tuple["month"]
                               . ", " . $tuple["cantidad"]
                               . ")";
            array_push( $datosConsumo , $tupleString );
        }
        $query = 'INSERT INTO consumo ( idRegion , year , month , cantidad ) VALUES' . implode(',', $datosConsumo);
        $conn->query($query);
    }
?>
