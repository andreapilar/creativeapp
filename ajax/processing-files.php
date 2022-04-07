
<?php

//Importamos los archivos necesarios para el tratamiento de los datos
require_once (dirname(__FILE__).'/../configImport.php');

//Recibimos el número del contacto

$type_process = filter_input(INPUT_POST, 'type_process', FILTER_SANITIZE_STRING);
$id_session = filter_input(INPUT_POST, 'id_session', FILTER_SANITIZE_STRING);
$type_test = filter_input(INPUT_POST, "type_test", FILTER_SANITIZE_STRING);

//Recibimos el(los) archivo(s)
$file = $_FILES;

//Validamos el tipo de proceso a ejecutar (MostrarArchivo-ProcesarArchivo)





$response=[];
//Recorremos cada uno de los archivos y realizamos los respectivos procesos
foreach ($file as $data_file){

    if(isset($data_file)){

        //Creamos variable para guardar el array con información del archivo ó la vaciamos
        $file_document = empty($data_file) ? '' : $data_file;

        $messageBd = Files::uploadFile('enviado', $file_document, 'procesado');

        //Realizamos la inserción del archivo a en la BD


            $insert_file_on_bd = Clientes::insertPreTest($id_session,$messageBd['file_name_hash'],$type_test);

//
//            if ($insert_file_on_bd !== ''){
//
//                //Array de respuesta
//                $response_temp = array(
//                    'status' => '200',
//                    'message' => 'Archivo cargado correctamente.',
//                    'text_message' => $messageBd['file_name_hash']
//                );
//                array_push($response,$response_temp);
//            }



    }else{

        //Array de respuesta
        $response = array(
            'status' => '500',
            'message' => 'No se adjuntó ningún archivo.'
        );
    }

}

//Retornamos respuesta en formato Json
echo json_encode($response);
