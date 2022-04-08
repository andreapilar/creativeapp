
<?php

require_once (dirname(__FILE__).'/../configImport.php');

/**
 * @Description: Métodos que se encargan de procesar las validaciones específicas para
 * @User: Andrea Rodriguez
 * @Actualization: ivan.quesada
 * @Date: 06/02/2022
 */

//En esta es la calse general para la validacion
class ValidateData{

    static function validateString($data){
        if($data=="" || $data ==NULL)
            return false;

        //It is ok
        return true;
    }

    static function sendCurl($url,$data = NULL )
    {

        $payload = NULL;

        if ($data!=NULL)
            $payload = json_encode($data);


        // Prepare new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
        );

        // Submit the POST request
        $result = curl_exec($ch);

        // Close cURL session handle
        curl_close($ch);
        return $result;
    }

    static function getExtensionFile ($fichero=NULL){
        $return='.' . substr(strrchr($fichero,"."),1);

        return $return;
    }

    static function uploadFile ($nombre_fichero = NULL,$target_path = NULL,$target_path_rename = NULL){

        if (move_uploaded_file($nombre_fichero['tmp_name'], $target_path)) {
            rename($target_path, $target_path_rename);
            return true;
        }
        else
            return false;
    }

    static function copyFile($target_path = NULL,$target_path_destination = NULL){

        if (copy($target_path, $target_path_destination)) return true;
        else return false;
    }

    static function deleteFile($nombre_fichero = NULL){

        if (file_exists($nombre_fichero)) {
            $return=unlink($nombre_fichero);
            return $return;
        }
        return true;
    }

    static function validateFileExistence($path_to_file = NULL){
        if (file_exists($path_to_file)) return true;
        else return false;
    }

    static function createStructureDirectory($path = NULL, $type = NULL){

        if ($type == 'COMPANY'){
            if (!file_exists($path)){
                mkdir($path,0777, true);
                chmod($path,0777);
            }

            //Validamos que realmente se haya creado la carpeta padre
            if (file_exists($path)) {
                mkdir($path.'extensiones/');
                chmod($path.'extensiones/',0777);
                mkdir($path.'salida/');
                chmod($path.'salida/',0777);
                mkdir($path.'colas/');
                chmod($path.'colas/',0777);
            }
        }
        elseif ($type == 'QUEUE'){
            if (!file_exists($path)){
                mkdir($path,0777, true);
                chmod($path,0777);
            }
        }
    }

    //este metodo valida que solo tenga letra, si no que igual devuelve solo letras del parametro
    static function getAnotherText($cadena){

        $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $return='';
        for ($i=0; $i<strlen($cadena); $i++){
            if (strpos($permitidos, substr($cadena,$i,1))===false)
                return 'Error_Caracteres';
            else{
                //Pass validation
            }
        }

        //si estoy aqui es que todos los caracteres son validos
        return $return;
    }

    static function  verifyDirectoryCreate($direcotiro_verify=FULL_PROJECT_WEB_URL){

        $carpeta = $direcotiro_verify;

        if (!file_exists($carpeta))
            mkdir($carpeta,0777, true);
        chmod($carpeta,0777);
    }

    static function validateFechasRange($inicial,$final){
        $inicial = date($inicial);
        $final = date($final);

        if ($inicial > $final)
            return false;
        else
            return true;
    }

    static function validateIntRagne($inicial=NULL,$final=NULL,$valor=NULL){
        if ($valor>$inicial || $valor<$final)
            return true;
        else
            return false;
    }

    //validar contraseña
    static function validatePassword($clave){
        if(strlen($clave) < 8)
            return false;
        else
            return true;
    }

    static function validateArray($data){
        //validamos que el array no este vacio
        if(empty($data))
            return false;
        else
            return true;
    }

    static function validateIsArray($data){
        //validamos si es array
        if (is_array($data))
            return true;// es array
        else
            return false; // no es array
    }

    static function validateMail($data){
        if (filter_var($data, FILTER_VALIDATE_EMAIL)==false) {
            return false;
        }else{
            return true;
        }
    }

    static function validateInt($data){
        if (filter_var($data, FILTER_VALIDATE_INT) == false)
            return false;
        else
            return true;
    }

    static function validateFloat($data){
        if (filter_var($data, FILTER_VALIDATE_FLOAT) == false)
            return false;
        else
            return true;
    }

    static function generateRandomToken(){

        $token_pre = bin2hex(openssl_random_pseudo_bytes(16));
        $time = time();

        $token = md5($token_pre.$time);

        return $token;
    }

    /**
     * @Descipcion: Method to apply separator of units of thousand, separator of decimals and to avoid approximation or rounding of a number
     * @param: String (numerical figure) | String (Thousand units separator character) | String (Decimal separator character)
     * @return: String | Number formatted according to the parameters
     */
    public function replace_number_format($number,$thousandUnitsSeparator=' ',$decimalSeparator='.'){

        //We search and replace the decimal separator with the received as parameter
        $number = str_replace('.',$decimalSeparator,$number);

        //We obtain the decimal part, with separator included
        $decimalPart = substr(strrchr($number,$decimalSeparator),0);

        //We eliminate from the number the decimal part to obtain only the whole part
        $wholePart = str_replace($decimalPart,'',$number);

        //We get the number of digits that the number has
        $digitsNumber = strlen($wholePart);

        //We evaluate that the number of digits of the number is a multiple of 3
        if($digitsNumber % 3 == 0){
            //We get the whole part
            $number = $wholePart;
        }
        elseif($digitsNumber % 3 == 2){
            //We add a blank space so that thousand units always have 3 figures
            $number = ' '.$wholePart;
        }
        elseif($digitsNumber % 3 == 1){
            //We add two blank space so that thousand units always have 3 figures
            $number = '  '.$wholePart;
        }

        //We obtain an array whose elements contain 3 digits
        $number = str_split($number,3);

        //We convert the array into a single chain
        $number = implode($thousandUnitsSeparator,$number);

        //We obtain the final number eliminating the initial spaces
        if(substr($number,0,2) == '  '){
            //We obtain the number from the second position and join the decimal part
            $number = substr($number,2).$decimalPart;
        }
        elseif(substr($number,0,1) == ' '){
            //We obtain the number from the first position and join the decimal part
            $number = substr($number,1).$decimalPart;
        }
        else{
            //We join the whole part and the decimal part without any alteration
            $number = $number.$decimalPart;
        }

        //We return the fully formatted and processed number
        return $number;
    }

    /**
     * @Descipcion: Concatenate the correct decimals to a number formatted with 'number_format'
     * @param: String | Value of the affiliate obligation
     * @return: String | Value formatted with the correct decimals
     */
    public function numberFormatNoApproximation($valueBalanceAffiliate){

        //We capture the value of the parameter and convert it to 'string'
        $valueBalance = $valueBalanceAffiliate.'';

        //Commas(,) are replaced by points(.)
        $valueBalance = str_replace(',','.',$valueBalance);

        //We get decimals after the point
        $valueDecimals = substr(strrchr($valueBalance,"."),1);

        //We validate if the value has decimals
        if($valueDecimals !== false){
            //Add or remove zeros as necessary
            if(strlen($valueDecimals) == 4){
                //Se deja igual
            }
            elseif(strlen($valueDecimals) === 3){
                $valueBalance = $valueBalance.'0';
            }
            elseif(strlen($valueDecimals) === 2){
                $valueBalance = $valueBalance.'00';
            }
            elseif(strlen($valueDecimals) === 1){
                $valueBalance = $valueBalance.'000';
            }
            elseif(strlen($valueDecimals) > 4){
                //Divide the number in two, to get the whole part and the decimal part
                $numberArray = explode('.', $valueBalance);
                //We get the integers
                $numberInt = $numberArray[0];
                //We get decimals
                $numberDecimal = $numberArray[1];
                //We concatenate the first 4 decimals to the whole part
                $valueBalance = $numberInt.'.'.$numberDecimal[0].$numberDecimal[1].$numberDecimal[2].$numberDecimal[3];
            }
        }
        else{
            //We concatenate the separator point and the four zeros in case of not having decimals
            $valueBalance = $valueBalance.'.0000';
        }

        //We execute a method that formats the numerical figure by assigning a thousand units separator and a decimal separator
        $valueBalance = $this->replace_number_format($valueBalance,' ',',');

        //We save the final value in a variable
        $formattedValue = $valueBalance;

        //We return the formatted value of the member's obligation and with the correct decimals
        return $this->formatDecimalsEndedInZeros($formattedValue);
    }

    /**
     * @Descipcion: Method that shows or not the decimals ending in zeros (0000)
     * @param: String | Value returned by the method 'numberFormatNoApproximation ()'
     * @return: String | Value formatted with the correct decimals
     */
    function formatDecimalsEndedInZeros($valueRetorned){
        // We obtain the characters after the point (.)
        $obteinedValuesDecimal = substr(strrchr($valueRetorned,","),1);

        //We evaluate decimals ending in 'zeros' and hide them
        if (substr($obteinedValuesDecimal,-4) == '0000'){
            //We eliminate all the decimal part
            $decimalsFormated = '';
        }
        elseif(substr($obteinedValuesDecimal,-3) == '000'){
            //We show only one decimal
            $decimalsFormated = ','.substr($obteinedValuesDecimal,0,1);
        }
        elseif(substr($obteinedValuesDecimal,-2) == '00'){
            //We show only two decimals
            $decimalsFormated = ','.substr($obteinedValuesDecimal,0,2);
        }
        elseif(substr($obteinedValuesDecimal,-1) == '0'){
            //We show only three decimals
            $decimalsFormated = ','.substr($obteinedValuesDecimal,0,3);
        }
        else{
            //We show all four decimals
            $decimalsFormated = ','.$obteinedValuesDecimal;
        }
        //We join the decimals returned to the whole part
        $finalValue = str_replace(substr(strrchr($valueRetorned,","),0),$decimalsFormated,$valueRetorned);
        //We return the fully formatted value
        return $finalValue;
    }

    //GENERATE PASSWORD
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     * @Description: Método que formatea las fechas a la 'zona_horaria' que corresponde a la 'empresa'
     * @Param: $zonaHoraria (String) | Cadena del nombre de la zona horaria del país o la región Ej: 'America/Bogota'
     */
    static function getDateTimeZoneNow($zonaHoraria){

        //Obtenemos la fecha actual de la 'zona_horaria' pasada como parámetro
        $fecha = new DateTime('now', new DateTimeZone($zonaHoraria));

        //Retornamos la fecha correctamente formateada
        return $fecha->format('Y-m-d H:i:s');
    }

    /**
     * @Description: Método que obtiene la 'FECHA REAL' dependiendo de la 'zona_horaria' de cada 'empresa'
     */
    static function getRealDateCompanyTimeZone($id_empresa){

        //Obtenemos los datos de la empresa para obtener el Id de la zona_horaria
        $data_company = Company::getAll(NULL,NULL,NULL,$id_empresa,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

        //Obtenemos el Id de la zona_horario
        $get_id_time_zone = $data_company[0]['id_zona_horaria'];

        //Obtenemos los datos de la zona_horaria para obtener el nombre de la misma
        $data_time_zone = ZonaHoraria::getAll(NULL,NULL,NULL,$get_id_time_zone,NULL, NULL);

        //Obtenemos el nombre de la 'zona_horaria'
        $get_name_time_zone = $data_time_zone[0]['name'];

        //Ejecutamos el método que obtiene la Hora Real correspondiente a cada zona_horaria de cada país
        $real_date_time_zone = ValidateData::getDateTimeZoneNow($get_name_time_zone);

        //Retornamos la fecha 'Y-m-d H:i:s' correspondiente a la respectiva zona_horaria de la empresa
        return $real_date_time_zone;
    }

    /**
     * @Description: Método que valida si el nombre de usuario existe otras tablas de la Bd
     */
    static function validateExistingUserName($user){

        //Guardamos el resultado que retorna la tabla 'distribuidor'
        $records_distributor = Distribuidor::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,$user, NULL, NULL, NULL, NULL, 'validation');

        //Validamos si existe en la tabla 'distribuidor'
        if ($records_distributor != NULL)
            return $records_distributor;

        //Validamos si existe en la tabla 'empresa_usuario'
        if (CompanyUser::getAll(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL, NULL, NULL, $user) != NULL)
            return 'user_not_available';

        //Retornamos 'true' en caso de que el proceso no se haya interrumpido en los pasos anteriores, asumiendo con esto que el 'ususario' si está disponible
        return true;
    }

    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

    static function watson_tts($text, $fileName, $lang)
    {
        $destination = constant('URL_DISK')."audio_tts/".$fileName.".ulaw";
        $apiKey = constant('WATSON_KEY');
        $text_data = [
            'text' => $text
        ];
        $text_json = json_encode($text_data);

        if($lang == 'es') $voice ='es-LA_SofiaV3Voice';
        if($lang == 'en') $voice ='en-US_AllisonV3Voice';

        $output_file = fopen($destination, 'w');

        $url = "https://api.us-south.text-to-speech.watson.cloud.ibm.com/instances/499d4f95-a778-428b-93e2-13f420852a5e/v1/synthesize?voice=$voice";

        // Prepare new cURL resource
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $text_json);
        curl_setopt($ch, CURLOPT_USERPWD, "apikey:$apiKey");
        curl_setopt($ch, CURLOPT_FILE, $output_file);

        // Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Accept: audio/mulaw;rate=8000'));
        curl_setopt($ch, CURLOPT_URL, $url);
        try {
            $result  = curl_exec ($ch);
        }catch (Exception $e){
            error_log($e);
        }
        curl_error($ch);
        curl_close ($ch);
        fclose($output_file);

        return [
            'result' => $result,
            'api_file' => $destination
        ];
    }

    static function getEndKey($array){
        end($array);
        return key($array);
    }

    public function getPrefixByDestine($noDestino, $idPlanEmpresa, $type_table = 'call'){

        $number_length = 7;
        $table_destine_detail = $type_table === 'call' ? 'destino_detalle' : 'destino_sms_detalle';
        $table_plan_company_detail = $type_table === 'call' ? 'plan_empresa_detalle' : 'plan_empresa_detalle_sms';
        $property_id_destine = $type_table === 'call' ? 'id_destino' : 'id_destino_sms';

        do {
            $prefijo = substr($noDestino,0, $number_length);
            if ($prefijo==57 && $type_table!=="call"){
                $number_length = $number_length -1;
                continue;
            }


            $sql = "SELECT $table_destine_detail.prefijo, $table_destine_detail.$property_id_destine"
                . " FROM $table_destine_detail, $table_plan_company_detail"
                . " WHERE $table_plan_company_detail.id_plan_empresa = '$idPlanEmpresa'"
                . " AND $table_destine_detail.prefijo = '$prefijo'"
                . " AND $table_plan_company_detail.$property_id_destine = $table_destine_detail.$property_id_destine";

            $result = Db::query($sql);

            $number_length = $number_length -1;
        } while ($result == false && $number_length != 0);
        return $result;
    }

    static function programConsumeWebService ($url, $type, $token, $data, $json_encode = false, $url_encode=false){

        //Obtenemos el array de la consulta que retorna los campos/variables


        //Inicializamos el CURL
        $curl = curl_init();

        //Validamos el tipo de la petición (GET-POST)
        if ($type == 'GET'){


            $parameters = http_build_query($data);

            //Se arma y se obtiene la URL final para petición GET
            $url_api = $url.'?'.$parameters;

        }
        else if ($type === 'DELETE'){
            $url_api = $url;

            //Convertimos los datos a formato Json
            $data = json_encode($data);

            //Habilitamos método POST para el CURL
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        }
        else{

            //Se obtiene la URL final para petición POST
            $url_api = $url;

            //Convertimos los datos a formato Json
            $data = json_encode($data);

            //Habilitamos método POST para el CURL
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//Respuesta del CURL retornada como string
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//true, para que verifique el peer del certificado
        curl_setopt($curl,CURLOPT_ENCODING, "");
        curl_setopt($curl,CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl,CURLOPT_TIMEOUT, 30);
        curl_setopt($curl,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($curl, CURLOPT_URL,$url_api);//Especificamos la URL a la que se consumirá el servicio

        //Configuramos los headers requeridos para ejecutar la petición
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $token
        ));
        if ($url_encode===true){
            curl_setopt($curl,  CURLOPT_HTTPHEADER , array(
                'Content-Type: application/x-www-form-urlencoded'
            ));
        }
        //Se ejecuta (envía) el CURL
        try{
            $curlResponse = curl_exec($curl);
        }catch (Exception $e){
            error_log($e);
        }

        //Cerramos la conexión del CURL
        curl_close($curl);

        //Obtenemos la respuesta de la petición
        if(!$curlResponse)
            return false;
        else{
            if ($json_encode === true){
                return  json_decode($curlResponse, true);
            }else
                return $curlResponse;
        }
    }

    static function array_except($array, $keys){
        $array_final=Array();
        foreach($array as $item){
            foreach($keys as $key){
                if (ValidateData::validateIsArray($item) === false)
                    $item=$array;
                unset($item[$key]);
            }
            array_push($array_final,$item);
        }
        return $array_final;
    }

    static function intermediary_integrations($id_company,$data)
    {
        $return = Array();

        //validation hubspot **********************
        $data_hubspot = Hubspot::getApiKeyCompany($id_company);
        $data_crm = DataCrm::getAll(NULL,NULL,NULL,$id_company);

//        if ($data_hubspot !== false){
//            $api_key = $data_hubspot['apikey'];
//            $api_contacts = $data_hubspot['api_contacts'];
//            $api_db_enabled = $data_hubspot['db_company_enabled'];
//            $data['apikey']=$api_key;
//            $data['api_contacts']=$api_contacts;
//            $data['db_company_enabled']=$api_db_enabled;
//            $data_hubspot = Hubspot::intermediary_hubspot($id_company,$data);
//            array_push($return,
//                Array(
//                    'hubspot'=>$data_hubspot
//                )
//            );
//        }
//        else
//            $return = false;

        if ($data_crm !== false){
            $username = $data_crm[0]['username'];
            $userpassword = $data_crm[0]['userpassword'];
            $serveraddress = $data_crm[0]['serveraddress'];
            $sessionName = $data_crm[0]['sessionName'];
            $api_contacts = $data_crm[0]['api_contacts'];
            $api_db_enabled = $data_crm[0]['db_company_enabled'];
            $data['username']=$username;
            $data['userpassword']=$userpassword;
            $data['serveraddress']=$serveraddress;
            $data['sessionName']=$sessionName;
            $data['db_company_enabled']=$api_db_enabled;
            $data['api_contacts']=$api_contacts;

            $data_sesion=DataCrm::getDataSession($data);

            $sessionName=$data_sesion["sessionName"];
            $userId=$data_sesion["userId"];

            $data['sessionName']=$sessionName;
            $data['userId']=$userId;


            $data_crm = DataCrm::intermediary_data_crm($id_company,$data);
            array_push($return,
                Array(
                    'data_crm'=>$data_crm
                )
            );
        }
        else
            $return = false;
        //end validation hubspot ********************

        return $return;

    }

    static function print_json($status, $mensaje, $data, $type_response = NULL) {
        //200 	OK 	Lo usaremos para cuando la solicitud se realiza correctamente, sin importar si su estatus es verdadero o falso
        //201 	Created 	Se aplicara cuando para cada entidad se cree un nuevo elemento
        //204 	No Content 	Se usara para cuando la entidad no tiene elementos
        //404 	Not Found 	Se usara para cuando se solicita un elemento que no existe en la base de datos
        //405 	Method Not Allowed 	Se usara por defecto para cuando el método solicitado no coincida con la URL o sea un método distinto a GET, POST, PUT y DELETE
        header("HTTP/1.1 $status $mensaje");
        header("Content-Type: application/json; charset=UTF-8");

        if ($type_response !== NULL){
            foreach ($data as $key => $value){
                $response[$key] = $value;
            }
        }
        else $response['data'] = $data;

        $response['statusCode'] = $status;
        $response['statusMessage'] = $mensaje;

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    static function processArrayPermiss($array_permiss) {
        $array_final=[];
        $array_permiss=explode(",",$array_permiss);
        foreach ($array_permiss as $value) {
            $array_final[$value]='SI';
        }
        return $array_final;
    }
    static function get_fcontent( $url,  $javascript_loop = 0, $timeout = 5 ) {
        $url = str_replace( "&amp;", "&", urldecode(trim($url)) );

        $cookie = tempnam ("/tmp", "CURLCOOKIE");
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $ch, CURLOPT_ENCODING, "" );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
        $content = curl_exec( $ch );
        $response = curl_getinfo( $ch );
        curl_close ( $ch );

        if ($response['http_code'] == 301 || $response['http_code'] == 302) {
            ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");

            if ( $headers = get_headers($response['url']) ) {
                foreach( $headers as $value ) {
                    if ( substr( strtolower($value), 0, 9 ) == "location:" )
                        return get_url( trim( substr( $value, 9, strlen($value) ) ) );
                }
            }
        }

        if (    ( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) {
            return get_url( $value[1], $javascript_loop+1 );
        } else {
            return array( $content, $response );
        }
    }
    static function validateUrlIsImageOrDocument($url,$id_empresa)
    {
        parse_str($url, $output);
        if (isset($output["name_file"])){
            $name_file=$output["name_file"];
            $url_archivo = constant('URL_DISK') . $id_empresa . '/' . 'whatsapp/files' . '/' . $name_file;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type=finfo_file($finfo, $url_archivo);

            $array = explode("/", $content_type);
            $extension=$array[1];
            $type=$array[0];

        }else{
            return "text";
        }

        if ($type==="image")
            return 'image';
        else if ($type==="application"){
            return Array(
                'tipo'=>'document',
                'format'=>$extension
            );
        }
        else if ($type==="video")
            return 'video';
        else if ($type==="audio")
            return 'audio';
        else
            return 'link';
    }

    static function validateUrlReturnTypeDocument($url)
    {
        $input_document = preg_quote('Content-Type: application/', '~'); // don't forget to quote input string!
        $result_document = preg_grep('~' . $input_document . '~', get_headers($url));

        if (count($result_document) !== 0)
        {
            foreach ($result_document as $item){
                $string = $item;
            }

            $index = strpos($string, '/');
            $substring = substr($string,$index+1);

            return $substring;

        }else
            return false;

    }

    static function UppercaseKeyArray($array)
    {
        $array = json_decode($array);
        $array_final= Array();
        foreach ($array as $key=>$value){
            $array_final[strtoupper($key)]= $value;
        }
        return json_encode($array_final);
    }

    static function recorrerString($string, $inicio='[', $fin=']')
    {
        $result = '';
        $controlador = 0;
        $total=0;
        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i-1] == $inicio) {
                $controlador = 1;
            }

            if ($string[$i] == $fin) {
                $controlador = 0;
                $result.=',';
                $total++;
            }
            if ($controlador == 1) {
                $result .= $string[$i];
            }

        }
        if ($total==1){
            $result= substr($result, 0,strlen($result)-1);
            $result=[$result];
            return $result;
        }
        return explode(',',$result);
    }

    static function sendCurlWhat($url, $id_empresa,$id_mensaje = NULL,$type="text",$id_canal=NULL)
    {
        $data_company = Whatsapp::getAllDataIntegration(NULL,NULL,NULL,$id_empresa);

        $pos = strpos($url, '?');
        $var_url = substr($url, $pos+1);
        $var_url = $var_url . '&api_key_general='.$data_company[0]['api_key_general'] . '&id_mensaje=' . $id_mensaje;
        $var_url = $var_url . '&namespace='.$data_company[0]['namespace'];
        parse_str($var_url, $data_api);

        $return = Whatsapp::sendMessage($data_api,$id_empresa,$type);
        return $return;
    }

    static function validateCorrectIpv4($str)
    {
        return filter_var($str, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    static function convertBoldWhatsappText($str)
    {


        $contador=1;
        $string_final="";
        for($i=0;$i<strlen($str);$i++)

        {
            $caracter=$str[$i];

            if ($caracter!==NULL){
                if ($caracter === "*"){


                    if ($contador ===1){
                        $caracter='<strong class="text-negrita">';
                        $contador++;
                    }else{
                        $caracter="</strong>";
                        $contador=1;
                    }

                }
                $string_final.=$caracter;
            }
        }

        return $string_final;
    }

    static function convertLineBreak($str)
    {
        $string_final=str_replace("\n", '<p>', $str);
        return $string_final;
    }

    public static function sanearString($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        return $string;
    }
}
