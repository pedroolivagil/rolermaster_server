<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

interface DB {
    /**
     * Created by OlivaDevelop.
     * User: Oliva
     * Date: 05/02/2018
     * Time: 13:34
     *
     * Persiste un objeto en la bbdd
     * @param Query $query
     * @return mixed
     */
    function persist(Query $query);

    /**
     * Created by OlivaDevelop.
     * User: Oliva
     * Date: 05/02/2018
     * Time: 13:34
     *
     * hace un merge de un objeto existente en la bbdd, de lo contrario, si no existe lo crea
     * @param Query $query
     * @return mixed
     */
    function merge(Query $query);

    /**
     * Created by OlivaDevelop.
     * User: Oliva
     * Date: 05/02/2018
     * Time: 13:34
     *
     * elimina, de forma lógica, un registro de la tabla
     * @param Query $query
     * @return mixed
     */
    function remove(Query $query);

    /**
     * Created by OlivaDevelop.
     * User: Oliva
     * Date: 05/02/2018
     * Time: 13:34
     *
     * devuelve una lista de objetos que coinciden con la query pasada por parámetro
     * @param Query $query
     * @return mixed
     */
    function find(Query $query);

}