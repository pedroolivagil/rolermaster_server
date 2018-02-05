<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

class Query {

    private $table;
    private $parameters;
    private $fields;
    private $joins;

    private $flags;

    /**
     * Query constructor.
     */
    public function __construct($flags = NULL) {
        $this->flags = $flags;
    }

    /**
     * @return mixed
     */
    public function getTable() {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table) {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    public function setParameters($parameters) {
        $this->parameters = $parameters;
    }

    /**
     * @return mixed
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields) {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getJoins() {
        return $this->joins;
    }

    /**
     * @param mixed $joins
     */
    public function setJoins($joins) {
        $this->joins = $joins;
    }


    function toFind() {

    }

    function toPersist() {

    }

    function toMerge() {

    }

    function toRemove() {

    }

}