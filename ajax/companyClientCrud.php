<?php

/**
 * @Description: Procesa datos de autenticación del usuario, para crear las respectivas sesiones
 * @User: joaquin reyes
 * @Date: 25/02/19
 */

require_once (dirname(__FILE__).'/../configImport.php');

$Action = filter_input(INPUT_POST, "Action", FILTER_SANITIZE_STRING);


// en esta condicion recibimos los parametros para crear un usuario, devuelve el id si fue exitoso, si no fue exitosa devueleve el false
if ($Action=="CREATE") {
    $validate=true;

    $client_name = filter_input(INPUT_POST, "NameClient", FILTER_SANITIZE_STRING);
    $apell_client = filter_input(INPUT_POST, "ApellClient", FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, "correo", FILTER_SANITIZE_STRING);
    $telefono = filter_input(INPUT_POST, "phoneTable", FILTER_SANITIZE_STRING);
    $edad = filter_input(INPUT_POST, "edad", FILTER_SANITIZE_STRING);
    $genero = filter_input(INPUT_POST, "genero", FILTER_SANITIZE_STRING);




    $inser_user = Clientes::companyClientCreate(
        $client_name,
        $apell_client,
        $telefono,
        $correo,
        $edad,
        $genero
    );

    echo json_encode($inser_user);

    // en esta condicion recibimos los parametros para actualizar un usuario, devuelve el id si fue exitoso, si no fue exitosa devueleve el false
}
else if ($Action==="pre_test"){
    $id_session = filter_input(INPUT_POST, "id_session", FILTER_SANITIZE_STRING);
    $array_codigos = filter_input(INPUT_POST, "array_codigos", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
    $array_titulos = filter_input(INPUT_POST, "array_titulos", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
    $descripcion_array = filter_input(INPUT_POST, "descripcion_array", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
    $type_test = filter_input(INPUT_POST, "type_test", FILTER_SANITIZE_STRING);
    $array_codigos=implode(",",$array_codigos);
    $array_titulos=implode(",",$array_titulos);
    $descripcion_array=implode(",",$descripcion_array);


    Clientes::updatePreTest($id_session,
        $array_titulos,$array_codigos,$descripcion_array,$type_test
);
}

