<?php

//Importamos los archivos necesarios para el tratamiento de los datos
require_once(dirname(__FILE__).'/../configImport.php');

class Files
{
    static function uploadFile($tipo = NULL, $file_document = NULL, $estado = NULL){

        $getExtention = ValidateData::getExtensionFile($file_document['name']);

        $mtime = microtime(TRUE);
        $varFileName = $file_document['name'] . $mtime;

        // nombre dle archivo que se guarda en la base de datos
        $fileName = hash("sha256", $varFileName);

        //Obtenemos el Id de la empresa


        //Guardamos la ruta de la carpeta donde estarán los archivos
        //$folder_company = constant('FILES_WEB_URL') . $company_id;
        $folder_pdf_company = __DIR__ .'/../files/';


        //Este método valida si existe el directorio, si no existe, lo crea
        ValidateData::verifyDirectoryCreate($folder_pdf_company);

        //echo '<b>Extensión:</b> '.$getExtention.'<br>';
        //echo '<b>Microtime:</b> '.$varFileName.'<br>';
        //echo '<b>Hash:</b> '.$fileName.'<br>';
        //echo '<b>Id_empresa:</b> '.$company_id.'<br>';
        //echo '<b>Carpeta Empresa:</b> '.$folder_company.'<br>';

;

        $target_path = $folder_pdf_company . $file_document['name'];

        $target_path_rename = $folder_pdf_company . $fileName . $getExtention;

        $archivo_enviado = ValidateData::uploadFile($file_document, $target_path, $target_path_rename);

        if ($archivo_enviado == false) {
            return Array('return' => 'archivo_no_movido');
        };

        $fileName = $fileName.$getExtention;

        //Conversartion::insertMessage($tipo, $file_document, 'procesado', $id_conversacion, $id_operador);

        return Array(
            'file_name_hash' => $fileName,
            'file_alias' => $file_document['name'],
            'file_type' => substr($getExtention,1)
        );
    }


    static function insertFile($file_name = NULL, $file_alias = NULL, $file_type = NULL, $id_company = NULL, $id_template = NULL){

        $sql = "
            INSERT INTO archivo (
                nombre,
                alias,
                tipo,
                fecha,
                id_empresa,
                id_template
            )
            VALUES (
                '%s',
                '%s',
                '%s',
                NOW(),
                '%s',
                '%s'
            )
        ";

        $sql = sprintf($sql,
            $file_name,
            $file_alias,
            $file_type,
            $id_company,
            $id_template
        );

        $result = Db::query(utf8_decode($sql));

        return $result;
    }

}
