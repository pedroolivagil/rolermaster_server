<?php
/**
 * Created by OlivaDevelop.
 * User: Oliva
 * Date: 05/02/2018
 * Time: 13:34
 */

class Query {

    private $table;
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
     * @param mixed $fields
     */
    public function setJSONFields($json) {
        $array = json_decode($json, TRUE);
        $this->table = $array[ ENTITY ];
        $this->fields = $array[ $this->table ];
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
        $fields = $this->arrayToString(array_keys($this->fields), FALSE);
        $values = $this->arrayToString(array_values($this->fields));
        $query = "INSERT INTO $this->table ($fields) VALUES ($values);\n";
        return $query;
    }

    function toMerge() {

    }

    function toRemove() {

    }

    function arrayToString($array, $quotes = TRUE) {
        $arr = array();
        $count = 0;
        foreach ($array as $item) {
            $val = NULL;
            if (!is_numeric($item)) {
                if ($quotes) {
                    $val = "'" . $item . "'";
                } else {
                    $val = $item;
                }
            } else {
                $val = $item;
            }
            array_push($arr, $val);
            $count++;
        }
        return implode(',', $arr);
    }
}