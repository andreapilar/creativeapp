<?php


require_once(dirname(__FILE__) . '/../configImport.php');

/**
 * Created by PhpStorm.
 * User: mesad
 * Date: 17/05/2019
 * Time: 1:40 PM
 */
class Clientes
{

    // este get all

    static function getAll(
        $page = NULL,
        $pagination = NULL,
        $type = NULL,
        $filter_id = NULL,
        $filtrer_identificacion = NULL,
        $filtrer_nombre = NULL,
        $filtrer_estado = NULL,
        $filtrer_company_id = NULL,
        $filtrer_id_client_company = NULL,
        $filtrer_companyClientStatus = NULL,
        $filtrer_apell_client = NULL,
        $filtrer_tipo_identificacion = NULL)
    {

        //Valor por defecto para page
        if (isset($page) && $page != NULL && is_numeric($page)) { /* Se deja igual */
        } else {
            $page = 1;
        }

        //Valor por defecto para pagination
        if (isset($pagination) && $pagination != NULL && is_numeric($pagination)) { /* Se deja igual */
        } else {
            $pagination = constant("PAGINATION");
        }

        //Valor por defecto para tipo (normal - count)
        if (isset($type) && $type != NULL) { /* Se deja igual */
        } else {
            $type = "normal";
        }


        // calcula desde que registro se va a listar segun la paginacion
        $limit_start = ($page * $pagination) - $pagination;

        // contruyen las condiciones de la consulta
        $conditions = "";

        $array_final = array();

        //Filtro de id
        if ($filter_id != NULL) {
            unset($this_condition);
            $this_condition = 'AND d.id_cliente = "%s"';
            $this_condition = sprintf($this_condition, $filter_id);

            $conditions .= $this_condition;
            unset($this_condition);
        }
        //Filtro de identificacion
        if ($filtrer_identificacion != NULL) {
            unset($this_condition);
            $this_condition = 'AND d.identificacion = "%s"';
            $this_condition = sprintf($this_condition, $filtrer_identificacion);

            $conditions .= $this_condition;
            unset($this_condition);
        }

        //Filtro de estado
        if ($filtrer_estado != NULL) {
            unset($this_condition);
            $this_condition = 'AND d.estado = "%s"';
            $this_condition = sprintf($this_condition, $filtrer_estado);

            $conditions .= $this_condition;
            unset($this_condition);
        }
        // filtro de cliente compañia, el e es el identificador de la tabla compañia en el innner join
        if ($filtrer_id_client_company != NULL) {
            unset($this_condition);
            $this_condition = 'AND e.id_empresa_cliente = "%s"';
            $this_condition = sprintf($this_condition, $filtrer_id_client_company);

            $conditions .= $this_condition;
            unset($this_condition);
        }
//filtro del id de la empresa
        if ($filtrer_company_id != NULL) {
            unset($this_condition);
            $this_condition = 'AND e.id_empresa = "%s"';
            $this_condition = sprintf($this_condition, $filtrer_company_id);

            $conditions .= $this_condition;
            unset($this_condition);
        }

        // filtro de estado
        if ($filtrer_companyClientStatus != NULL) {
            unset($this_condition);
            $this_condition = 'AND e.estado = "%s"';
            $this_condition = sprintf($this_condition, $filtrer_companyClientStatus);

            $conditions .= $this_condition;
            unset($this_condition);
        }

        if ($filtrer_tipo_identificacion != NULL) {
            unset($this_condition);
            $this_condition = 'AND d.tipo_identificacion = "%s"';
            $this_condition = sprintf($this_condition, $filtrer_tipo_identificacion);

            $conditions .= $this_condition;
            unset($this_condition);
        }

        //Filtro de nombre
        if ($filtrer_nombre != NULL) {

            unset($this_condition);

            $nombre_splot=explode(" ", $filtrer_nombre);
            $like='';
            foreach ($nombre_splot as $palabra)
                $like .= '%' . $palabra;

            $like.='%';

            if ($filtrer_apell_client != NULL)
                $this_condition = 'AND (d.nombre like "' . $like . '"';
            else
                $this_condition = 'AND d.nombre like "' . $like . '"';


            $conditions .= $this_condition;
            unset($this_condition);
        }
        //Filtro de apellido
        if ($filtrer_apell_client != NULL) {

            unset($this_condition);

            $nombre_splot=explode(" ", $filtrer_apell_client);
            $like='';
            foreach ($nombre_splot as $palabra)
                $like .= '%' . $palabra;

            $like.='%';

            if ($filtrer_nombre != NULL)
                $this_condition = 'AND d.apellido like "' . $like . '")';
            else
                $this_condition = 'AND d.apellido like "' . $like . '"';

            $conditions .= $this_condition;
            unset($this_condition);
        }


        if ($type == 'count') {
            $sql_select = "
            count(*) as count
            ";

            $sql_limit = "";
        }
        else
        {
            $sql_select = "
            d.id_cliente as clientId,
            d.tipo_identificacion as tipo_identificacion,
            d.identificacion as identificacion,
            d.nombre as name,
            d.estado as status,
            d.apellido as apellido,
            e.id_empresa as id_empresa,
            e.id_empresa_cliente as id_empresa_cliente,
            e.estado as CompanyClientStatus
            ";

            $sql_limit = "
            LIMIT $limit_start, $pagination
            ";
        }

        $sql = "
        SELECT 
            $sql_select
        FROM 
            cliente d
        LEFT JOIN 
            empresa_cliente as e 
        ON 
            d.id_cliente=e.id_cliente
        WHERE
        1 + 2 = 3
        $conditions
        order by nombre
        $sql_limit

        ";
        $result = Db::query($sql);

        if (isset($result[0]) && $result != NULL) {
            if ($type == 'count') {
                //Se calcula el total de paginas con esta configuracion
                $total_pages = ceil(($result[0]['count']) / $pagination);

                return array(
                    "count" => $result[0]['count'],
                    "pagination" => "" . $pagination,
                    "page" => "" . $page,
                    "total_pages" => "" . $total_pages,
                );
            } else {

                return $result;
            }
        } else {
            return NULL;
        }
    }






    static function companyClientCreate(   $client_name,
                                           $apell_client,
                                           $telefono,
                                           $correo,
                                           $edad,
                                           $genero)
    {

        $sql = "
            INSERT INTO 
            cliente
            (
                nombre,
                apellido,
                telefono,
                correo,
                edad,
                genero
            ) 
            VALUES 
            (
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            )";

        $sql = sprintf($sql,
            $client_name,
            $apell_client,
            $telefono,
            $correo,
            $edad,
            $genero
        );

        //var_dump($sql);
        //var_dump('**************');

        //se  asigna el cliente a la empresa creada
        $client_id = Db::query($sql);

        return $client_id;

    }


    static function insertPreTest(   $id_session,$hash_file,$type_test)
    {



        $sql = "
            INSERT INTO 
            pre_test
            (
                id_session,
                hash_file,
             type
                
            ) 
            VALUES 
            (
                '%s',
                '%s',
                '%s'
            )";

        $sql = sprintf($sql,
            $id_session,
            $hash_file,
            $type_test
        );


        //var_dump($sql);
        //var_dump('**************');

        //se  asigna el cliente a la empresa creada
        $client_id = Db::query($sql);

        return $client_id;

    }
    static function updatePreTest(   $id_session,$titulos,$codigos,$descripcion,$type_test)
    {



        $sql = "
            UPDATE
            pre_test
            SET
             pregunta_2='%s',
             pregunta_4='%s',
             pregunta_3='%s'

where id_session='%s' AND type='%s'
        ";

        $sql = sprintf($sql,
            $titulos,
            $descripcion,
            $codigos,
            $id_session,
            $type_test
        );


        //var_dump($sql);
        //var_dump('**************');

        //se  asigna el cliente a la empresa creada
        $client_id = Db::query($sql);

        return $client_id;

    }


}
